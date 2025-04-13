<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'impact',
        'started_at',
        'resolved_at',
        'visible',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'resolved_at' => 'datetime',
        'visible' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
    
    /**
     * Get the services affected by this incident
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'incident_service');
    }

    public function isResolved(): bool
    {
        return $this->status === 'resolved';
    }
    
    public function scopeActive($query)
    {
        return $query->where('status', '!=', 'resolved');
    }
}
