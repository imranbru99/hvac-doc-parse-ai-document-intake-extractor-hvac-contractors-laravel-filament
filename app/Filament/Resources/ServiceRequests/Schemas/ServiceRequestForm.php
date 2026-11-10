<?php

namespace App\Filament\Resources\ServiceRequests\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Service Request')->columns(2)->schema([
                TextInput::make('ticket_number')->required(),
                Select::make('priority')->options([
                    'low' => 'Low',
                    'normal' => 'Normal',
                    'high' => 'High',
                    'urgent' => 'Urgent',
                ])->required(),
                Select::make('status')->options([
                    'open' => 'Open',
                    'scheduled' => 'Scheduled',
                    'closed' => 'Closed',
                    'cancelled' => 'Cancelled',
                ])->required(),
                TextInput::make('customer_name')->required(),
                TextInput::make('customer_email')->email(),
                TextInput::make('customer_phone'),
                TextInput::make('service_address')->columnSpanFull(),
                TextInput::make('city'),
                TextInput::make('state'),
                TextInput::make('zip'),
                TextInput::make('equipment_type'),
                TextInput::make('equipment_model'),
                Toggle::make('consent_sms'),
                Toggle::make('requires_permit'),
                Textarea::make('problem_summary')->columnSpanFull(),
            ]),
        ]);
    }
}
