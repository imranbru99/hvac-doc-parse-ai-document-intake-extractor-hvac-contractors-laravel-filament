<?php

namespace App\Filament\Resources\DocumentIntakes\Tables;

use App\Models\DocumentIntake;
use App\Services\DocumentIntakeWorkflow;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class DocumentIntakesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference')->searchable()->sortable(),
                TextColumn::make('source')->badge(),
                TextColumn::make('document_type')->toggleable(),
                TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    'approved' => 'success',
                    'rejected' => 'danger',
                    'needs_review' => 'warning',
                    'extracted' => 'info',
                    default => 'gray',
                }),
                TextColumn::make('confidence_score')->numeric(2)->sortable(),
                IconColumn::make('exception_flag')->boolean()->label('Exception'),
                TextColumn::make('uploader.name')->label('Uploaded by')->toggleable(),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'received' => 'Received',
                    'extracting' => 'Extracting',
                    'extracted' => 'Extracted',
                    'needs_review' => 'Needs Review',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                ]),
                SelectFilter::make('source')->options([
                    'portal' => 'Portal',
                    'email' => 'Email',
                    'upload' => 'Upload',
                    'jobber' => 'Jobber',
                ]),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('extract')
                    ->label('Run AI Extract')
                    ->icon('heroicon-o-sparkles')
                    ->action(function (DocumentIntake $record) {
                        app(DocumentIntakeWorkflow::class)->runExtraction($record);
                        Notification::make()->title('AI extraction complete')->success()->send();
                    }),
                Action::make('approve')
                    ->label('Approve')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->visible(fn (DocumentIntake $record) => $record->status !== 'approved')
                    ->form([
                        Textarea::make('notes')->label('Approval notes'),
                    ])
                    ->action(function (DocumentIntake $record, array $data) {
                        app(DocumentIntakeWorkflow::class)->approve($record, Auth::user(), $data['notes'] ?? null);
                        Notification::make()->title('Intake approved — service request & job created')->success()->send();
                    }),
                Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->form([
                        Textarea::make('notes')->label('Rejection reason')->required(),
                    ])
                    ->action(function (DocumentIntake $record, array $data) {
                        app(DocumentIntakeWorkflow::class)->reject($record, Auth::user(), $data['notes']);
                        Notification::make()->title('Intake rejected')->warning()->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
