<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siteconfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'brand_logo',
        'endereco',
        'email',
        'telefone',
        'celular',
    ];
}
