<?php

namespace App\Filament\Resources\AuditLogs\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AuditLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->dateTime()->sortable()->label('When'),
                TextColumn::make('action')->searchable()->badge(),
                TextColumn::make('user.name')->label('Actor'),
                TextColumn::make('entity_type')->limit(40)->toggleable(),
                TextColumn::make('entity_id')->label('Entity ID')->toggleable(),
                TextColumn::make('ip_address')->toggleable(),
                TextColumn::make('payload')->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state) : (string) $state)->limit(60),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
