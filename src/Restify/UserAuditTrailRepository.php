<?php

namespace XtendLunar\Addons\UserAuditTrail\Restify;

use Binaryk\LaravelRestify\Fields\HasMany;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use XtendLunar\Addons\RestifyApi\Restify\Repository;
use XtendLunar\Addons\UserAuditTrail\Restify\Actions\IncrementUserEventVisitAction;
use XtendLunar\Addons\UserAuditTrail\Restify\Actions\RecordUserEventAction;
use XtendLunar\Addons\UserAuditTrail\Restify\Actions\RecordUserTrailAction;
use XtendLunar\Addons\UserAuditTrail\Restify\Presenters\UserAuditTrailPresenter;

class UserAuditTrailRepository extends Repository
{
    public static string $presenter = UserAuditTrailPresenter::class;

    public static bool|array $public = true;

    public static function related(): array
    {
        return [
            HasMany::make('events', UserAuditEventRepository::class),
        ];
    }

    public function actions(RestifyRequest $request): array
    {
        return [
            RecordUserTrailAction::new()->onlyOnIndex(),
            RecordUserEventAction::new()->onlyOnShow(),
            IncrementUserEventVisitAction::new()->onlyOnShow(),
        ];
    }
}
