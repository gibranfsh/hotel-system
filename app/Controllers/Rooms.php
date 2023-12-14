<?php

namespace App\Controllers;

class Rooms extends BaseController
{
    public function index(): string
    {
        $data = [
            [
                'roomNumber' => '101',
                'floor' => '1',
                'roomType' => 'Deluxe',
                'availability' => 'Available'
            ],
            [
                'roomNumber' => '102',
                'floor' => '1',
                'roomType' => 'Deluxe',
                'availability' => 'Available'
            ],
            [
                'roomNumber' => '103',
                'floor' => '1',
                'roomType' => 'Deluxe',
                'availability' => 'Available'
            ],
            [
                'roomNumber' => '104',
                'floor' => '1',
                'roomType' => 'Family',
                'availability' => 'Available'
            ],
            [
                'roomNumber' => '105',
                'floor' => '1',
                'roomType' => 'Family',
                'availability' => 'Available'
            ],
            [
                'roomNumber' => '106',
                'floor' => '1',
                'roomType' => 'Suite',
                'availability' => 'Unavailable'
            ],
            [
                'roomNumber' => '107',
                'floor' => '1',
                'roomType' => 'Deluxe',
                'availability' => 'Available'
            ],
            [
                'roomNumber' => '108',
                'floor' => '1',
                'roomType' => 'Deluxe',
                'availability' => 'Available'
            ]
        ];

        $viewData = [
            'data' => $data,
        ];

        return view('layout/navbar') . view('pages/rooms', $viewData) . view('layout/footer');
    }
}
