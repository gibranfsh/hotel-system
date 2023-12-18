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
                'user_id' => 3001,
                'full_name' => 'Alice Johnson',
                'phone_number' => '1112223333',
                'email' => 'alicejohnson@gmail.com',
            ],
        ];

        // Insert data into the table
        $this->db->table('guests')->insertBatch($data);
    }
}
