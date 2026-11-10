<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('staff')->after('email');
            $table->string('phone')->nullable()->after('role');
            $table->boolean('is_active')->default(true)->after('phone');
            $table->string('company_name')->nullable()->after('is_active');
        });

        Schema::create('module_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('enabled')->default(false);
            $table->boolean('core')->default(false);
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::create('technicians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('license_number')->nullable();
            $table->json('skills')->nullable();
            $table->string('status')->default('available');
            $table->string('region')->nullable();
            $table->timestamps();
        });

        Schema::create('document_intakes', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('source')->default('portal'); // portal, email, jobber, upload
            $table->string('original_filename')->nullable();
            $table->string('file_path')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('status')->default('received'); // received, extracting, extracted, needs_review, approved, rejected, routed
            $table->string('document_type')->nullable(); // service_form, warranty, invoice, work_order, attachment
            $table->text('raw_text')->nullable();
            $table->json('extracted_fields')->nullable();
            $table->json('validation_errors')->nullable();
            $table->float('confidence_score')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('assigned_reviewer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->text('review_notes')->nullable();
            $table->boolean('exception_flag')->default(false);
            $table->string('exception_reason')->nullable();
            $table->timestamps();
        });

        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->foreignId('document_intake_id')->nullable()->constrained()->nullOnDelete();
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('service_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('equipment_type')->nullable();
            $table->string('equipment_model')->nullable();
            $table->string('priority')->default('normal');
            $table->string('status')->default('open');
            $table->text('problem_summary')->nullable();
            $table->boolean('consent_sms')->default(false);
            $table->boolean('requires_permit')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('job_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('job_number')->unique();
            $table->foreignId('service_request_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('document_intake_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('technician_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('draft'); // draft, scheduled, in_progress, completed, cancelled
            $table->dateTime('scheduled_at')->nullable();
            $table->string('external_jobber_id')->nullable();
            $table->string('external_servicetitan_id')->nullable();
            $table->boolean('calendar_synced')->default(false);
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->string('entity_type')->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->json('payload')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });

        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_intake_id')->constrained()->cascadeOnDelete();
            $table->foreignId('requested_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('notes')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approvals');
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('job_tickets');
        Schema::dropIfExists('service_requests');
        Schema::dropIfExists('document_intakes');
        Schema::dropIfExists('technicians');
        Schema::dropIfExists('module_settings');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'is_active', 'company_name']);
        });
    }
};
