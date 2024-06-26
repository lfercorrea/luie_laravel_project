<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class Categoria extends Model
{
    use HasFactory;

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'id_categoria');
    }

    protected $fillable = [
        'nome',
        'descricao',
        'imagem',
    ];
}
