<?php

namespace App\Providers;

use App\Services\Auth\JwtGuard;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('profile.update', 'App\Policies\ProfilePolicy@update');
        Gate::define('cafe.store', 'App\Policies\CafeProfilePolicy@store');
        Gate::define('cafe.update', 'App\Policies\CafeProfilePolicy@update');
        Gate::define('branch.update', 'App\Policies\BranchPolicy@update');
        Gate::define('staff.create', 'App\Policies\StaffPolicy@create');
        Gate::define('staff.update', 'App\Policies\StaffPolicy@update');
        Gate::define('menu.delete', 'App\Policies\MenuPolicy@delete');
    }
}
