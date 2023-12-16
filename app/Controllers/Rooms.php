<?php

namespace App\Controllers;

use App\Models\RoomModel;

class Rooms extends BaseController
{
    public function index(): string
    {
        $roomModel = new RoomModel();
        $rooms = $roomModel->findAll();

        $viewData = [
            'data' => $rooms,
        ];

        return view('layout/header') . view('layout/navbar') . view('pages/rooms', $viewData) . view('layout/footer');
    }

    public function update($roomNumber)
    {
        // Validate form data
        $validationRules = [
            'editRoomType' => 'required|in_list[Deluxe,Family,Suite]',
            'editAvailability' => 'required|in_list[Available,Unavailable]',
        ];

        if (!$this->validate($validationRules)) {
            // Validation failed, redirect back to the rooms page with errors
            return redirect()->to('/rooms')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validated form data
        $roomType = $this->request->getVar('editRoomType');
        $availability = $this->request->getVar('editAvailability');

        // Create array data
        $data = [
            'roomType' => $roomType,
            'availability' => $availability,
        ];

        // Create model object
        $roomModel = new RoomModel();

        // Update data
        if ($roomModel->update($roomNumber, $data)) {
            // Successful update, redirect to rooms page with success message
            return redirect()->to('/rooms')->with('success', 'Room updated successfully');
        } else {
            // Update failed, redirect back to rooms page with an error message
            return redirect()->to('/rooms')->with('error', 'Failed to update room');
        }
    }
}
