<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Services\ProductArray;
use App\Services\ProductTree;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    protected $productTree;
    protected $productArray;

    public function __construct()
    {
        $this->productTree = new ProductTree();
        $this->productArray = new ProductArray();
    }

    public function getProdutos(Request $request)
    {
        $request->validate([
            'ordem' => 'required|in:abaixo,acima',
        ]);

        $this->inserirNaArvore();

        if ($request->ordem === 'abaixo') {
            $produtosAbaixo100 = $this->productTree->getBelow100();
            return response()->json($produtosAbaixo100);
        }

        $produtosAcima100 = $this->productTree->getAbove100();
        return response()->json($produtosAcima100);
    }

    private function inserirNaArvore()
    {
        $produtos = Produto::all();

        foreach ($produtos as $produto) {
            $this->productTree->insert($produto);
        }
    }

    private function inserirNoArray()
    {
        $produtos = Produto::all();

        foreach ($produtos as $produto) {
            $this->productArray->insert($produto);
        }
    }

    public function getProdutosArray(Request $request)
    {
        $request->validate([
            'ordem' => 'required|in:abaixo,acima',
        ]);

        $this->inserirNoArray();

        if ($request->ordem === 'abaixo') {
            $produtosAbaixo100 = $this->productArray->getBelow100();
            return response()->json($produtosAbaixo100);
        }

        $produtosAcima100 = $this->productArray->getAbove100();
        return response()->json($produtosAcima100);
    }
}
