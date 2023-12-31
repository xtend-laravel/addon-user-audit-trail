<?php

namespace XtendLunar\Addons\UserAuditTrail\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use UserAuditTrail\Database\Factories\UserAuditEventFactory;

class UserAuditEvent extends Model
{
    use HasFactory;

    protected $table = 'xtend_user_audit_events';

    protected $casts = [
        'data' => 'array',
        'exception' => 'array',
    ];

    protected static function newFactory(): UserAuditEventFactory
    {
        return UserAuditEventFactory::new();
    }
}
