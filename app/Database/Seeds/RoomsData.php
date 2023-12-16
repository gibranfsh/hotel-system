<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoomsData extends Seeder
{
    public function run()
    {
        // Sample data for the 'rooms' table
        $data = [
            [
                'roomNumber' => '101',
                'floor' => '1',
                'roomType' => 'Deluxe',
                'availability' => 'Available'
            ],
            [
                'roomNumber' => '102',
                'floor' => '3',
                'roomType' => 'Deluxe',
                'availability' => 'Available'
            ],
            [
                'roomNumber' => '103',
                'floor' => '2',
                'roomType' => 'Deluxe',
                'availability' => 'Available'
            ],
            [
                'roomNumber' => '104',
                'floor' => '2',
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
                'floor' => '4',
                'roomType' => 'Deluxe',
                'availability' => 'Available'
            ],
            [
                'roomNumber' => '108',
                'floor' => '5',
                'roomType' => 'Deluxe',
                'availability' => 'Available'
            ],
            [
                'roomNumber' => '109',
                'floor' => '1',
                'roomType' => 'Family',
                'availability' => 'Unavailable'
            ],
            [
                'roomNumber' => '110',
                'floor' => '1',
                'roomType' => 'Suite',
                'availability' => 'Available'
            ],
        ];

        // Insert data into the 'rooms' table
        $this->db->table('rooms')->insertBatch($data);
    }
}
