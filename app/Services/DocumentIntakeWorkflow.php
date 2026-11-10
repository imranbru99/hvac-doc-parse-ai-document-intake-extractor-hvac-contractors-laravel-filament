<?php

namespace App\Services;

use App\Models\Approval;
use App\Models\DocumentIntake;
use App\Models\JobTicket;
use App\Models\ServiceRequest;
use App\Models\Technician;
use App\Models\User;
use App\Support\ModuleManager;
use Illuminate\Support\Str;

class DocumentIntakeWorkflow
{
    public function __construct(protected AiExtractionService $ai) {}

    public function receive(array $data, ?User $user = null): DocumentIntake
    {
        $intake = DocumentIntake::query()->create([
            'reference' => 'INH-'.strtoupper(Str::random(8)),
            'source' => $data['source'] ?? 'portal',
            'original_filename' => $data['original_filename'] ?? null,
            'file_path' => $data['file_path'] ?? null,
            'mime_type' => $data['mime_type'] ?? null,
            'status' => 'received',
            'document_type' => $data['document_type'] ?? null,
            'raw_text' => $data['raw_text'] ?? null,
            'uploaded_by' => $user?->id,
        ]);

        AuditLogger::log('intake.received', $intake, ['source' => $intake->source]);

        if (ModuleManager::enabled('ai_extraction')) {
            $this->runExtraction($intake);
        }

        return $intake->fresh();
    }

    public function runExtraction(DocumentIntake $intake): DocumentIntake
    {
        $intake->update(['status' => 'extracting']);
        $result = $this->ai->extract($intake);

        $errors = $result['validation_errors'] ?? [];
        $exception = ModuleManager::enabled('validation_routing') && $errors !== [];

        $intake->update([
            'status' => $exception ? 'needs_review' : 'extracted',
            'document_type' => $result['document_type'] ?? $intake->document_type,
            'extracted_fields' => $result['fields'] ?? [],
            'validation_errors' => $errors,
            'confidence_score' => $result['confidence'] ?? null,
            'exception_flag' => $exception,
            'exception_reason' => $exception ? implode('; ', $errors) : null,
        ]);

        AuditLogger::log('intake.extracted', $intake, [
            'confidence' => $result['confidence'] ?? null,
            'engine' => $result['engine'] ?? null,
            'exception' => $exception,
        ]);

        if (ModuleManager::enabled('human_approval')) {
            Approval::query()->updateOrCreate(
                ['document_intake_id' => $intake->id],
                [
                    'requested_by' => $intake->uploaded_by,
                    'status' => 'pending',
                ]
            );
            $intake->update(['status' => 'needs_review']);
        }

        return $intake->fresh();
    }

    public function approve(DocumentIntake $intake, User $approver, ?string $notes = null): DocumentIntake
    {
        $intake->update([
            'status' => 'approved',
            'approved_by' => $approver->id,
            'approved_at' => now(),
            'review_notes' => $notes,
            'exception_flag' => false,
        ]);

        if ($intake->approval) {
            $intake->approval->update([
                'status' => 'approved',
                'reviewed_by' => $approver->id,
                'reviewed_at' => now(),
                'notes' => $notes,
            ]);
        }

        AuditLogger::log('intake.approved', $intake, ['notes' => $notes]);

        $serviceRequest = null;
        if (ModuleManager::enabled('service_requests')) {
            $serviceRequest = $this->createServiceRequest($intake, $approver);
        }

        if (ModuleManager::enabled('job_tickets') && $serviceRequest) {
            $this->createJobTicket($intake, $serviceRequest);
        }

        return $intake->fresh();
    }

    public function reject(DocumentIntake $intake, User $reviewer, string $notes): DocumentIntake
    {
        $intake->update([
            'status' => 'rejected',
            'review_notes' => $notes,
            'assigned_reviewer_id' => $reviewer->id,
        ]);

        if ($intake->approval) {
            $intake->approval->update([
                'status' => 'rejected',
                'reviewed_by' => $reviewer->id,
                'reviewed_at' => now(),
                'notes' => $notes,
            ]);
        }

        AuditLogger::log('intake.rejected', $intake, ['notes' => $notes]);

        return $intake->fresh();
    }

    protected function createServiceRequest(DocumentIntake $intake, User $user): ServiceRequest
    {
        $f = $intake->extracted_fields ?? [];

        $sr = ServiceRequest::query()->create([
            'ticket_number' => 'SR-'.strtoupper(Str::random(7)),
            'document_intake_id' => $intake->id,
            'customer_name' => $f['customer_name'] ?? 'Unknown Customer',
            'customer_email' => $f['customer_email'] ?? null,
            'customer_phone' => $f['customer_phone'] ?? null,
            'service_address' => $f['service_address'] ?? null,
            'city' => $f['city'] ?? null,
            'state' => $f['state'] ?? null,
            'zip' => $f['zip'] ?? null,
            'equipment_type' => $f['equipment_type'] ?? null,
            'equipment_model' => $f['equipment_model'] ?? null,
            'priority' => $f['priority'] ?? 'normal',
            'status' => 'open',
            'problem_summary' => $f['problem_summary'] ?? null,
            'consent_sms' => (bool) ($f['consent_sms'] ?? false),
            'requires_permit' => (bool) ($f['requires_permit'] ?? false),
            'created_by' => $user->id,
        ]);

        AuditLogger::log('service_request.created', $sr);

        return $sr;
    }

    protected function createJobTicket(DocumentIntake $intake, ServiceRequest $sr): JobTicket
    {
        $tech = null;
        if (ModuleManager::enabled('technicians')) {
            $tech = Technician::query()->where('status', 'available')->inRandomOrder()->first();
        }

        $job = JobTicket::query()->create([
            'job_number' => 'JOB-'.strtoupper(Str::random(7)),
            'service_request_id' => $sr->id,
            'document_intake_id' => $intake->id,
            'technician_id' => $tech?->id,
            'title' => trim(($sr->equipment_type ?: 'HVAC').' — '.$sr->customer_name),
            'description' => $sr->problem_summary,
            'status' => $tech ? 'scheduled' : 'draft',
            'scheduled_at' => $tech ? now()->addDay()->setHour(9) : null,
            'meta' => [
                'from_intake' => $intake->reference,
                'integrations' => [
                    'jobber' => ModuleManager::enabled('integrations_jobber'),
                    'servicetitan' => ModuleManager::enabled('integrations_servicetitan'),
                    'quickbooks' => ModuleManager::enabled('integrations_quickbooks'),
                    'google_calendar' => ModuleManager::enabled('integrations_google_calendar'),
                ],
            ],
        ]);

        AuditLogger::log('job_ticket.created', $job, [
            'technician_id' => $tech?->id,
        ]);

        return $job;
    }
}
