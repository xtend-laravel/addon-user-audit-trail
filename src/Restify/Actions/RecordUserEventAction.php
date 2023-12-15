<?php

namespace XtendLunar\Addons\UserAuditTrail\Restify\Actions;

use Binaryk\LaravelRestify\Actions\Action;
use Illuminate\Http\Request;
use XtendLunar\Addons\UserAuditTrail\Models\UserAuditTrail;

class RecordUserEventAction extends Action
{
    public function handle(Request $request, UserAuditTrail $models): \Illuminate\Http\JsonResponse
    {
        $userTrail = $models;

        $userTrail->events()->create([
            'event' => $request->event,
            'visits_nb' => 1,
            'last_visited_at' => now(),
        ]);

        return ok();
    }
}
