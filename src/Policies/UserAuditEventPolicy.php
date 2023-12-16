<?php

namespace XtendLunar\Addons\UserAuditTrail\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use XtendLunar\Addons\UserAuditTrail\Models\UserAuditEvent;

class UserAuditEventPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, UserAuditEvent $model): bool
    {
        return true;
    }

    public function store(User $user): bool
    {
        return true;
    }

    public function storeBulk(User $user): bool
    {
        return false;
    }

    public function update(User $user, UserAuditEvent $model): bool
    {
        return true;
    }

    public function updateBulk(User $user, UserAuditEvent $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, UserAuditEvent $model): bool
    {
        return false;
    }

    public function delete(User $user, UserAuditEvent $model): bool
    {
        return false;
    }
}
