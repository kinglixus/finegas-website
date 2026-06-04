<?php

namespace App\Controllers;

use App\Models\AboutModel;

class About extends BaseController
{
    protected $aboutModel;

    public function __construct()
    {
        $this->aboutModel = new AboutModel();
    }

    public function index()
    {
        $data = [
            'title' => 'About Us - FINE GAS',
        ];
        $data = array_merge($data, $this->aboutModel->getAboutPageData());
        return view('pages/about', $data);
    }
}
