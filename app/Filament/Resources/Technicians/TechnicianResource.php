<?php

namespace App\Filament\Resources\Technicians;

use App\Filament\Resources\Technicians\Pages\CreateTechnician;
use App\Filament\Resources\Technicians\Pages\EditTechnician;
use App\Filament\Resources\Technicians\Pages\ListTechnicians;
use App\Filament\Resources\Technicians\Schemas\TechnicianForm;
use App\Filament\Resources\Technicians\Tables\TechniciansTable;
use App\Models\Technician;
use App\Support\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TechnicianResource extends Resource
{
    protected static ?string $model = Technician::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWrenchScrewdriver;

    protected static string|UnitEnum|null $navigationGroup = 'Field Operations';

    protected static ?int $navigationSort = 2;

    public static function shouldRegisterNavigation(): bool
    {
        return ModuleManager::enabled('technicians');
    }

    public static function form(Schema $schema): Schema
    {
        return TechnicianForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TechniciansTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTechnicians::route('/'),
            'create' => CreateTechnician::route('/create'),
            'edit' => EditTechnician::route('/{record}/edit'),
        ];
    }
}
