<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    public function run()
    {
        // Load the model
        $paymentModel = model('PaymentModel');

        // Sample data
        $data = [
            [
                'billTotal' => 2000.00,
                'paymentMethod' => 'Card',
                'paymentStatus' => 'Paid',
            ],
            [
                'billTotal' => 2000.00,
                'paymentMethod' => 'Debit',
                'paymentStatus' => 'Unpaid',
            ],
            // Add more data as needed
        ];

        // Insert data with created_at
        foreach ($data as &$row) {
            $row['created_at'] = date('Y-m-d H:i:s');
        }

        // Insert data
        $paymentModel->insertBatch($data);
    }
}
