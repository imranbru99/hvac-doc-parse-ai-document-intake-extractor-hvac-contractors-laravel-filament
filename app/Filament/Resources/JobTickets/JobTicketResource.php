<?php

namespace App\Filament\Resources\JobTickets;

use App\Filament\Resources\JobTickets\Pages\CreateJobTicket;
use App\Filament\Resources\JobTickets\Pages\EditJobTicket;
use App\Filament\Resources\JobTickets\Pages\ListJobTickets;
use App\Filament\Resources\JobTickets\Schemas\JobTicketForm;
use App\Filament\Resources\JobTickets\Tables\JobTicketsTable;
use App\Models\JobTicket;
use App\Support\ModuleManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JobTicketResource extends Resource
{
    protected static ?string $model = JobTicket::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTicket;

    protected static string|UnitEnum|null $navigationGroup = 'Field Operations';

    protected static ?int $navigationSort = 3;

    public static function shouldRegisterNavigation(): bool
    {
        return ModuleManager::enabled('job_tickets');
    }

    public static function form(Schema $schema): Schema
    {
        return JobTicketForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JobTicketsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJobTickets::route('/'),
            'create' => CreateJobTicket::route('/create'),
            'edit' => EditJobTicket::route('/{record}/edit'),
        ];
    }
}
