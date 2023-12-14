<?php

namespace App\Controllers;

class Rooms extends BaseController {
    public function index() : string {
        return view('header').view('rooms').view('footer');
    }
}