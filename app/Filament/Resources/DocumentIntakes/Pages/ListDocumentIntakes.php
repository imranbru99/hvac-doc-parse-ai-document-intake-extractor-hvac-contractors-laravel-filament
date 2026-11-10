<?php

namespace App\Filament\Resources\DocumentIntakes\Pages;

use App\Filament\Resources\DocumentIntakes\DocumentIntakeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDocumentIntakes extends ListRecords
{
    protected static string $resource = DocumentIntakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
