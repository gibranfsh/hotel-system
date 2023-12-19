<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoomsSeeder extends Seeder
{
    public function run()
    {
        // Sample data for the 'rooms' table
        $data = [
            [
                'roomNumber' => '101',
                'floor' => '1',
                'roomType' => 'Deluxe',
                'availability' => 'Available',
                'price' => '1500000'
            ],
            [
                'roomNumber' => '102',
                'floor' => '3',
                'roomType' => 'Deluxe',
                'availability' => 'Available',
                'price' => '1500000'
            ],
            [
                'roomNumber' => '103',
                'floor' => '2',
                'roomType' => 'Superior',
                'availability' => 'Available',
                'price' => '1000000'
            ],
            [
                'roomNumber' => '104',
                'floor' => '2',
                'roomType' => 'Family',
                'availability' => 'Available',
                'price' => '2000000'
            ],
            [
                'roomNumber' => '105',
                'floor' => '1',
                'roomType' => 'Family',
                'availability' => 'Available',
                'price' => '2000000'
            ],
            [
                'roomNumber' => '106',
                'floor' => '1',
                'roomType' => 'Suite',
                'availability' => 'Unavailable',
                'price' => '2500000'
            ],
            [
                'roomNumber' => '107',
                'floor' => '4',
                'roomType' => 'Deluxe',
                'availability' => 'Available',
                'price' => '1500000'
            ],
            [
                'roomNumber' => '108',
                'floor' => '5',
                'roomType' => 'Deluxe',
                'availability' => 'Available',
                'price' => '1500000'
            ],
            [
                'roomNumber' => '109',
                'floor' => '1',
                'roomType' => 'Family',
                'availability' => 'Unavailable',
                'price' => '2000000'
            ],
            [
                'roomNumber' => '110',
                'floor' => '1',
                'roomType' => 'Suite',
                'availability' => 'Available',
                'price' => '2500000'
            ],
        ];

        // Insert data into the 'rooms' table
        $this->db->table('rooms')->insertBatch($data);
    }
}
