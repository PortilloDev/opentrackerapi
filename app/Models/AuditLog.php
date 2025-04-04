<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AuditLog extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'event',
        'auditable_type',
        'auditable_id',
        'old_values',
        'new_values',
        'url',
        'ip_address',
        'user_agent',
        'tags',
        'organization_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'tags' => 'array',
    ];

    /**
     * Get the user that performed the action.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the organization context where the action occurred.
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the auditable entity.
     */
    public function auditable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope a query to only include logs for a specific user.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to only include logs for a specific event type.
     */
    public function scopeForEvent($query, $event)
    {
        return $query->where('event', $event);
    }

    /**
     * Scope a query to only include logs for a specific model type.
     */
    public function scopeForModel($query, $modelType)
    {
        return $query->where('auditable_type', $modelType);
    }

    /**
     * Scope a query to only include logs for a specific model instance.
     */
    public function scopeForRecord($query, $modelType, $modelId)
    {
        return $query->where('auditable_type', $modelType)
                     ->where('auditable_id', $modelId);
    }

    /**
     * Scope a query to only include logs with specific tags.
     */
    public function scopeWithTags($query, $tags)
    {
        if (is_string($tags)) {
            $tags = [$tags];
        }
        
        return $query->where(function ($query) use ($tags) {
            foreach ($tags as $tag) {
                $query->orWhereJsonContains('tags', $tag);
            }
        });
    }

    /**
     * Scope a query to only include logs for a specific organization.
     */
    public function scopeForOrganization($query, $organizationId)
    {
        return $query->where('organization_id', $organizationId);
    }

    /**
     * Get a human-readable description of the audit log entry.
     */
    public function getDescriptionAttribute()
    {
        $userName = $this->user ? $this->user->name : 'Sistema';
        $modelName = class_basename($this->auditable_type);
        
        switch ($this->event) {
            case 'created':
                return "{$userName} creó un nuevo {$modelName}";
            case 'updated':
                return "{$userName} actualizó {$modelName}";
            case 'deleted':
                return "{$userName} eliminó {$modelName}";
            case 'restored':
                return "{$userName} restauró {$modelName}";
            case 'login':
                return "{$userName} inició sesión";
            case 'logout':
                return "{$userName} cerró sesión";
            case 'login_failed':
                $identifier = $this->new_values['email'] ?? 'usuario desconocido';
                return "Intento fallido de inicio de sesión para {$identifier}";
            default:
                return "{$userName} realizó {$this->event} en {$modelName}";
        }
    }

    /**
     * Get the changes made in this audit log entry.
     */
    public function getChangesAttribute()
    {
        if ($this->event !== 'updated') {
            return [];
        }
        
        $changes = [];
        
        foreach ($this->new_values as $key => $newValue) {
            if (isset($this->old_values[$key]) && $this->old_values[$key] !== $newValue) {
                $changes[$key] = [
                    'old' => $this->old_values[$key],
                    'new' => $newValue
                ];
            }
        }
        
        return $changes;
    }
}
