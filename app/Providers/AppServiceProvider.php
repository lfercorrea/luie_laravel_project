<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Categoria;

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
    public function boot(): void
    {
        $brand = 'Luiê';
        $categorias = Categoria::all();

        $levels = [
            1 => 'Proprietário',
            2 => 'Administrador',
            3 => 'Cliente',
        ];
        
        view()->share([
            'brand' => $brand,
            'categorias' => $categorias,
            'levels' => $levels,
        ]);
    }
}
