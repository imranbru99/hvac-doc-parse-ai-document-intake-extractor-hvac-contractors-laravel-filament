<?php

namespace App\Filament\Widgets;

use App\Models\DocumentIntake;
use App\Models\JobTicket;
use App\Models\ServiceRequest;
use App\Models\Technician;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HvacStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Document Intakes', DocumentIntake::count())
                ->description('Total received packets')
                ->icon('heroicon-o-document-text'),
            Stat::make('Needs Review', DocumentIntake::where('status', 'needs_review')->count())
                ->description('Awaiting human approval')
                ->color('warning')
                ->icon('heroicon-o-exclamation-triangle'),
            Stat::make('Open Service Requests', ServiceRequest::where('status', 'open')->count())
                ->description('Active customer jobs')
                ->icon('heroicon-o-clipboard-document-list'),
            Stat::make('Available Technicians', Technician::where('status', 'available')->count())
                ->description(JobTicket::count().' job tickets total')
                ->icon('heroicon-o-wrench-screwdriver'),
        ];
    }
}
