<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Produto extends Model
{
    use HasFactory;

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    protected $fillable = [
        'name',
        'descricao',
        'preco',
        'slug',
        'imagem',
        'id_user',
        'id_categoria',
    ];
}
