<?php

use Illuminate\Support\Facades\Route;
use Lunar\Hub\Http\Middleware\Authenticate;
use XtendLunar\Addons\UserAuditTrail\Livewire\Pages\UserAuditTrailIndex;

Route::prefix(config('lunar-hub.system.path'))
    ->middleware(['web', Authenticate::class, 'can:settings:core'])
    ->group(function () {
        Route::get('/user-audit-trail', UserAuditTrailIndex::class)->name('hub.user-audit-trail.index');
    });
