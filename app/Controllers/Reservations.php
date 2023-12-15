<?php

namespace App\Controllers;

class Reservations extends BaseController {
    public function index() : string {
        $data = [
            [
                'reservationID' => 1,
                'employeeID' => 1,
                'guestID' => 1,
                'roomNumber' => ['101', '102'],
                'checkInDate' => '01-01-2023',
                'checkOutDate' => '07-01-2023'
            ]
        ];

        $viewData = [
            'data' => $data,
        ];
        
        return view('layout/header').view('layout/navbar').view('pages/reservations', $viewData).view('layout/footer');
    }
}