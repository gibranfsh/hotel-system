<?php

namespace App\Controllers;

use App\Models\PaymentModel;

class Reports extends BaseController
{
    public function index(): string
    {
        $paymentModel = new PaymentModel();
        // find payments where paymentStatus is 'Paid'
        $payments = $paymentModel->where('paymentStatus', 'Paid')->findAll();

        $data = [];

        foreach ($payments as $payment) {
            // Extract month and year from created_at
            $createdDate = date_create($payment['created_at']);
            $month = date_format($createdDate, 'm');
            $year = date_format($createdDate, 'Y');

            $data[] = [
                'month' => $month,
                'year' => $year,
                'paymentID' => $payment['id'],
                'billTotal' => $payment['billTotal']
            ];
        }

        $viewData = [
            'data' => $data,
        ];

        return view('layout/header') . view('layout/navbar') . view('pages/reports', $viewData) . view('layout/footer');
    }
}
