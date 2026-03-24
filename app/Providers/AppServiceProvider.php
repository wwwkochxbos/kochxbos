<?php

namespace App\Providers;

use App\Models\Artist;
use App\Observers\ArtistObserver;
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
        Artist::observe(ArtistObserver::class);
    }
}
