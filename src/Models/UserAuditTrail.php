<?php

namespace XtendLunar\Addons\UserAuditTrail\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAuditTrail extends Model
{
    use HasFactory;
    
    protected $table = 'xtend_user_audit_trail';

    protected $casts = [
        'device' => 'array',
        'location' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
