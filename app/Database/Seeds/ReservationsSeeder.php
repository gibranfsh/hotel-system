<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use DateTime;

class ReservationsSeeder extends Seeder
{
    public function run()
    {
        // Sample data
        $data = [
            [
                'guestID' => 1,
                'employeeID' => 1,
                'roomID' => 1,
                'paymentID' => 1,
                'checkInDate' => '2023-01-01',
                'checkOutDate' => '2023-01-07',
            ],
            [
                'guestID' => 1,
                'employeeID' => 1,
                'roomID' => 3,
                'paymentID' => 2,
                'checkInDate' => '2023-03-01',
                'checkOutDate' => '2023-03-07',
            ],
        ];

        // Insert data into the table
        $this->db->table('reservations')->insertBatch($data);
    }
}
