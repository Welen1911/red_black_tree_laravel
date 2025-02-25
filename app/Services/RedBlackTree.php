<?php

namespace App\Services;

class Node
{
    public $price;
    public $color;
    public $left;
    public $right;
    public $parent;
    public $description;

    public function __construct($price, $description)
    {
        $this->price = $price;
        $this->description = $description;
        $this->color = 'red';
        $this->left = null;
        $this->right = null;
        $this->parent = null;
    }
}

class RedBlackTree
{
    private $root;

    public function __construct()
    {
        $this->root = null;
    }

    public function insert($price, $description)
    {
        $newNode = new Node($price, $description);
        $this->root = $this->bstInsert($this->root, $newNode);
        $this->fixViolation($newNode);
    }

    private function bstInsert($root, $node)
    {
        if ($root === null) {
            return $node;
        }

        if ($node->price < $root->price) {
            $root->left = $this->bstInsert($root->left, $node);
            $root->left->parent = $root;
        } else {
            $root->right = $this->bstInsert($root->right, $node);
            $root->right->parent = $root;
        }

        return $root;
    }

    private function fixViolation($node)
    {
        while ($node !== $this->root && $node->parent->color === 'red') {
            if ($node->parent === $node->parent->parent->left) {
                $uncle = $node->parent->parent->right;

                if ($uncle !== null && $uncle->color === 'red') {
                    // Caso 1: tio vermelho
                    $node->parent->color = 'black';
                    $uncle->color = 'black';
                    $node->parent->parent->color = 'red';
                    $node = $node->parent->parent;
                } else {
                    if ($node === $node->parent->right) {
                        // Caso 2: tio preto e o nó é filho direito
                        $node = $node->parent;
                        $this->leftRotate($node);
                    }

                    // Caso 3: tio preto e o nó é filho esquerdo
                    $node->parent->color = 'black';
                    $node->parent->parent->color = 'red';
                    $this->rightRotate($node->parent->parent);
                }
            } else {
                $uncle = $node->parent->parent->left;

                if ($uncle !== null && $uncle->color === 'red') {
                    // Caso 1: tio vermelho
                    $node->parent->color = 'black';
                    $uncle->color = 'black';
                    $node->parent->parent->color = 'red';
                    $node = $node->parent->parent;
                } else {
                    if ($node === $node->parent->left) {
                        // Caso 2: tio preto e o nó é filho esquerdo
                        $node = $node->parent;
                        $this->rightRotate($node);
                    }

                    // Caso 3: tio preto e o nó é filho direito
                    $node->parent->color = 'black';
                    $node->parent->parent->color = 'red';
                    $this->leftRotate($node->parent->parent);
                }
            }
        }

        if ($this->root !== null) {
            $this->root->color = 'black'; // A raiz é sempre preta
        }
    }

    private function leftRotate($node)
    {
        $y = $node->right;
        $node->right = $y->left;

        if ($y->left !== null) {
            $y->left->parent = $node;
        }

        $y->parent = $node->parent;

        if ($node->parent === null) {
            $this->root = $y;
        } elseif ($node === $node->parent->left) {
            $node->parent->left = $y;
        } else {
            $node->parent->right = $y;
        }

        $y->left = $node;
        $node->parent = $y;
    }

    private function rightRotate($node)
    {
        $y = $node->left;
        $node->left = $y->right;

        if ($y->right !== null) {
            $y->right->parent = $node;
        }

        $y->parent = $node->parent;

        if ($node->parent === null) {
            $this->root = $y;
        } elseif ($node === $node->parent->right) {
            $node->parent->right = $y;
        } else {
            $node->parent->left = $y;
        }

        $y->right = $node;
        $node->parent = $y;
    }

    public function getRoot()
    {
        return $this->root;
    }

    public function inOrderTraversal($node)
    {
        if ($node !== null) {
            $this->inOrderTraversal($node->left);
            echo $node->price . " (Color: " . $node->color . ")\n";
            $this->inOrderTraversal($node->right);
        }
    }

    public function range($start, $end)
    {
        $result = [];
        $this->rangeSearch($this->root, $start, $end, $result);
        return $result;
    }

    public function rangeSearch($node, $start, $end, &$result)
    {
        if ($node === null) {
            return;
        }

        if ($node->price > $start) {
            $this->rangeSearch($node->left, $start, $end, $result);
        }

        if ($node->price >= $start && $node->price <= $end) {
            $result[] = ['descricao' => $node->description, 'preco' => $node->price, 'cor' => $node->color];
        }

        if ($node->price < $end) {
            $this->rangeSearch($node->right, $start, $end, $result);
        }
    }
}
