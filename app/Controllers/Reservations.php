<?php

namespace App\Controllers;

class Reservations extends BaseController {
    public function index() : string {
        return view('layout/header').view('layout/navbar').view('pages/reservations').view('layout/footer');
    }
}