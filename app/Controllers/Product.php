<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Product extends BaseController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Our Products - Fine Gas',
        ];
        $data = array_merge($data, $this->productModel->getProductPageData());

        return view('pages/product', $data);
    }
}
