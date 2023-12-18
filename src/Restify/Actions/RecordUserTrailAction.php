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
    use WithDevice, WithLocation;

    public function handle(Request $request, Collection $models): \Illuminate\Http\JsonResponse
    {
        $client_ip = $request->server('HTTP_CLIENT_IP_ADDRESS');
        $data = $this->userAuditTrailData(
            request: $request,
            client_ip: $client_ip,
        );

        UserAuditTrail::query()->updateOrCreate([
           'ip_address' => $client_ip,
        ], $data);

        return data([
            'clientIp' => $client_ip,
            'userId' => $data['user_id'],
            'userType' => $data['user_id'] ? 'customer' : 'guest',
            'referer' => $request->server('HTTP_REFERER'),
            'device' => $data['device'],
            'country' => $data['country'],
            'region' => $data['region'],
        ]);
    }

    private function userAuditTrailData(Request $request, string $client_ip): array
    {
        $device = $this->getAgentInfo();
        $location = $this->getLocation($client_ip);

        return [
            'user_id' => $request->user()?->id,
            'device' => $device,
            'location' => $location,
            'country' => $location['country'],
            'region' => $location['region_name'] ?? 'N/A',
            'route_tracking' => $request->routeTracking,
            'estimated_download_speed' => $request->estimatedDownloadSpeed,
        ];
    }
}
