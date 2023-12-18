<?php

namespace XtendLunar\Addons\UserAuditTrail\Restify\Getters;

use Binaryk\LaravelRestify\Getters\Getter;
use Binaryk\LaravelRestify\Http\Requests\GetterRequest;
use Illuminate\Http\JsonResponse;
use XtendLunar\Addons\UserAuditTrail\Models\UserAuditTrail;

class UserTrailGetter extends Getter
{
    public static $uriKey = 'user-trail';

    public function handle(GetterRequest $request): JsonResponse
    {
        $clientIp = $request->server('HTTP_CLIENT_IP_ADDRESS');

        $userTrail = UserAuditTrail::query()->firstWhere('ip_address', $clientIp);

        if (!$userTrail) {
            return ok();
        }

        return data([
            'userId' => $userTrail->user_id,
            'routeTracking' => $userTrail->route_tracking,
            'estimatedDownloadSpeed' => $userTrail->estimated_download_speed,
        ]);
    }
}
