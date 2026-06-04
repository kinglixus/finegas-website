<?php

namespace App\Controllers;

use App\Models\ServiceModel;

class Service extends BaseController
{
    private $serviceModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Our Services - Fine Gas',
        ];
        $data = array_merge($data, $this->serviceModel->getServicePageData());

        return view('pages/service', $data);
    }
}
