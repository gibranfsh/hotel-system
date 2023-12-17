<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use App\Models\RoomModel;

class Reservations extends BaseController
{
    public function index(): string
    {
        $reservationModel = new ReservationModel();
        $reservations = $reservationModel->findAll();

        // get room number from roomID for each reservation, and return as new array
        $roomModel = new RoomModel();
        $roomNumbers = [];
        $roomFloors = [];
        $totalPrices = [];

        foreach ($reservations as $reservation) {
            $room = $roomModel->find($reservation['roomID']);
            $roomNumbers[] = $room['roomNumber'];
        }

        // get room floor from roomID for each reservation, and return as new array
        foreach ($reservations as $reservation) {
            $room = $roomModel->find($reservation['roomID']);
            $roomFloors[] = $room['floor'];
        }

        foreach ($reservations as $reservation) {
            $room = $roomModel->find($reservation['roomID']);
            $totalPrices[] = $room['price'];
        }

        // add room numbers to reservations array
        for ($i = 0; $i < count($reservations); $i++) {
            $reservations[$i]['roomNumber'] = $roomNumbers[$i];
        }

        // add room floors to reservations array
        for ($i = 0; $i < count($reservations); $i++) {
            $reservations[$i]['floor'] = $roomFloors[$i];
        }

        // add total prices to reservations array
        for ($i = 0; $i < count($reservations); $i++) {
            $reservations[$i]['totalPrice'] = $totalPrices[$i];
        }

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

    public function delete($reservationID)
    {
        // Create model object
        $reservationModel = new ReservationModel();

        // Delete data
        if ($reservationModel->delete($reservationID)) {
            // Successful delete, redirect to reservations page with success message
            session()->setFlashdata('success', 'Reservation deleted successfully');
            return redirect()->to('/reservations');
        } else {
            // Delete failed, redirect back to reservations page with an error message
            session()->setFlashdata('error', 'Failed to delete reservation');
            return redirect()->to('/reservations');
        }
    }
}
