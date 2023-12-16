<?php

namespace App\Controllers;

use App\Models\ReservationModel;

class Reservations extends BaseController
{
    public function index(): string
    {
        $reservationModel = new ReservationModel();
        $reservations = $reservationModel->findAll();

        $viewData = [
            'data' => $reservations,
        ];

        return view('layout/navbar') . view('pages/reservations', $viewData) . view('layout/footer');
    }

    public function update($reservationID)
    {
        // Validate form data
        $validationRules = [
            'editCheckInDate' => 'required|valid_date',
            'editCheckOutDate' => 'required|valid_date',
        ];

        if (!$this->validate($validationRules)) {
            // Validation failed, redirect back to the reservations page with errors
            return redirect()->to('/reservations')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validated form data
        $checkInDate = $this->request->getVar('editCheckInDate');
        $checkOutDate = $this->request->getVar('editCheckOutDate');

        // Create array data
        $data = [
            'checkInDate' => $checkInDate,
            'checkOutDate' => $checkOutDate,
        ];

        // Create model object
        $reservationModel = new ReservationModel();

        // Update data
        if ($reservationModel->update($reservationID, $data)) {
            // Successful update, redirect to reservations page with success message
            session()->setFlashdata('success', 'Reservation updated successfully');
            return redirect()->to('/reservations');
        } else {
            // Update failed, redirect back to reservations page with an error message
            session()->setFlashdata('error', 'Failed to update reservation');
            return redirect()->to('/reservations');
        }
    }
}
