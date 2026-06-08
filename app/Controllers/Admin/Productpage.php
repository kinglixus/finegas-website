<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Productpage extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [

            'title' => 'Products CMS',

            'page_header' =>
            $this->productModel
                ->getSection('page_header'),

            'product_header' =>
            $this->productModel
                ->getSection('product_header'),

            'products' =>
            $this->productModel
                ->getSectionItems('products')
        ];

        return view(
            'admin/productpage/index',
            $data
        );
    }


    public function pageHeader()
    {
        $pageHeader =
            $this->productModel
            ->getSection(
                'page_header'
            );

        return view(
            'admin/productpage/page_header',
            [
                'title'      => 'Page Header',
                'pageHeader' => $pageHeader
            ]
        );
    }


    public function updatePageHeader()
    {
        $pageHeader =
            $this->productModel
            ->getSection(
                'page_header'
            );

        if (!$pageHeader) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Page Header not found.'
                );
        }

        $data = [

            'title' =>
            $this->request
                ->getPost('title'),

            'subtitle' =>
            $this->request
                ->getPost('subtitle'),

            'description' =>
            $this->request
                ->getPost('description'),

            'status' =>
            $this->request
                ->getPost('status')
        ];

        $image =
            $this->request
            ->getFile('image');

        if (
            $image &&
            $image->isValid() &&
            !$image->hasMoved()
        ) {

            $uploadPath =
                FCPATH . 'uploads/page_headers';

            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            if (
                !empty($pageHeader['image']) &&
                file_exists(
                    FCPATH .
                        $pageHeader['image']
                )
            ) {
                unlink(
                    FCPATH .
                        $pageHeader['image']
                );
            }

            $newName =
                $image->getRandomName();

            $image->move(
                $uploadPath,
                $newName
            );

            $data['image'] =
                'uploads/page_headers/' . $newName;
        }

        $this->productModel
            ->update(
                $pageHeader['id'],
                $data
            );

        activity_log(
            'PRODUCT_PAGE_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Product page header updated'
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Page Header updated successfully.'
            );
    }

    public function productHeader()
    {
        $productHeader =
            $this->productModel
            ->getSection(
                'product_header'
            );

        return view(
            'admin/productpage/product_header',
            [
                'title'         => 'Product Header',
                'productHeader' => $productHeader
            ]
        );
    }

    public function updateProductHeader()
    {
        $productHeader =
            $this->productModel
            ->getSection(
                'product_header'
            );

        if (!$productHeader) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Product Header not found.'
                );
        }

        $data = [

            'title' =>
            $this->request
                ->getPost('title'),

            'subtitle' =>
            $this->request
                ->getPost('subtitle'),

            'description' =>
            $this->request
                ->getPost('description'),

            'status' =>
            $this->request
                ->getPost('status')
        ];

        $image =
            $this->request
            ->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {

            $newName =
                $image->getRandomName();

            $uploadPath =
                FCPATH . 'uploads/products';

            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            $image->move(
                $uploadPath,
                $newName
            );

            $data['image'] =
                'uploads/products/' . $newName;
        }

        $this->productModel
            ->update(
                $productHeader['id'],
                $data
            );

        activity_log(
            'PRODUCT_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Product header updated'
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Product Header updated successfully.'
            );
    }

    public function products()
    {
        $data = [

            'title' => 'Products',

            'products' =>

            $this->productModel

                ->where(
                    'section_name',
                    'products'
                )

                ->where(
                    'section_type',
                    'item'
                )

                ->orderBy(
                    'sort_order',
                    'ASC'
                )

                ->findAll()
        ];

        return view(
            'admin/productpage/products',
            $data
        );
    }


    public function createProduct()
    {
        return view(
            'admin/productpage/products_create',
            [
                'title' => 'Create Product'
            ]
        );
    }

    public function storeProduct()
    {
        $image =
            $this->request
            ->getFile('image');

        $imagePath = null;

        if ($image && $image->isValid()) {

            $newName =
                $image->getRandomName();

            $uploadPath =
                FCPATH . 'uploads/products';

            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            $image->move(
                $uploadPath,
                $newName
            );

            $imagePath =
                'uploads/products/' . $newName;
        }

        $extraData = [

            'filter_class' =>
            $this->request
                ->getPost('filter_class'),

            'lightbox_image' =>
            $imagePath
        ];

        $this->productModel
            ->insert([

                'section_name' =>
                'products',

                'section_type' =>
                'item',

                'title' =>
                $this->request
                    ->getPost('title'),

                'description' =>
                $this->request
                    ->getPost('description'),

                'image' =>
                $imagePath,

                'extra_data' =>
                json_encode(
                    $extraData
                ),

                'sort_order' =>
                $this->request
                    ->getPost('sort_order'),

                'status' =>
                $this->request
                    ->getPost('status')
            ]);

        activity_log(
            'PRODUCT_CREATED',
            'CMS',
            session('admin_id'),
            'Product created'
        );

        return redirect()
            ->to(
                base_url(
                    'admin/productpage/products'
                )
            )
            ->with(
                'success',
                'Product created successfully.'
            );
    }

    public function editProduct($id)
    {
        $product =
            $this->productModel
            ->find($id);

        if (!$product) {

            return redirect()
                ->to(
                    base_url(
                        'admin/productpage/products'
                    )
                )
                ->with(
                    'error',
                    'Product not found.'
                );
        }

        $product['extra_data'] =
            !empty($product['extra_data'])
            ? json_decode(
                $product['extra_data'],
                true
            )
            : [];

        return view(
            'admin/productpage/products_edit',
            [
                'title'   => 'Edit Product',
                'product' => $product
            ]
        );
    }

    public function updateProduct($id)
    {
        $product =
            $this->productModel
            ->find($id);

        if (!$product) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Product not found.'
                );
        }

        $data = [

            'title' =>
            $this->request
                ->getPost('title'),

            'description' =>
            $this->request
                ->getPost('description'),

            'sort_order' =>
            $this->request
                ->getPost('sort_order'),

            'status' =>
            $this->request
                ->getPost('status')
        ];

        $image =
            $this->request
            ->getFile('image');

        if ($image && $image->isValid()) {

            $newName =
                $image->getRandomName();

            $uploadPath =
                FCPATH . 'uploads/products';

            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            $image->move(
                $uploadPath,
                $newName
            );

            $data['image'] =
                'uploads/products/' . $newName;

            $data['extra_data'] =
                json_encode([
                    'filter_class' =>
                    $this->request
                        ->getPost('filter_class'),

                    'lightbox_image' =>
                    'uploads/products/' . $newName
                ]);
        }

        $this->productModel
            ->update(
                $id,
                $data
            );

        activity_log(
            'PRODUCT_UPDATED',
            'CMS',
            session('admin_id'),
            'Product updated'
        );

        return redirect()
            ->to(
                base_url(
                    'admin/productpage/products'
                )
            )
            ->with(
                'success',
                'Product updated successfully.'
            );
    }

    public function deleteProduct($id)
    {
        $product =
            $this->productModel
            ->find($id);

        if (!$product) {

            return $this->response
                ->setJSON([
                    'status' => false
                ]);
        }

        $this->productModel
            ->delete($id);

        activity_log(
            'PRODUCT_DELETED',
            'CMS',
            session('admin_id'),
            'Product deleted'
        );

        return $this->response
            ->setJSON([
                'status' => true
            ]);
    }
}
