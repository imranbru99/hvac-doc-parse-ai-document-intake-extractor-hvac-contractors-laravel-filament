<?php

namespace App\Filament\Resources\JobTickets\Pages;

use App\Filament\Resources\JobTickets\JobTicketResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJobTicket extends EditRecord
{
    protected static string $resource = JobTicketResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
