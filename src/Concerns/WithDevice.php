<?php

namespace XtendLunar\Addons\UserAuditTrail\Concerns;

use Jenssegers\Agent\Agent;

trait WithDevice
{
    protected function getAgentInfo(): array
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $platform = $agent->platform();
        return [
            'platform' => $agent->platform(),
            'platform_version' => $agent->version($platform),
            'browser' => $browser,
            'browser_version' => $agent->version($browser),
            'device' => $agent->device(),
            'deviceType' => $agent->deviceType(),
        ];
    }
}
