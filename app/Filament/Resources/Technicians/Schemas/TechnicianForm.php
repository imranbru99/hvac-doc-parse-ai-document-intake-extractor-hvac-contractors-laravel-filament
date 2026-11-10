<?php

namespace App\Filament\Resources\Technicians\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TechnicianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required(),
            TextInput::make('email')->email(),
            TextInput::make('phone'),
            TextInput::make('license_number'),
            TextInput::make('region'),
            Select::make('status')->options([
                'available' => 'Available',
                'on_job' => 'On Job',
                'off_duty' => 'Off Duty',
            ])->required(),
            TagsInput::make('skills'),
        ]);
    }
}
