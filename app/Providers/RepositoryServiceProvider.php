<?php

namespace App\Providers;

use App\Interfaces\CountryRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\GameRepositoryInterface;
use App\Interfaces\SessionRepositoryInterface;
use App\Repositories\CountryRepository;
use App\Repositories\GameRepository;
use App\Repositories\SessionRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GameRepositoryInterface::class, GameRepository::class);
        $this->app->bind(SessionRepositoryInterface::class, SessionRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
