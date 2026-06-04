<?php

namespace App\Controllers;

class Quote extends BaseController
{
    public function index()
    {
        return view('pages/quote', ['title' => 'Free Quote - Fine Gas']);
    }
}
