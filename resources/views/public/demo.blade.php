@extends('layouts.public')

@section('title', 'Demo Users — HvacDocParse Laravel Filament Login')

@section('content')
<section class="wrap block">
    <div class="section-head">
        <div class="eyebrow">Try the product</div>
        <h1>Demo users for every role</h1>
        <p class="lead">Password for all demo accounts: <strong>password</strong>. Admin panel: <a href="{{ url('/admin') }}">/admin</a></p>
    </div>
    <table class="demo">
        <thead>
            <tr><th>Role</th><th>Email</th><th>Password</th></tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user['role'] }}</td>
                    <td><code>{{ $user['email'] }}</code></td>
                    <td><code>{{ $user['password'] }}</code></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="cta-row" style="margin-top:1.5rem">
        <a class="btn btn-primary" href="{{ url('/admin/login') }}">Go to Filament Login</a>
    </div>
</section>
@endsection
