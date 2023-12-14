<?php

namespace App\Controllers;

class Reservations extends BaseController {
    public function index() : string {
        return view('header').view('reservations').view('footer');
    }
}