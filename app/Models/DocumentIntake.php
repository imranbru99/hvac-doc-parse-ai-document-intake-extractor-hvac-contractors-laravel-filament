<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DocumentIntake extends Model
{
    protected $fillable = [
        'reference',
        'source',
        'original_filename',
        'file_path',
        'mime_type',
        'status',
        'document_type',
        'raw_text',
        'extracted_fields',
        'validation_errors',
        'confidence_score',
        'uploaded_by',
        'assigned_reviewer_id',
        'approved_by',
        'approved_at',
        'review_notes',
        'exception_flag',
        'exception_reason',
    ];

    protected function casts(): array
    {
        return [
            'extracted_fields' => 'array',
            'validation_errors' => 'array',
            'approved_at' => 'datetime',
            'exception_flag' => 'boolean',
            'confidence_score' => 'float',
        ];
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_reviewer_id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function approval(): HasOne
    {
        return $this->hasOne(Approval::class);
    }

    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function jobTickets(): HasMany
    {
        return $this->hasMany(JobTicket::class);
    }
}
