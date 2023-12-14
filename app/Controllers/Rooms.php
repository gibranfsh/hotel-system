<?php

namespace App\Controllers;

class Rooms extends BaseController {
    public function index() : string {
        return view('layout/header').view('layout/navbar').view('pages/rooms').view('layout/footer');
    }
}