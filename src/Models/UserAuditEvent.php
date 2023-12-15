<?php

namespace XtendLunar\Addons\UserAuditTrail\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserAuditEvent extends Model
{
    protected $table = 'xtend_user_audit_events';

    protected $casts = [
        'data' => 'array',
        'exception' => 'array',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(UserAuditEvent::class);
    }
}
