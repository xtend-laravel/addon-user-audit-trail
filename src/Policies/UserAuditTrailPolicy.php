<?php

namespace XtendLunar\Addons\UserAuditTrail\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use XtendLunar\Addons\UserAuditTrail\Models\UserAuditTrail;

class UserAuditTrailPolicy
{
    use HandlesAuthorization;

    public function allowRestify(User $user = null): bool
    {
        return true;
    }

    public function show(User $user = null, UserAuditTrail $model): bool
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

    public function update(User $user, UserAuditTrail $model): bool
    {
        return true;
    }

    public function updateBulk(User $user, UserAuditTrail $model): bool
    {
        return false;
    }

    public function deleteBulk(User $user, UserAuditTrail $model): bool
    {
        return false;
    }

    public function delete(User $user, UserAuditTrail $model): bool
    {
        return false;
    }
}
