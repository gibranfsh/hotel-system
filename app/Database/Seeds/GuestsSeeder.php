<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GuestsSeeder extends Seeder
{
    public function run()
    {
        // Sample data
        $data = [
            [
                'guestName' => 'Alice Johnson',
                'phoneNumber' => '1112223333',
                'address' => '789 Pine St, Village',
            ],
            [
                'guestName' => 'Bob Williams',
                'phoneNumber' => '4445556666',
                'address' => '321 Elm St, Hamlet',
            ],
        ];

        // Insert data into the table
        $this->db->table('guests')->insertBatch($data);
    }
}
