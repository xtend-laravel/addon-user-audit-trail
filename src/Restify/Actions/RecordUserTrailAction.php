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
        return data([
            'server' => $request->server(),
            'ip' => $request->ip(),
            'device' => $this->getAgentInfo(),
        ]);

        // $userTrail = new UserAuditTrail();
        // $userTrail->user_id = $request->user()?->id;
        // $userTrail->ip_address = $request->ip();
        // $userTrail->device = $this->getAgentInfo();
        // $userTrail->location = $this->getLocation();
        // $userTrail->country = $this->getCountry();
        //
        // $userTrail->save();
        // $userTrail->events()->create([
        //     'event' => 'viewed',
        //     'visits_nb' => 1,
        //     'last_visited_at' => now(),
        // ]);
        //
        // return ok();
    }
}
