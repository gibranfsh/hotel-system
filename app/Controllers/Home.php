<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('layout/header') . view('layout/navbar') . view('dashboard') . view('layout/footer');
    }
}
