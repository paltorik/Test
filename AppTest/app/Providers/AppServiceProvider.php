<?php

namespace App\Providers;

use App\Repository\BaseRepository;
use App\Repository\IBaseRepository;
use GuzzleHttp\Client;
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
        $urk=env('API_URL');
        $key=env('API_KEY');
        $this->app->singleton('GuzzleHttp\Client', function($api) use ($urk,$key) {
            return new Client([
                'base_uri' => $urk,
                'headers' => ['X-API-KEY' => $key]
            ]);
        });
        $this->app->bind(IBaseRepository::class,BaseRepository::class);
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
