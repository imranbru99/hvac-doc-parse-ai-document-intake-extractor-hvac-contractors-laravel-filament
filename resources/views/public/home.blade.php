@extends('layouts.public')

@section('title', 'HvacDocParse — AI Document Intake Extractor for HVAC Contractors')
@section('meta_description', 'Extract fields from HVAC forms, PDFs and attachments. Validate, route exceptions, approve, and create service requests and job tickets — Laravel Filament SaaS.')

@section('content')
<section class="wrap hero">
    <div>
        <div class="eyebrow">HVAC Contractors · Document Operations</div>
        <h1>AI document intake that turns messy PDFs into dispatch-ready jobs.</h1>
        <p class="lead">
            HvacDocParse extracts customer, equipment, and job fields from incoming forms and attachments,
            validates them, routes exceptions, and runs human approval with a full audit trail —
            purpose-built for HVAC owners and operations leads.
        </p>
        <div class="cta-row">
            <a class="btn btn-primary" href="{{ url('/admin') }}">Open Admin Panel</a>
            <a class="btn btn-ghost" href="{{ url('/demo') }}">View Demo Users</a>
            <a class="btn btn-ghost" href="{{ url('/features') }}">Explore Features</a>
        </div>
        <div class="stat-row">
            <div class="stat"><strong>{{ $stats['intakes'] }}</strong><span>Intakes</span></div>
            <div class="stat"><strong>{{ $stats['open_requests'] }}</strong><span>Open Requests</span></div>
            <div class="stat"><strong>{{ $stats['technicians'] }}</strong><span>Technicians</span></div>
            <div class="stat"><strong>{{ $stats['jobs'] }}</strong><span>Job Tickets</span></div>
        </div>
    </div>
    <div class="hero-panel">
        <div class="pill">MVP flow · Intake → Extract → Approve → Audit</div>
        <h3 style="color:#fff;margin-bottom:1rem">Live automation path</h3>
        <div class="flow-step"><div class="flow-num">1</div><div>Intake trigger from email, portal, upload, or Jobber attachment</div></div>
        <div class="flow-step"><div class="flow-num">2</div><div>AI extracts fields and scores confidence</div></div>
        <div class="flow-step"><div class="flow-num">3</div><div>Validation routes exceptions to human review</div></div>
        <div class="flow-step"><div class="flow-num">4</div><div>Approval creates service request + job ticket</div></div>
        <div class="flow-step"><div class="flow-num">5</div><div>Audit log records every action for compliance</div></div>
    </div>
</section>

<section class="wrap block">
    <div class="section-head">
        <h2>Built for HVAC field operations</h2>
        <p class="lead">Operate on service requests, field technicians, and job tickets — not generic OCR demos.</p>
    </div>
    <div class="grid-3">
        <div class="card">
            <div class="tag">Document Intake</div>
            <h3>Forms, PDFs, attachments</h3>
            <p>Capture warranty packets, work orders, and photo attachments from every channel your office already uses.</p>
        </div>
        <div class="card">
            <div class="tag">AI Extraction</div>
            <h3>Structured HVAC fields</h3>
            <p>Customer, address, equipment model, priority, SMS consent, and permit flags — ready for ops review.</p>
        </div>
        <div class="card">
            <div class="tag">Dispatch Ready</div>
            <h3>Technicians & job tickets</h3>
            <p>Approved intakes become service requests and scheduled tickets assigned to licensed field techs.</p>
        </div>
    </div>
</section>

<section class="wrap block">
    <div class="section-head">
        <h2>Modular by design</h2>
        <p class="lead">Enable only what your HVAC business needs. Core workflow modules stay on; integrations and niche tools stay optional.</p>
    </div>
    <div class="grid-2">
        @foreach($modules->take(8) as $module)
            <div class="card">
                <span class="badge {{ ($module['enabled'] ?? false) ? 'badge-on' : 'badge-off' }}">
                    {{ ($module['enabled'] ?? false) ? 'ON' : 'OFF' }}
                </span>
                <h3 style="margin-top:.6rem">{{ $module['name'] }}</h3>
                <p>{{ $module['description'] }}</p>
            </div>
        @endforeach
    </div>
    <div class="cta-row">
        <a class="btn btn-ghost" href="{{ url('/modules') }}">See all modules</a>
    </div>
</section>
@endsection
