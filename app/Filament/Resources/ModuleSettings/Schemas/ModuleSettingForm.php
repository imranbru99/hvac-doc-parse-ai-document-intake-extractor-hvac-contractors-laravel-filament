<?php

namespace App\Filament\Resources\ModuleSettings\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ModuleSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('key')->disabled()->dehydrated(),
            TextInput::make('name')->required(),
            Textarea::make('description'),
            Toggle::make('enabled')->label('Module enabled'),
            Toggle::make('core')->disabled()->dehydrated(),
        ]);
    }
}
