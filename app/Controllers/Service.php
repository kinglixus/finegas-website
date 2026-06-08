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
        $serviceData = $this->serviceModel->getServicePageData();

        $data = [
            'title' => ($serviceData['page_header']['title'] ?? 'Our Services') . ' - Fine Gas',
        ];

        $data = array_merge($data, $serviceData);

        return view('pages/service', $data);
    }
}
