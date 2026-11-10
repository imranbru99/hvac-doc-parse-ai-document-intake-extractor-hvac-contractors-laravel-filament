<?php

return [
    /*
    |--------------------------------------------------------------------------
    | HvacDocParse Feature Modules
    |--------------------------------------------------------------------------
    | Toggle modules on/off per business needs. Core document intake modules
    | default ON; niche add-ons default OFF but remain available.
    */
    'document_intake' => [
        'key' => 'document_intake',
        'name' => 'Document Intake',
        'description' => 'Receive forms, PDFs, and attachments from email, portal, and integrations.',
        'enabled' => true,
        'core' => true,
    ],
    'ai_extraction' => [
        'key' => 'ai_extraction',
        'name' => 'AI Field Extraction',
        'description' => 'Extract customer, equipment, address, and job fields with AI.',
        'enabled' => true,
        'core' => true,
    ],
    'validation_routing' => [
        'key' => 'validation_routing',
        'name' => 'Validation & Exception Routing',
        'description' => 'Validate extracted fields and route exceptions for human review.',
        'enabled' => true,
        'core' => true,
    ],
    'human_approval' => [
        'key' => 'human_approval',
        'name' => 'Human Approval Queue',
        'description' => 'Ops lead approval before creating jobs or syncing integrations.',
        'enabled' => true,
        'core' => true,
    ],
    'audit_log' => [
        'key' => 'audit_log',
        'name' => 'Audit Log',
        'description' => 'Immutable trail of intake, extract, approve, and sync events.',
        'enabled' => true,
        'core' => true,
    ],
    'service_requests' => [
        'key' => 'service_requests',
        'name' => 'Service Requests',
        'description' => 'Manage HVAC service requests created from approved intake.',
        'enabled' => true,
        'core' => true,
    ],
    'technicians' => [
        'key' => 'technicians',
        'name' => 'Field Technicians',
        'description' => 'Technician roster, skills, licensing, and assignment status.',
        'enabled' => true,
        'core' => true,
    ],
    'job_tickets' => [
        'key' => 'job_tickets',
        'name' => 'Job Tickets',
        'description' => 'Create and track field job tickets from approved documents.',
        'enabled' => true,
        'core' => true,
    ],
    'integrations_jobber' => [
        'key' => 'integrations_jobber',
        'name' => 'Jobber Integration',
        'description' => 'Push approved jobs and customers to Jobber.',
        'enabled' => false,
        'core' => false,
    ],
    'integrations_servicetitan' => [
        'key' => 'integrations_servicetitan',
        'name' => 'ServiceTitan Integration',
        'description' => 'Sync jobs and technicians with ServiceTitan.',
        'enabled' => false,
        'core' => false,
    ],
    'integrations_quickbooks' => [
        'key' => 'integrations_quickbooks',
        'name' => 'QuickBooks Integration',
        'description' => 'Map extracted billing fields to QuickBooks customers/invoices.',
        'enabled' => false,
        'core' => false,
    ],
    'integrations_google_calendar' => [
        'key' => 'integrations_google_calendar',
        'name' => 'Google Calendar Integration',
        'description' => 'Optional calendar hold when a job ticket is approved.',
        'enabled' => false,
        'core' => false,
    ],
    'attendance_hub' => [
        'key' => 'attendance_hub',
        'name' => 'Attendance Hub',
        'description' => 'Technician clock-in via attendance machines (local module).',
        'enabled' => false,
        'core' => false,
    ],
    'unicode_pdf' => [
        'key' => 'unicode_pdf',
        'name' => 'Unicode PDF Export',
        'description' => 'Generate multilingual PDF job packets and intake summaries.',
        'enabled' => true,
        'core' => false,
    ],
    'ai_catalog_scrape' => [
        'key' => 'ai_catalog_scrape',
        'name' => 'AI Catalog / Equipment Lookup',
        'description' => 'Enrich extracted equipment models from online catalogs.',
        'enabled' => false,
        'core' => false,
    ],
    'messaging_consent' => [
        'key' => 'messaging_consent',
        'name' => 'Messaging Consent Guard',
        'description' => 'Track SMS/email consent before outbound customer messages.',
        'enabled' => true,
        'core' => false,
    ],
    'licensing_safety' => [
        'key' => 'licensing_safety',
        'name' => 'Licensing & Safety Checks',
        'description' => 'Flag jobs requiring EPA/refrigerant or permit documentation.',
        'enabled' => true,
        'core' => false,
    ],
    'customer_portal' => [
        'key' => 'customer_portal',
        'name' => 'Customer Document Portal',
        'description' => 'Allow customers to upload warranty forms and service attachments.',
        'enabled' => false,
        'core' => false,
    ],
];
