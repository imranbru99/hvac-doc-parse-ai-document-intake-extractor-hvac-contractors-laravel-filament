<?php

namespace App\Filament\Resources\DocumentIntakes;

use App\Filament\Resources\DocumentIntakes\Pages\CreateDocumentIntake;
use App\Filament\Resources\DocumentIntakes\Pages\EditDocumentIntake;
use App\Filament\Resources\DocumentIntakes\Pages\ListDocumentIntakes;
use App\Filament\Resources\DocumentIntakes\Schemas\DocumentIntakeForm;
use App\Filament\Resources\DocumentIntakes\Tables\DocumentIntakesTable;
use App\Models\DocumentIntake;
use App\Support\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DocumentIntakeResource extends Resource
{
    protected static ?string $model = DocumentIntake::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|UnitEnum|null $navigationGroup = 'Document Operations';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Document Intakes';

    protected static ?string $modelLabel = 'Document Intake';

    public static function shouldRegisterNavigation(): bool
    {
        return ModuleManager::enabled('document_intake');
    }

    public static function form(Schema $schema): Schema
    {
        return DocumentIntakeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DocumentIntakesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDocumentIntakes::route('/'),
            'create' => CreateDocumentIntake::route('/create'),
            'edit' => EditDocumentIntake::route('/{record}/edit'),
        ];
    }
}
