<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'organization_id',
        'activity_type_id',
        'title',
        'start_time',
        'duration',
        'distance',
        'elevation_gain',
        'avg_speed',
        'max_speed',
        'avg_heart_rate',
        'max_heart_rate',
        'avg_power',
        'max_power',
        'calories',
        'device_id',
        'route_map',
        'data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_time' => 'datetime',
        'data' => 'array',
        'duration' => 'integer',
        'distance' => 'float',
        'elevation_gain' => 'float',
        'avg_speed' => 'float',
        'max_speed' => 'float',
        'avg_heart_rate' => 'integer',
        'max_heart_rate' => 'integer',
        'avg_power' => 'integer',
        'max_power' => 'integer',
        'calories' => 'integer',
    ];

    /**
     * Get the user that owns the activity.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the organization associated with the activity.
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the activity type.
     */
    public function activityType(): BelongsTo
    {
        return $this->belongsTo(ActivityType::class);
    }

    /**
     * Get the device used to record the activity.
     */
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    /**
     * Calculate pace in minutes per kilometer.
     * 
     * @return float|null
     */
    public function getPaceAttribute(): ?float
    {
        if (!$this->distance || !$this->duration || $this->distance <= 0) {
            return null;
        }
        
        // Convert m/s to min/km
        // 1 m/s = 16.6667 min/km
        $paceInSecondsPerKm = ($this->duration / ($this->distance / 1000));
        return $paceInSecondsPerKm / 60; // Convert to minutes
    }

    /**
     * Get formatted pace as MM:SS per km.
     * 
     * @return string|null
     */
    public function getFormattedPaceAttribute(): ?string
    {
        $pace = $this->getPaceAttribute();
        
        if ($pace === null) {
            return null;
        }
        
        $minutes = floor($pace);
        $seconds = round(($pace - $minutes) * 60);
        
        return sprintf('%d:%02d', $minutes, $seconds);
    }

    /**
     * Get speed in km/h.
     * 
     * @return float|null
     */
    public function getSpeedKmhAttribute(): ?float
    {
        if (!$this->avg_speed) {
            return null;
        }
        
        // Convert m/s to km/h
        return $this->avg_speed * 3.6;
    }

    /**
     * Get distance in kilometers.
     * 
     * @return float|null
     */
    public function getDistanceKmAttribute(): ?float
    {
        if (!$this->distance) {
            return null;
        }
        
        // Convert meters to kilometers
        return $this->distance / 1000;
    }

    /**
     * Get formatted duration as HH:MM:SS.
     * 
     * @return string|null
     */
    public function getFormattedDurationAttribute(): ?string
    {
        if (!$this->duration) {
            return null;
        }
        
        $hours = floor($this->duration / 3600);
        $minutes = floor(($this->duration % 3600) / 60);
        $seconds = $this->duration % 60;
        
        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
        } else {
            return sprintf('%d:%02d', $minutes, $seconds);
        }
    }
}