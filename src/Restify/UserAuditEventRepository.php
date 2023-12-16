<?php

namespace XtendLunar\Addons\UserAuditTrail\Restify;

use XtendLunar\Addons\RestifyApi\Restify\Repository;
use XtendLunar\Addons\UserAuditTrail\Models\UserAuditEvent;

class UserAuditEventRepository extends Repository
{
    public static string $model = UserAuditEvent::class;

    public static bool|array $public = true;
}
