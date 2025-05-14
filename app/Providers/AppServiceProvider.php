<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Http\Livewire\BookRoomForm;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   
    
  

public function boot()
{
    Blade::componentNamespace('App\\View\\Components', 'layouts');
}
}
