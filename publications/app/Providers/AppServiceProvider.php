<?php

namespace App\Providers;

use App\Models\Profile;
use App\Models\Publication;
use App\Policies\PublicationPolicy;
use Illuminate\Auth\GenericUser;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        // to use the bootstrap pagination style
        Paginator::useBootstrapFive();
        // Gate::define('update-publication', function (GenericUser $profile,Publication $publication) {
        //     return $profile->id === $publication->profile_id;
        // });

        // to register the policy
        Gate::policy(Publication::class, PublicationPolicy::class);
    }
}
