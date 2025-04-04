<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    public const TYPE_REGISTERED = 'Registered';
    public const TYPE_FAILED = 'Failed';
    public const TYPE_AUDIT = 'Audit';
    protected $fillable = ['event_type', 'description', 'user_id', 'ip_address', 'user_agent', 'properties'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
