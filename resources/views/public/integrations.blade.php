@extends('layouts.public')

@section('title', 'Integrations — Jobber ServiceTitan QuickBooks Google Calendar | HvacDocParse')

@section('content')
<section class="wrap block">
    <div class="section-head">
        <div class="eyebrow">Integrations</div>
        <h1>Connect the tools HVAC contractors already run</h1>
        <p class="lead">Modules ship OFF by default. Enable when your pilot is ready to sync approved jobs and customers.</p>
    </div>
    <div class="grid-2">
        <div class="card"><h3>Jobber</h3><p>Push approved customers and jobs after human approval. Module: integrations_jobber.</p></div>
        <div class="card"><h3>ServiceTitan</h3><p>Map technicians and tickets into ServiceTitan workflows. Module: integrations_servicetitan.</p></div>
        <div class="card"><h3>QuickBooks</h3><p>Carry extracted billing-ready fields into QuickBooks customer records. Module: integrations_quickbooks.</p></div>
        <div class="card"><h3>Google Calendar</h3><p>Optional calendar hold when a job ticket is scheduled. Module: integrations_google_calendar.</p></div>
    </div>
</section>
@endsection
