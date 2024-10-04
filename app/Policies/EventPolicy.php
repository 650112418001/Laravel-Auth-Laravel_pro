<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function adminOnly(Admin $admin)
    {
        // เช็คว่าผู้ใช้นั้นเป็น admin หรือไม่
        return $admin->isAdmin();
    }

}
