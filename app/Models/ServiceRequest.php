<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceRequest extends Model
{
    protected $fillable = [
        'ticket_number',
        'document_intake_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'service_address',
        'city',
        'state',
        'zip',
        'equipment_type',
        'equipment_model',
        'priority',
        'status',
        'problem_summary',
        'consent_sms',
        'requires_permit',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'consent_sms' => 'boolean',
            'requires_permit' => 'boolean',
        ];
    }

    public function intake(): BelongsTo
    {
        return $this->belongsTo(DocumentIntake::class, 'document_intake_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function jobTickets(): HasMany
    {
        return $this->hasMany(JobTicket::class);
    }
}
