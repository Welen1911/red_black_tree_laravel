<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Services\ProductTree;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    protected $productTree;

    public function __construct()
    {
        $this->productTree = new ProductTree();
    }

    public function getProdutos(Request $request)
    {
        $request->validate([
            'ordem' => 'required|in:abaixo,acima',
        ]);

        $this->inserrirNaArvore();

        if ($request->ordem === 'abaixo') {
            $produtosAbaixo100 = $this->productTree->getBelow100();
            return response()->json($produtosAbaixo100);
        }

        $produtosAcima100 = $this->productTree->getAbove100();
        return response()->json($produtosAcima100);
    }

    private function inserrirNaArvore()
    {
        $produtos = Produto::all();

        foreach ($produtos as $produto) {
            $this->productTree->insert($produto);
        }
    }
}
