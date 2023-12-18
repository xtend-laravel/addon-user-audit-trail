<?php

namespace XtendLunar\Addons\UserAuditTrail\Restify\Actions;

use Binaryk\LaravelRestify\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use XtendLunar\Addons\UserAuditTrail\Concerns\WithDevice;
use XtendLunar\Addons\UserAuditTrail\Concerns\WithLocation;
use XtendLunar\Addons\UserAuditTrail\Models\UserAuditTrail;

class RecordUserTrailAction extends Action
{
    use WithDevice;
    use WithLocation;

    public function handle(Request $request, Collection $models): \Illuminate\Http\JsonResponse
    {
        $clientIp = $request->server('HTTP_CLIENT_IP_ADDRESS');

        UserAuditTrail::query()->updateOrCreate([
            'ip_address' => $clientIp,
        ], [
            'user_id' => $request->user()?->id,
            'device' => $this->getAgentInfo(),
            'location' => $this->getLocation($clientIp),
            'country' => $this->getCountry($clientIp),
            'route_tracking' => $request->routeTracking,
            'estimated_download_speed' => $request->estimatedDownloadSpeed,
        ]);

        return ok();
    }
}
