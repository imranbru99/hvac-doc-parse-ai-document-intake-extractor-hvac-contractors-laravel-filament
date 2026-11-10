<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleSetting extends Model
{
    protected $fillable = [
        'key',
        'name',
        'description',
        'enabled',
        'core',
        'meta',
    ];

    protected function casts(): array
    {
        return [
            'enabled' => 'boolean',
            'core' => 'boolean',
            'meta' => 'array',
        ];
    }
}
