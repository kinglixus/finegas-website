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
        $aboutData = $this->aboutModel->getAboutPageData();

        $data = [
            'title' => $aboutData['page_header']['title'] ?? 'About Us',
        ];

        $data = array_merge($data, $aboutData);

        return view('pages/about', $data);
    }
}
