<?php

namespace App\Controllers;

class Reports extends BaseController {
    public function index() : string {
        $data = [
            [
                'month' => 1,       // nanti diekstrak dari checkout date aja
                'year' => 2024,        // nanti diekstrak dari checkout date aja
                'reservationID' => 1,
                'billTotal' => 300
            ],
            [
                'month' => 1,       // nanti diekstrak dari checkout date aja
                'year' => 2024,        // nanti diekstrak dari checkout date aja
                'reservationID' => 2,
                'billTotal' => 400
            ],
            [
                'month' => 1,       // nanti diekstrak dari checkout date aja
                'year' => 2024,        // nanti diekstrak dari checkout date aja
                'reservationID' => 3,
                'billTotal' => 500
            ],
            [
                'month' => 2,       // nanti diekstrak dari checkout date aja
                'year' => 2024,        // nanti diekstrak dari checkout date aja
                'reservationID' => 4,
                'billTotal' => 100
            ],
            [
                'month' => 3,
                'year' => 2024,
                'reservationID' => 5,
                'billTotal' => 900
            ]
        ];

        $viewData = [
            'data' => $data,
        ];

        return view('layout/header').view('layout/navbar').view('pages/reports', $viewData).view('layout/footer');
    }
}