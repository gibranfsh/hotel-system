<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use App\Models\ReservationModel;

class Reports extends BaseController
{
    public function index(): string
    {
        $paymentModel = new PaymentModel();
        $reservationModel = new ReservationModel();
        // find payments where paymentStatus is 'Paid'
        $payments = $paymentModel->where('paymentStatus', 'Paid')->findAll();

        $data = [];

        foreach ($payments as $payment) {
            // Extract month and year from checkOutDate on each reservation with paymetID = $payment['id']
            $reservation = $reservationModel->where('paymentID', $payment['id'])->first();
            $checkOutDate = date_create($reservation['checkOutDate']);
            $month = date_format($checkOutDate, 'm');
            $year = date_format($checkOutDate, 'Y');

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
