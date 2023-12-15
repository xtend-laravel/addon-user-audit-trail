<?php

namespace UserAuditTrail\Database\Seeders;

use Illuminate\Database\Seeder;
use XtendLunar\Addons\UserAuditTrail\Models\UserAuditEvent;
use XtendLunar\Addons\UserAuditTrail\Models\UserAuditTrail;

class UserAuditTrailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserAuditTrail::factory()->count(50)->has(
            UserAuditEvent::factory()->count(rand(2, 10)),
        )->create();
    }
}
