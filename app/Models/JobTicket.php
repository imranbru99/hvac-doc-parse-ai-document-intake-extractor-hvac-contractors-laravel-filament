<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobTicket extends Model
{
    protected $fillable = [
        'job_number',
        'service_request_id',
        'document_intake_id',
        'technician_id',
        'title',
        'description',
        'status',
        'scheduled_at',
        'external_jobber_id',
        'external_servicetitan_id',
        'calendar_synced',
        'meta',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'calendar_synced' => 'boolean',
            'meta' => 'array',
        ];
    }

    public function serviceRequest(): BelongsTo
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    public function intake(): BelongsTo
    {
        return $this->belongsTo(DocumentIntake::class, 'document_intake_id');
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(Technician::class);
    }
}
