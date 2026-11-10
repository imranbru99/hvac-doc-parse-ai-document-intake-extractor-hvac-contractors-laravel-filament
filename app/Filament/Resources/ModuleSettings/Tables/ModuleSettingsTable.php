<?php

namespace App\Filament\Resources\ModuleSettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ModuleSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('key')->badge(),
                TextColumn::make('description')->limit(50),
                IconColumn::make('core')->boolean(),
                ToggleColumn::make('enabled'),
            ])
            ->recordActions([EditAction::make()])
            ->defaultSort('name');
    }
}
