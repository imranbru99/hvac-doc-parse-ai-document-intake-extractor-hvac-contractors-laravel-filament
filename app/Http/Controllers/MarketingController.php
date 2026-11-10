<?php

namespace App\Http\Controllers;

use App\Models\DocumentIntake;
use App\Models\JobTicket;
use App\Models\ModuleSetting;
use App\Models\ServiceRequest;
use App\Models\Technician;
use App\Support\ModuleManager;
use Illuminate\View\View;

class MarketingController extends Controller
{
    public function home(): View
    {
        return view('public.home', [
            'modules' => ModuleManager::all(),
            'stats' => [
                'intakes' => DocumentIntake::count(),
                'open_requests' => ServiceRequest::where('status', 'open')->count(),
                'technicians' => Technician::count(),
                'jobs' => JobTicket::count(),
            ],
        ]);
    }

    public function features(): View
    {
        return view('public.features', [
            'modules' => ModuleManager::all(),
        ]);
    }

    public function workflow(): View
    {
        return view('public.workflow', [
            'modules' => ModuleManager::all(),
        ]);
    }

    public function modules(): View
    {
        $dbModules = ModuleSetting::query()->orderByDesc('core')->orderBy('name')->get();

        return view('public.modules', [
            'modules' => $dbModules->isNotEmpty() ? $dbModules : ModuleManager::all()->values(),
        ]);
    }

    public function pricing(): View
    {
        return view('public.pricing');
    }

    public function demo(): View
    {
        return view('public.demo', [
            'users' => [
                ['role' => 'Admin', 'email' => 'admin@hvacdocparse.test', 'password' => 'password'],
                ['role' => 'Owner / Ops Lead', 'email' => 'owner@hvacdocparse.test', 'password' => 'password'],
                ['role' => 'Staff', 'email' => 'staff@hvacdocparse.test', 'password' => 'password'],
                ['role' => 'Technician', 'email' => 'tech@hvacdocparse.test', 'password' => 'password'],
                ['role' => 'Customer', 'email' => 'customer@hvacdocparse.test', 'password' => 'password'],
            ],
        ]);
    }

    public function integrations(): View
    {
        return view('public.integrations');
    }
}
