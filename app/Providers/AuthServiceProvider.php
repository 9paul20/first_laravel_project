<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Post;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use App\Policies\RolePolicy;
use App\Policies\PermissionPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        User::class => UserPolicy::class,
        // 'App\Post' => 'App\Policies\PostPolicy',
        // 'App\User' => 'App\Policies\UserPolicy',
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}