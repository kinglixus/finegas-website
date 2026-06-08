<?php

namespace App\Controllers;

use App\Models\SafetyModel;

class SafetyTips extends BaseController
{
    protected $safetyModel;

    public function __construct()
    {
        $this->safetyModel = new SafetyModel();
    }

    public function index()
    {
        $safetyData = $this->safetyModel->getSafetyPageData();

        $data = [
            'title' => ($safetyData['page_header']['title'] ?? 'Safety Tips') . ' - Fine Gas',
        ];

        $data = array_merge($data, $safetyData);

        return view('pages/safety_tips', $data);
    }

    public function moreTips()
    {
        $data = [
            'title' => 'More Safety Tips - Fine Gas',
        ];

        return view('pages/more_safety_tips', $data);
    }
}
