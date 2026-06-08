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
        $productData = $this->productModel->getProductPageData();

        $data = [
            'title' => ($productData['page_header']['title'] ?? 'Our Products') . ' - Fine Gas',
        ];

        $data = array_merge($data, $productData);

        return view('pages/product', $data);
    }
}
