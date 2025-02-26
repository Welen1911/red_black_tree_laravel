<?php

namespace App\Services;


class ProductArray
{
    protected $list = [];

    public function insert($produto)
    {
        array_push($this->list, ['descricao' => $produto->descricao, 'preco' => $produto->valor]);
    }

    public function getBelow100()
    {
        return array_filter($this->list, function ($produto) {
            return $produto['preco'] <= 100;
        });
    }

    public function getAbove100()
    {
        return array_filter($this->list, function ($produto) {
            return $produto['preco'] > 100;
        });
    }
}
