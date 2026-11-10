<?php

namespace App\Filament\Resources\DocumentIntakes\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DocumentIntakeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Intake')
                    ->columns(2)
                    ->schema([
                        TextInput::make('reference')->disabled()->dehydrated(),
                        Select::make('source')
                            ->options([
                                'portal' => 'Portal',
                                'email' => 'Email',
                                'upload' => 'Upload',
                                'jobber' => 'Jobber',
                            ])
                            ->required(),
                        TextInput::make('original_filename')->label('Filename'),
                        TextInput::make('mime_type'),
                        Select::make('document_type')
                            ->options([
                                'service_form' => 'Service Form',
                                'warranty' => 'Warranty',
                                'invoice' => 'Invoice',
                                'work_order' => 'Work Order',
                                'attachment' => 'Attachment',
                            ]),
                        Select::make('status')
                            ->options([
                                'received' => 'Received',
                                'extracting' => 'Extracting',
                                'extracted' => 'Extracted',
                                'needs_review' => 'Needs Review',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                                'routed' => 'Routed',
                            ])
                            ->required(),
                        TextInput::make('confidence_score')->numeric()->step(0.01),
                        Toggle::make('exception_flag'),
                        TextInput::make('exception_reason')->columnSpanFull(),
                        Textarea::make('raw_text')->rows(5)->columnSpanFull(),
                        Textarea::make('review_notes')->rows(3)->columnSpanFull(),
                        KeyValue::make('extracted_fields')->columnSpanFull(),
                        KeyValue::make('validation_errors')->columnSpanFull(),
                    ]),
            ]);
    }
}
