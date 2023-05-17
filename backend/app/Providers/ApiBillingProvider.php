<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class ApiBillingProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('apiBilling', function(){
            return Http::withOptions([
                'base_uri' => env('API_HOST')
            ])->withHeaders([
                'access_token' => env('API_KEY')
            ]);
        });
    }
}
