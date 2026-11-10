<?php

namespace App\Filament\Resources\JobTickets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class JobTicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('job_number')->searchable()->sortable(),
                TextColumn::make('title')->limit(40)->searchable(),
                TextColumn::make('technician.name')->label('Technician'),
                TextColumn::make('status')->badge(),
                TextColumn::make('scheduled_at')->dateTime(),
                IconColumn::make('calendar_synced')->boolean(),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])])
            ->defaultSort('created_at', 'desc');
    }
}
