<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class ApiTuscanyProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('api-tuscany', function(){
            Return Http::withOptions([
                'verify'=>false,
                'base_uri'=>'https://stage.tuscanyleather.it/api/v1/',
            ])->withHeaders([
                'Authorization' => 'Bearer'.env('API_TUSCANY_TOKEN'),
            ]);
        });
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
