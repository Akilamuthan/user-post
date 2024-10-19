<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Cache\RateLimiter as Limit; // Use this to import Limit
use Illuminate\Cache\RateLimiter as CacheRateLimiter; // Use this for Cache Rate Limiter

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->configureRateLimiting();
        // Other boot logic...
    }

    protected function configureRateLimiting()
{
    RateLimiter::for('api', function (Request $request) {
       
    });
}

}
