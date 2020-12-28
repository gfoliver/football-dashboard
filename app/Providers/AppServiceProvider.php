<?php

namespace App\Providers;

use App\Core\Repositories\Contracts\ILeaguesRepository;
use App\Core\Repositories\Contracts\ISeasonsRepository;
use App\Core\Repositories\Contracts\ISeasonStandingsRepository;
use App\Core\Repositories\Contracts\ITeamsRepository;
use App\Core\Repositories\LeaguesRepository;
use App\Core\Repositories\SeasonsRepository;
use App\Core\Repositories\SeasonStandingsRepository;
use App\Core\Repositories\TeamsRepository;
use App\Core\Services\Contracts\ILeaguesService;
use App\Core\Services\Contracts\ISeasonsService;
use App\Core\Services\Contracts\ISeasonStandingsService;
use App\Core\Services\Contracts\ITeamsService;
use App\Core\Services\LeaguesService;
use App\Core\Services\SeasonsService;
use App\Core\Services\SeasonStandingsService;
use App\Core\Services\TeamsService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ITeamsRepository::class, TeamsRepository::class);
        $this->app->singleton(ITeamsService::class, TeamsService::class);

        $this->app->singleton(ILeaguesRepository::class, LeaguesRepository::class);
        $this->app->singleton(ILeaguesService::class, LeaguesService::class);
        
        $this->app->singleton(ISeasonsRepository::class, SeasonsRepository::class);
        $this->app->singleton(ISeasonsService::class, SeasonsService::class);
        
        $this->app->singleton(ISeasonStandingsRepository::class, SeasonStandingsRepository::class);
        $this->app->singleton(ISeasonStandingsService::class, SeasonStandingsService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
