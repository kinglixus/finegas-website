<?php

namespace App\Controllers;

class SafetyTips extends BaseController
{
    public function index()
    {
        return view('pages/safety_tips', ['title' => 'Safety Tips - Fine Gas']);
    }

    public function moreTips()
    {
        return view('pages/more_safety_tips', ['title' => 'More Safety Tips - Fine Gas']);
    }
}
