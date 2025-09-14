<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // تعريف الـ RateLimiter باسم "api"
        RateLimiter::for('api', function ($request) {
            return Limit::perMinute(60); // كل IP ممكن يعمل 60 request في الدقيقة
        });
    }
}

