<?php

namespace App\Controllers;

class Feature extends BaseController
{
    public function index()
    {
        return view('pages/feature', ['title' => 'Features - Fine Gas']);
    }
}
