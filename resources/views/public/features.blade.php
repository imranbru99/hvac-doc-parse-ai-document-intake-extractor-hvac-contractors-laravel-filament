@extends('layouts.public')

@section('title', 'Features — HvacDocParse AI HVAC Document Automation')

@section('content')
<section class="wrap block">
    <div class="section-head">
        <div class="eyebrow">Product Features</div>
        <h1>Everything an HVAC ops lead needs for document operations</h1>
        <p class="lead">From intake to approved job tickets — with multi-role users, module toggles, AI assist, and compliance-aware messaging/licensing checks.</p>
    </div>
    <div class="grid-3">
        <div class="card"><div class="tag">Core</div><h3>Multi-channel intake</h3><p>Portal upload, email packet, Jobber attachment, and staff-assisted capture.</p></div>
        <div class="card"><div class="tag">AI</div><h3>Field extraction</h3><p>Customer, site, equipment, priority, consent, and permit signals with confidence scoring.</p></div>
        <div class="card"><div class="tag">Quality</div><h3>Validation routing</h3><p>Missing fields and policy flags become exceptions for human review — not silent failures.</p></div>
        <div class="card"><div class="tag">Governance</div><h3>Human approval</h3><p>Owner/ops approve before jobs are created or integrations fire.</p></div>
        <div class="card"><div class="tag">Ops</div><h3>Service requests</h3><p>Structured tickets linked back to the source document and extraction payload.</p></div>
        <div class="card"><div class="tag">Field</div><h3>Technician roster</h3><p>Licenses, skills, regions, and availability for assignment.</p></div>
        <div class="card"><div class="tag">Dispatch</div><h3>Job tickets</h3><p>Draft → scheduled → in progress with optional calendar and FSM sync metadata.</p></div>
        <div class="card"><div class="tag">Compliance</div><h3>Audit log</h3><p>Immutable actions for intake, extract, approve, reject, and job creation.</p></div>
        <div class="card"><div class="tag">Roles</div><h3>Multi-type users</h3><p>Admin, owner, staff, technician, and customer demo personas with panel access rules.</p></div>
        <div class="card"><div class="tag">Modules</div><h3>On/off switches</h3><p>Turn integrations, attendance, catalog enrich, and customer portal modules on when needed.</p></div>
        <div class="card"><div class="tag">PDF</div><h3>Unicode PDF export</h3><p>Generate multilingual intake summaries via laravel-unicode-pdf when enabled.</p></div>
        <div class="card"><div class="tag">AI Hub</div><h3>Provider-ready</h3><p>Wired for imrandevbd/laravel-ai-hub with a deterministic local extractor for demos.</p></div>
    </div>
</section>
@endsection
