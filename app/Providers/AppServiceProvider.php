<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Categoria;
use App\Models\Siteconfig;

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
        $site_configs = Siteconfig::first();
        $categorias = Categoria::all();
        
        $levels = [
            1 => 'Proprietário',
            2 => 'Administrador',
            3 => 'Cliente',
        ];

        $ufs = [
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SE' => 'Sergipe',
            'SP' => 'São Paulo',
            'TO' => 'Tocantins',
        ];
        
        view()->share([
            'siteconfig_brand' => $site_configs->brand,
            'siteconfig_brand_logo' => $site_configs->brand_logo,
            'siteconfig_endereco' => $site_configs->endereco,
            'siteconfig_email' => $site_configs->email,
            'siteconfig_telefone' => $site_configs->telefone,
            'siteconfig_celular' => $site_configs->celular,
            'categorias' => $categorias,
            'levels' => $levels,
            'ufs' => $ufs,
        ]);
    }
}
