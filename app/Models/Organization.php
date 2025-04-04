<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'organization_type_id',
        'owner_user_id',
    ];

    /**
     * Get the owner of the organization.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    /**
     * Get the users that belong to the organization.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the type of the organization.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(OrganizationType::class, 'organization_type_id');
    }

     /**
     * Get the activities associated with this organization.
     */
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
