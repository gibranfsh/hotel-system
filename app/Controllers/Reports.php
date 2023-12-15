<?php

namespace App\Controllers;

class Reports extends BaseController {
    public function index() : string {
        return view('layout/header').view('layout/navbar').view('pages/reports').view('layout/footer');
    }
}