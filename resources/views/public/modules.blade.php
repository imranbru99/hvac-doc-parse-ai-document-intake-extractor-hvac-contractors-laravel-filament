@extends('layouts.public')

@section('title', 'Modules ON/OFF — HvacDocParse Modular HVAC SaaS')

@section('content')
<section class="wrap block">
    <div class="section-head">
        <div class="eyebrow">Feature Modules</div>
        <h1>Run the business with the modules you need</h1>
        <p class="lead">Toggle modules in Filament admin. Core document workflow stays on; niche integrations start off.</p>
    </div>
    <div class="grid-2">
        @foreach($modules as $module)
            @php
                $enabled = is_array($module) ? ($module['enabled'] ?? false) : (bool) $module->enabled;
                $name = is_array($module) ? $module['name'] : $module->name;
                $desc = is_array($module) ? $module['description'] : $module->description;
                $core = is_array($module) ? ($module['core'] ?? false) : (bool) $module->core;
            @endphp
            <div class="card">
                <span class="badge {{ $enabled ? 'badge-on' : 'badge-off' }}">{{ $enabled ? 'ENABLED' : 'DISABLED' }}</span>
                @if($core)<span class="badge badge-on" style="margin-left:.35rem">CORE</span>@endif
                <h3 style="margin-top:.65rem">{{ $name }}</h3>
                <p>{{ $desc }}</p>
            </div>
        @endforeach
    </div>
</section>
@endsection
