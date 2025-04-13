<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'is_operational',
        'response_time',
        'status_code',
        'response_data',
    ];

    protected $casts = [
        'is_operational' => 'boolean',
        'response_data' => 'array',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
