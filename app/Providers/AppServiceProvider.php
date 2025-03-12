<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Html\Html;
use Spatie\Html\HtmlServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register Spatie's HTML service provider explicitly (optional in Laravel 5.5+)
        $this->app->register(HtmlServiceProvider::class);
    }
}
