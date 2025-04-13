<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_group_id',
        'name',
        'description',
        'url',
        'method',
        'headers',
        'payload',
        'timeout',
        'expected_status_code',
        'display_order',
        'active',
    ];

    protected $casts = [
        'headers' => 'array',
        'payload' => 'array',
        'active' => 'boolean',
    ];

    public function serviceGroup(): BelongsTo
    {
        return $this->belongsTo(ServiceGroup::class);
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(ServiceStatus::class);
    }

    /**
     * Get the incidents that affect this service
     */
    public function incidents(): BelongsToMany
    {
        return $this->belongsToMany(Incident::class, 'incident_service');
    }

    public function latestStatus()
    {
        return $this->hasOne(ServiceStatus::class)->latestOfMany();
    }
}
