<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    public function run()
    {
        // Sample data
        $data = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'phoneNumber' => '1234567890',
                'address' => '123 Main St, City',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'password' => password_hash('password456', PASSWORD_DEFAULT),
                'phoneNumber' => '9876543210',
                'address' => '456 Oak St, Town',
            ],
            [
                'name' => 'Namaku Admin',
                'email' => 'admin@gin.com',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'phoneNumber' => '1234567890',
                'address' => '123 Main St, City',
            ],
            [
                'name' => 'Hoteloka Provider Account',
                'email' => 'hoteloka@gin.com',
                'password' => password_hash('hotelokaxgin', PASSWORD_DEFAULT),
                'phoneNumber' => '1234567890',
                'address' => '123 Main St, City',
            ]
        ];

        // Insert data into the table
        $this->db->table('reservation_pic')->insertBatch($data);
    }
}
