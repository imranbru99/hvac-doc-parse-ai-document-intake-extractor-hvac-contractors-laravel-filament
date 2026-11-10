<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\DocumentIntake;
use App\Models\JobTicket;
use App\Models\ModuleSetting;
use App\Models\ServiceRequest;
use App\Models\Technician;
use App\Models\User;
use App\Services\DocumentIntakeWorkflow;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (config('modules') as $key => $module) {
            ModuleSetting::query()->updateOrCreate(
                ['key' => $key],
                [
                    'name' => $module['name'],
                    'description' => $module['description'],
                    'enabled' => $module['enabled'],
                    'core' => $module['core'],
                ]
            );
        }

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@hvacdocparse.test'],
            [
                'name' => 'Admin Demo',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ADMIN,
                'phone' => '+1-512-555-0100',
                'is_active' => true,
                'company_name' => 'HvacDocParse Demo Co',
                'email_verified_at' => now(),
            ]
        );

        $owner = User::query()->updateOrCreate(
            ['email' => 'owner@hvacdocparse.test'],
            [
                'name' => 'Owner Ops Lead',
                'password' => Hash::make('password'),
                'role' => User::ROLE_OWNER,
                'phone' => '+1-512-555-0101',
                'is_active' => true,
                'company_name' => 'Lone Star HVAC',
                'email_verified_at' => now(),
            ]
        );

        $staff = User::query()->updateOrCreate(
            ['email' => 'staff@hvacdocparse.test'],
            [
                'name' => 'Office Staff',
                'password' => Hash::make('password'),
                'role' => User::ROLE_STAFF,
                'phone' => '+1-512-555-0102',
                'is_active' => true,
                'company_name' => 'Lone Star HVAC',
                'email_verified_at' => now(),
            ]
        );

        $techUser = User::query()->updateOrCreate(
            ['email' => 'tech@hvacdocparse.test'],
            [
                'name' => 'Field Tech Demo',
                'password' => Hash::make('password'),
                'role' => User::ROLE_TECHNICIAN,
                'phone' => '+1-512-555-0103',
                'is_active' => true,
                'company_name' => 'Lone Star HVAC',
                'email_verified_at' => now(),
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'customer@hvacdocparse.test'],
            [
                'name' => 'Customer Demo',
                'password' => Hash::make('password'),
                'role' => User::ROLE_CUSTOMER,
                'phone' => '+1-512-555-0104',
                'is_active' => true,
                'company_name' => null,
                'email_verified_at' => now(),
            ]
        );

        $tech1 = Technician::query()->updateOrCreate(
            ['email' => 'tech@hvacdocparse.test'],
            [
                'user_id' => $techUser->id,
                'name' => 'Field Tech Demo',
                'phone' => '+1-512-555-0103',
                'license_number' => 'TX-HVAC-88421',
                'skills' => ['heat_pump', 'furnace', 'ductwork'],
                'status' => 'available',
                'region' => 'Austin Metro',
            ]
        );

        Technician::query()->updateOrCreate(
            ['email' => 'alex.rivera@hvacdocparse.test'],
            [
                'name' => 'Alex Rivera',
                'phone' => '+1-512-555-0115',
                'license_number' => 'TX-HVAC-77102',
                'skills' => ['mini_split', 'commercial'],
                'status' => 'available',
                'region' => 'Round Rock',
            ]
        );

        Technician::query()->updateOrCreate(
            ['email' => 'sam.cho@hvacdocparse.test'],
            [
                'name' => 'Sam Cho',
                'phone' => '+1-512-555-0116',
                'license_number' => 'TX-HVAC-66091',
                'skills' => ['refrigerant', 'diagnostics'],
                'status' => 'on_job',
                'region' => 'South Austin',
            ]
        );

        if (DocumentIntake::query()->exists()) {
            return;
        }

        /** @var DocumentIntakeWorkflow $workflow */
        $workflow = app(DocumentIntakeWorkflow::class);

        $samples = [
            [
                'source' => 'email',
                'original_filename' => 'service-request-gonzalez.pdf',
                'mime_type' => 'application/pdf',
                'raw_text' => "Customer: Maria Gonzalez\nEmail: maria.g@example.com\nPhone: 512-555-0142\nAddress: 4821 Oak Ridge Dr, Austin TX 78745\nIssue: Unit not cooling; ice on outdoor lines\nEquipment: Carrier 25VNA4 Heat Pump",
                'document_type' => 'service_form',
            ],
            [
                'source' => 'portal',
                'original_filename' => 'work-order-whitfield.pdf',
                'mime_type' => 'application/pdf',
                'raw_text' => "Work Order — James Whitfield\njwhitfield@example.com 214-555-0198\n901 Commerce Blvd Dallas TX 75201\nFurnace Trane S9V2 — No heat; error code on thermostat\nPermit may be required",
                'document_type' => 'work_order',
            ],
            [
                'source' => 'upload',
                'original_filename' => 'warranty-patel.pdf',
                'mime_type' => 'application/pdf',
                'raw_text' => "Warranty / Maintenance — Priya Patel\npriya.patel@example.com\n2200 Westheimer Rd #4B Houston TX 77098\nMini-Split Mitsubishi MSZ-FS12NA",
                'document_type' => 'warranty',
            ],
            [
                'source' => 'jobber',
                'original_filename' => 'attachment-filter-change.jpg',
                'mime_type' => 'image/jpeg',
                'raw_text' => 'Filter change request incomplete form missing address',
                'document_type' => 'attachment',
            ],
        ];

        foreach ($samples as $i => $sample) {
            $uploader = $i % 2 === 0 ? $staff : $owner;
            $intake = $workflow->receive($sample, $uploader);

            if ($i < 2) {
                $workflow->approve($intake, $owner, 'Demo approval — fields look good.');
            }
        }

        $job = JobTicket::query()->first();
        if ($job) {
            $job->update([
                'technician_id' => $tech1->id,
                'status' => 'scheduled',
                'scheduled_at' => now()->addDay()->setHour(10),
            ]);
        }

        AuditLog::query()->create([
            'action' => 'demo.seeded',
            'entity_type' => 'system',
            'entity_id' => null,
            'user_id' => $admin->id,
            'payload' => [
                'users' => User::count(),
                'intakes' => DocumentIntake::count(),
                'service_requests' => ServiceRequest::count(),
                'jobs' => JobTicket::count(),
            ],
            'ip_address' => '127.0.0.1',
        ]);
    }
}
