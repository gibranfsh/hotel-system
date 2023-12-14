<?php

namespace App\Controllers;

class Reports extends BaseController {
    public function index() : string {
        return view('header').view('reports').view('footer');
    }
}