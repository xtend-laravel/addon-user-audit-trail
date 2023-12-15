<?php

namespace XtendLunar\Addons\UserAuditTrail;

use Binaryk\LaravelRestify\Traits\InteractsWithRestifyRepositories;
use CodeLabX\XtendLaravel\Base\XtendAddonProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Livewire\Livewire;
use Lunar\Hub\Facades\Menu;
use Lunar\Hub\Menu\MenuLink;
use XtendLunar\Addons\UserAuditTrail\Livewire\AuditTrail\Table;

class UserAuditTrailProvider extends XtendAddonProvider
{
    use InteractsWithRestifyRepositories;

    protected $policies = [

    ];

    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../route/hub.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'xtend-lunar-user-audit-trail');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'xtend-lunar::user-audit-trail');
        $this->loadRestifyFrom(__DIR__.'/Restify', __NAMESPACE__.'\\Restify\\');
        $this->mergeConfigFrom(__DIR__.'/../config/user-audit-trail.php', 'user-audit-trail');

        $this->registerLivewireComponents();
    }

    public function boot()
    {
        $this->registerPolicies();
        Blade::componentNamespace('XtendLunar\\Addons\\UserAuditTrail\\Components', 'xtend-lunar::user-audit-trail');

        Menu::slot('sidebar')
            ->group('hub.configure')
            ->addItem(function (MenuLink $item) {
                return $item->name('User Audit Trail')
                    ->handle('hub.user-audit-trail')
                    ->route('hub.user-audit-trail.index')
                    ->icon('users');
            });

        $this->publishes([
           __DIR__.'/../config/user-audit-trail.php' => config_path('user-audit-trail.php'),
        ]);
    }

    protected function registerLivewireComponents(): void
    {
        Livewire::component('xtend-lunar::user-audit-trail.products.table', Table::class);
    }

    protected function registerPolicies()
    {
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }
}
