<?php

namespace App\Filament\Resources\ServiceRequests\Pages;

use App\Filament\Resources\ServiceRequests\ServiceRequestResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateServiceRequest extends CreateRecord
{
    protected static string $resource = ServiceRequestResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['ticket_number'] = $data['ticket_number'] ?? ('SR-'.strtoupper(Str::random(7)));
        $data['created_by'] = Auth::id();

        return $data;
    }
}
