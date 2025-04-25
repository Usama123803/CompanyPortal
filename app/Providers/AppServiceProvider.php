<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ContactUs;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Get the 3 latest messages for the admin
        $messages = ContactUs::latest()->take(3)->get();
        
        // Share the messages globally across all views
        view()->share('messages', $messages);
    }
}
