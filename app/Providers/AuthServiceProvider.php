<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\EventPolicy;
use App\Models\Event;
use App\Models\Admin;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Event::class => EventPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-only', function ($user) {
            return $user instanceof Admin; // ตรวจสอบว่าเป็นอินสแตนซ์ของ Admin หรือไม่
        });

    }

}
