<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class Tamanho extends Model
{
    use HasFactory;

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'id_tamanho');
    }

    protected $fillable = [
        'nome',
    ];
}
