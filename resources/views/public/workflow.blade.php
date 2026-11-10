@extends('layouts.public')

@section('title', 'Workflow — Intake Trigger to Audit Log | HvacDocParse')

@section('content')
<section class="wrap block">
    <div class="section-head">
        <div class="eyebrow">Document Intake Extractor</div>
        <h1>1 intake trigger → draft/action → human approval → audit log</h1>
        <p class="lead">The Rank #8 USA automation opportunity for HVAC contractors: extract, validate, route exceptions, and operate on service requests, technicians, and job tickets.</p>
    </div>
    <div class="grid-2">
        <div class="card">
            <h3>1. Intake trigger</h3>
            <p>Staff or automation drops a PDF/form/attachment into HvacDocParse. Source tags: portal, email, upload, Jobber.</p>
        </div>
        <div class="card">
            <h3>2. AI draft / action</h3>
            <p>Extraction fills HVAC-specific fields and confidence. Validation checks required data, SMS consent, and permit needs.</p>
        </div>
        <div class="card">
            <h3>3. Human approval</h3>
            <p>Owner or ops lead reviews exceptions, edits notes, approves or rejects. Approval is required before job creation.</p>
        </div>
        <div class="card">
            <h3>4. Audit log</h3>
            <p>Every receive, extract, approve, reject, and job create event is recorded with actor and payload for MED risk/compliance.</p>
        </div>
    </div>
</section>
@endsection
