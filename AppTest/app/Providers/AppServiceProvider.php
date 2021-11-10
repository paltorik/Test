<?php

namespace App\Providers;

use App\Repository\BaseRepository;
use App\Repository\IBaseRepository;
use App\Repository\IOrderRepository;
use App\Repository\OrdersRepository;
use App\Repository\ProductRepository;
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
        $this->app->bind(IBaseRepository::class,BaseRepository::class);
        $this->app->bind(IOrderRepository::class,OrdersRepository::class);

        $urk=env('API_URL');
        $key=env('API_KEY');

        $this->app->singleton('GuzzleHttp\Client', function($api) use ($urk,$key) {
            return new Client([
                'base_uri' => $urk,
                'headers' => ['X-API-KEY' => $key]
            ]);
        });





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
