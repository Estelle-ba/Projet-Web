<?php

namespace App\Providers;

use App\Models\comment_common_task;
use App\Models\CommonLife;
use App\Models\UserSchool;
use App\Policies\CommentPolicy;
use App\Policies\CommonLifePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', function ($user) {
            $roleUser = UserSchool::where('user_id',$user->id)->get()->firstOrFail();
            return $roleUser->role == "admin";
        });
        Gate::policy(CommonLife::class , CommonLifePolicy::class);
        Gate::policy(comment_common_task::class, CommentPolicy::class);
    }
}
