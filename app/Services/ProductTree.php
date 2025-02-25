<?php

namespace App\Services;

use App\Services\RedBlackTree;

class ProductTree
{

    protected $tree;

    public function __construct()
    {
        $this->tree = new RedBlackTree();
    }

    public function insert($produto)
    {
        $this->tree->insert($produto->valor, $produto->descricao);
    }

    public function getBelow100()
    {
        return $this->tree->range(0, 100);
    }

    public function getAbove100()
    {
        return $this->tree->range(100, PHP_INT_MAX);
    }
}
