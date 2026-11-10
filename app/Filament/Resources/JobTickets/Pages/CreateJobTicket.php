<?php

namespace App\Filament\Resources\JobTickets\Pages;

use App\Filament\Resources\JobTickets\JobTicketResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateJobTicket extends CreateRecord
{
    protected static string $resource = JobTicketResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['job_number'] = $data['job_number'] ?? ('JOB-'.strtoupper(Str::random(7)));

        return $data;
    }
}
