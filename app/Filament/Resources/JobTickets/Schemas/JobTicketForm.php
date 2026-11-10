<?php

namespace App\Filament\Resources\JobTickets\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class JobTicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('job_number')->required(),
            TextInput::make('title')->required()->columnSpanFull(),
            Textarea::make('description')->columnSpanFull(),
            Select::make('technician_id')->relationship('technician', 'name')->searchable()->preload(),
            Select::make('status')->options([
                'draft' => 'Draft',
                'scheduled' => 'Scheduled',
                'in_progress' => 'In Progress',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
            ])->required(),
            DateTimePicker::make('scheduled_at'),
            Toggle::make('calendar_synced'),
            TextInput::make('external_jobber_id'),
            TextInput::make('external_servicetitan_id'),
        ]);
    }
}
