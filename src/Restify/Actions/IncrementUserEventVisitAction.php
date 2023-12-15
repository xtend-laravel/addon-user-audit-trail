<?php

namespace XtendLunar\Addons\UserAuditTrail\Restify\Actions;

use Binaryk\LaravelRestify\Actions\Action;
use Illuminate\Http\Request;
use XtendLunar\Addons\UserAuditTrail\Models\UserAuditTrail;

class IncrementUserEventVisitAction extends Action
{
    public function handle(Request $request, UserAuditTrail $models): \Illuminate\Http\JsonResponse
    {
        $userTrail = $models;
        $userTrail->events()->where('event', 'viewed')->increment('visits_nb');

        return ok();
    }
}
