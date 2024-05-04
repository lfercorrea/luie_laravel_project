<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siteconfig;

class SiteconfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Siteconfig::create([
            'brand' => 'Luiê lingerie',
            'brand_logo' => 'static/images/brand_logo.jpg',
            'endereco' => 'Av. João Lemos, 1.795 - 17257-000 - Bariri - São Paulo',
            'sobre_empresa' => 'Empresa familiar que aos poucos foi investindo em tecnologias e, em 2012, iniciou nossa própria marca, Luiê, um nome que representa a união de Luis e Elizabeth, os fundadores. Empresa situada na cidade de Bariri.  Nossa missão é  ter produtos em moda íntima com qualidade, conforto e que valorize a beleza feminina.',
            'sobre_produtos' => 'Escreva um texto descrevendo características especiais de seus produtos.',
            'email' => 'luie@example.com',
            'telefone' => '1234567890',
            'celular' => '12934567890',
        ]);
    }
}
