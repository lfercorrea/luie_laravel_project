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
            'brand' => 'Luiê lingeries',
            'brand_logo' => 'static/images/brand_logo.jpg',
            'endereco' => 'Av. João Lemos, 1.795 - 17257-000 - Bariri - São Paulo',
            'email' => 'luie@example.com',
            'telefone' => '1433251132',
            'celular' => '14996887777',
        ]);
    }
}
