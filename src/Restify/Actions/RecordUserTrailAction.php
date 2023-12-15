<?php

namespace XtendLunar\Addons\UserAuditTrail\Restify\Actions;

use Binaryk\LaravelRestify\Actions\Action;
use Illuminate\Http\Request;
use Lunar\Models\Cart;
use XtendLunar\Addons\UserAuditTrail\Concerns\WithDevice;
use XtendLunar\Addons\UserAuditTrail\Concerns\WithLocation;
use XtendLunar\Addons\UserAuditTrail\Models\UserAuditTrail;

class RecordUserTrailAction extends Action
{
    use WithDevice;
    use WithLocation;

    public function handle(Request $request, Cart $models): \Illuminate\Http\JsonResponse
    {
        $userTrail = new UserAuditTrail();
        $userTrail->user_id = $request->user()->id;
        $userTrail->ip_address = $request->ip();
        $userTrail->device = $this->getAgentInfo();
        $userTrail->location = $this->getLocation();
        $userTrail->country = $this->getCountry();

        $userTrail->save();
        $userTrail->events()->create([
            'event' => 'viewed',
            'visits_nb' => 1,
            'last_visited_at' => now(),
        ]);

        return ok();
    }
}
