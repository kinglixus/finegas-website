<?php

namespace App\Controllers;

use App\Models\HomeModel;

class Home extends BaseController
{
    protected $homeModel;

    public function __construct()
    {
        $this->homeModel = new HomeModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Fine Gas - Renewable Energy',
        ];
        $data = array_merge($data, $this->homeModel->getHomePageData());

        // dd($data);
        return view('pages/home', $data);
    }
}
