<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\User;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
     //   $this->registerPolicies();

//         Gate::define('modify-post', function (User $user, Post $post) {
// //            return true;
//             return $user->id === $post->posted_by;
//         });
    }
}
