<?php

namespace UserAuditTrail\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use XtendLunar\Addons\UserAuditTrail\Models\UserAuditEvent;

class UserAuditEventFactory extends Factory
{
    protected $model = UserAuditEvent::class;

    public function definition(): array
    {
        return [

        ];
    }
}
