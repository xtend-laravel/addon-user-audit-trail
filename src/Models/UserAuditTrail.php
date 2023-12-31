<?php

namespace XtendLunar\Addons\UserAuditTrail\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use UserAuditTrail\Database\Factories\UserAuditTrailFactory;

class UserAuditTrail extends Model
{
    use HasFactory;

    protected $table = 'xtend_user_audit_trail';

    protected $casts = [
        'device' => 'array',
        'location' => 'array',
        'route_tracking' => 'array',
        'estimated_download_speed' => 'float',
    ];

    protected $fillable = [
        'user_id',
        'ip_address',
        'country',
        'region',
        'device',
        'location',
        'route_tracking',
        'estimated_download_speed',
    ];

    protected static function newFactory(): UserAuditTrailFactory
    {
        return UserAuditTrailFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(UserAuditEvent::class);
    }
}
