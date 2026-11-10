<?php

namespace App\Filament\Resources\DocumentIntakes\Pages;

use App\Filament\Resources\DocumentIntakes\DocumentIntakeResource;
use App\Services\DocumentIntakeWorkflow;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateDocumentIntake extends CreateRecord
{
    protected static string $resource = DocumentIntakeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['reference'] = $data['reference'] ?? ('INH-'.strtoupper(Str::random(8)));
        $data['uploaded_by'] = Auth::id();
        $data['status'] = $data['status'] ?? 'received';

        return $data;
    }

    protected function afterCreate(): void
    {
        app(DocumentIntakeWorkflow::class)->runExtraction($this->record);
    }
}
