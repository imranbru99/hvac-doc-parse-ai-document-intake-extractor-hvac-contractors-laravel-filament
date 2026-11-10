@extends('layouts.public')

@section('title', 'Pricing — HvacDocParse Pilot Plans for HVAC Contractors')

@section('content')
<section class="wrap block">
    <div class="section-head">
        <div class="eyebrow">Pilot Pricing Hypothesis</div>
        <h1>$299–$1,499 / month</h1>
        <p class="lead">Designed for HVAC contractor owners and operations leads who need document intake automation without a six-month FSM project.</p>
    </div>
    <div class="grid-3">
        <div class="price">
            <div class="tag" style="color:var(--accent-deep);font-weight:700;font-size:.75rem;letter-spacing:.06em;text-transform:uppercase">Starter</div>
            <div class="amount">$299</div>
            <p>Single location · core intake + AI extract + approval + audit</p>
        </div>
        <div class="price featured">
            <div class="tag" style="color:var(--accent-deep);font-weight:700;font-size:.75rem;letter-spacing:.06em;text-transform:uppercase">Growth</div>
            <div class="amount">$799</div>
            <p>Multi-tech roster · job tickets · consent & licensing modules · priority support</p>
        </div>
        <div class="price">
            <div class="tag" style="color:var(--accent-deep);font-weight:700;font-size:.75rem;letter-spacing:.06em;text-transform:uppercase">Ops Plus</div>
            <div class="amount">$1,499</div>
            <p>Integrations pack (Jobber / ServiceTitan / QuickBooks / Calendar) · custom routing rules</p>
        </div>
    </div>
</section>
@endsection
