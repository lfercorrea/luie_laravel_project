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
        // sharing all 'categorias' elements
        $categorias = Categoria::all();
        view()->share('categorias', $categorias);

        // níveis de usuário para controle de permissões
        $levels = [
            1 => 'Proprietário',
            2 => 'Administrador',
            3 => 'Cliente',
        ];
        
        view()->share([
            'levels' => $levels,
        ]);
    }
}
