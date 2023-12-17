<?php

namespace App\Controllers;

use App\Models\RoomModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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

    public function update($id)
    {
        // Validate form data
        $validationRules = [
            'editRoomType' => 'required|in_list[Deluxe,Family, Superior, Suite]',
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
        if ($roomModel->update($id, $data)) {
            // Successful update, redirect to rooms page with success message
            return redirect()->to('/rooms')->with('success', 'Room updated successfully');
        } else {
            // Update failed, redirect back to rooms page with an error message
            return redirect()->to('/rooms')->with('error', 'Failed to update room');
        }
    }

    public function getRooms()
    {
        // Get JWT Bearer Token from request header
        $token = $this->request->getHeaderLine('Authorization');

        // return $this->response->setJSON(['token' => $token])->setStatusCode(200);
        // Verify the token
        $key = getenv("JWT_SECRET");

        try {
            $decoded = JWT::decode($token, new Key($key, "HS256"));
            // Token is valid, you can access user data using $decoded
        } catch (\Exception $e) {
            // Token is invalid, return error response
            return $this->response->setJSON(['error' => 'Unauthorized: Invalid token'])->setStatusCode(401);
        }

        // Create model object
        $roomModel = new RoomModel();

        // Get all rooms
        $rooms = $roomModel->findAll();

        // Return JSON response and set HTTP status code
        return $this->response->setJSON($rooms)->setStatusCode(200);
    }
}
