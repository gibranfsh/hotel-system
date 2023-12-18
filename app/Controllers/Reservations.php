<?php

namespace App\Controllers;

use App\Models\GuestModel;
use App\Models\PaymentModel;
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
        $guestData = [];

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

        // get guest data from guestID for each reservation, and return as new array
        $guestModel = new GuestModel();
        foreach ($reservations as $reservation) {
            $guest = $guestModel->find($reservation['guestID']);
            $guestData[] = $guest;
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

        // add guest data to reservations array
        for ($i = 0; $i < count($reservations); $i++) {
            $reservations[$i]['guestData'] = $guestData[$i];
        }

        $viewData = [
            'data' => $reservations,
        ];

        return view('layout/navbar') . view('pages/reservations', $viewData) . view('layout/footer');
    }

    // for creating a new reservation, for API provider use, accept a body of JSON data
    public function create()
    {
        try { // Get JSON request body
            $json = $this->request->getJSON();

            // return $this->response->setStatusCode(201)->setJSON(['json' => $json]);
            // Validate JSON data
            $validationRules = [
                'user_id' => 'required|numeric',
                'user_full_name' => 'required|string',
                'user_email' => 'required|valid_email',
                'user_phone_number' => 'required|numeric',
                'checkInDate' => 'required|valid_date',
                'checkOutDate' => 'required|valid_date',
                'roomID' => 'required|numeric',
                'paymentMethod' => 'required|in_list[Card,Debit]',
            ];

            if (!$this->validate($validationRules)) {
                // Validation failed, return a JSON response with errors
                return $this->response->setStatusCode(400)->setJSON(['error' => $this->validator->getErrors()]);
            }

            // Validated JSON data
            $userID = $json->user_id;
            $userFullName = $json->user_full_name;
            $userEmail = $json->user_email;
            $userPhoneNumber = $json->user_phone_number;
            $checkInDate = $json->checkInDate;
            $checkOutDate = $json->checkOutDate;
            $roomID = $json->roomID;
            $paymentMethod = $json->paymentMethod;

            // Additional data retrieval from RoomModel if needed
            $roomModel = new RoomModel();
            $room = $roomModel->find($roomID);

            // Make new Guest
            $guestModel = new GuestModel();
            $guestID = $guestModel->insert([
                'user_id' => $userID,
                'full_name' => $userFullName,
                'email' => $userEmail,
                'phone_number' => $userPhoneNumber,
            ]);

            // Make new Payment
            $paymentModel = new PaymentModel();
            $paymentID = $paymentModel->insert([
                'billTotal' => $room['price'],
                'paymentMethod' => $paymentMethod,
                'paymentStatus' => 'Paid',

            ]);

            // Make new Reservation
            $reservationModel = new ReservationModel();
            $reservationID = $reservationModel->insert([
                'guestID' => $guestID,
                'employeeID' => 1,
                'roomID' => $roomID,
                'paymentID' => $paymentID,
                'checkInDate' => $checkInDate,
                'checkOutDate' => $checkOutDate,
            ]);

            // Change room availability to unavailable
            $roomModel->update($roomID, [
                'availability' => 'Unavailable',
            ]);

            if ($reservationID) {
                return $this->response->setStatusCode(201)->setJSON(['success' => 'Reservation created successfully']);
            } else {
                return $this->response->setStatusCode(500)->setJSON(['error' => 'Failed to create reservation']);
            }
        } catch (\Exception $e) {
            // Log the exception message for debugging
            log_message('error', 'Exception during reservation creation: ' . $e->getMessage());

            // Return a JSON response indicating a server error
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Internal Server Error']);
        }
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
