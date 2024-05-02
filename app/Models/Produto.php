<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Tamanho;
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

    public function tamanho() {
        return $this->belongsToMany(Tamanho::class, 'produto_tamanho')->orderBy('id');
    }

    public static function search ($search, $id_categoria = null, $id_tamanho = null) {
        $query = self::query();

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('nome', 'like', '%' . $search . '%')
                    ->orWhere('descricao', 'like', '%' . $search . '%');
            });
        }

        if ($id_categoria) {
            $query->whereHas('categoria', function ($query) use ($id_categoria) {
                $query->where('id', $id_categoria);
            });
        }

        if ($id_tamanho) {
            $query->whereHas('tamanho', function ($query) use ($id_tamanho) {
                $query->where('tamanho_id', $id_tamanho);
            });
        }

        return $query;
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
