<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class SiteController extends Controller
{
    public function produtos()
    {
        // $produtos = Produto::all();
        $produtos = Produto::paginate(12);

        return view('produtos', [
            'produtos' => $produtos,
        ]);
    }
}
