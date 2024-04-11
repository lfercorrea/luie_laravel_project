<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\User;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public static function search ($search) {
        return self::where('nome', 'like', '%' . $search . '%')
            ->orWhere('descricao', 'like', '%' . $search . '%');
    }

    protected $fillable = [
        'quantidade',
        'name',
        'descricao',
        'preco',
        'slug',
        'imagem',
        'id_user',
        'id_categoria',
    ];
}
