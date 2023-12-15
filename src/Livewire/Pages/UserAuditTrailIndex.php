<?php

namespace XtendLunar\Addons\UserAuditTrail\Livewire\Pages;

use Livewire\Component;

class UserAuditTrailIndex extends Component
{
    public function render()
    {
        return view('xtend-lunar-user-audit-trail::livewire.pages.merchant-products.index')
            ->layout('adminhub::layouts.app');
    }
}
