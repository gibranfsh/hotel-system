<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReservationPICModel;
use Firebase\JWT\JWT;

helper('cookie');

class Login extends BaseController
{
    public function index()
    {
        return view('layout/header') . view('pages/login');
    }

    public function loginAction()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $picModel = new ReservationPICModel();

        $pic = $picModel->where('email', $email)->first();

        if (!$pic) {
            session()->setFlashdata('error', 'Email tidak ditemukan');
            return redirect()->to('/login');
        }

        // dd($password, $pic['password']);
        if (!password_verify($password, $pic['password'])) {
            session()->setFlashdata('error', 'Password salah');
            return redirect()->to('/login');
        }

        $key = getenv("JWT_SECRET");

        $iat = time();
        $exp = $iat + (60 * 60 * 3);

        $payload = [
            "iss" => "ci4-jwt",
            "sub" => "login_token",
            "iat" => $iat,
            "exp" => $exp,
            "data" => [
                "id" => $pic['id'],
                "email" => $pic['email'],
                "name" => $pic['name'],
                "phoneNumber" => $pic['phoneNumber'],
                "address" => $pic['address'],
            ]
        ];

        $token = JWT::encode($payload, $key, "HS256");

        setcookie('login_token', $token, time() + 3600, "/"); // 3600 seconds = 1 hour

        if (isset($_COOKIE["login_token"])) {
            echo $_COOKIE["login_token"];
        } else {
            echo "Cookie 'login_token' is not set!";
        }

        return redirect()->to('/');
    }

    // login for hotel providers, accept email and password from request body
    public function loginActionProvider()
    {
        // get request body
        $body = $this->request->getJSON();

        // get email and password from request body
        $email = $body->email;
        $password = $body->password;

        // check if email and password is empty
        if (empty($email) || empty($password)) {
            // return error response
            return $this->response->setJSON(['error' => 'Email and password are required'])->setStatusCode(400);
        }

        $picModel = new ReservationPICModel();

        $pic = $picModel->where('email', $email)->first();

        if (!$pic) {
            return $this->response->setJSON(['error' => 'Account not found'])->setStatusCode(404);
        }

        // dd($password, $pic['password']);
        if (!password_verify($password, $pic['password'])) {
            return $this->response->setJSON(['error' => 'Email or password is incorrect'])->setStatusCode(400);
        }

        $key = getenv("JWT_SECRET");

        $iat = time();
        $exp = $iat + (60 * 60 * 3); 

        $payload = [
            "iss" => "ci4-jwt",
            "sub" => "login_token",
            "iat" => $iat,
            "exp" => $exp,
            "data" => [
                "id" => $pic['id'],
                "email" => $pic['email'],
                "name" => $pic['name'],
                "phoneNumber" => $pic['phoneNumber'],
                "address" => $pic['address'],
            ]
        ];

        try {
            $token = JWT::encode($payload, $key, "HS256");
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => $e->getMessage()])->setStatusCode(500);
        }

        // return success response with pic data and token
        return $this->response->setJSON(['data' => $pic, 'token' => $token])->setStatusCode(200);
    }

    // logout delete cookie
    public function logout()
    {
        setcookie('login_token', '', time() - 3600, "/"); // 3600 seconds = 1 hour
        return redirect()->to('/login');
    }
}
