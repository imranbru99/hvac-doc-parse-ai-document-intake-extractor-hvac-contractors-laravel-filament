<?php

namespace App\Filament\Resources\DocumentIntakes\Pages;

use App\Filament\Resources\DocumentIntakes\DocumentIntakeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDocumentIntake extends EditRecord
{
    protected static string $resource = DocumentIntakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
