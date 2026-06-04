<?php

namespace App\Controllers;

class NotFound extends BaseController
{
    public function index()
    {
        return view('pages/404', ['title' => '404 Page Not Found - Fine Gas']);
    }
}
