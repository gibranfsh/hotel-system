<?php

namespace App\Filters;

helper('cookie');

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default, it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Retrieve token from the cookie
        $token = get_cookie('login_token');

        if (!$token) {
            // Token not found, redirect to login
            return redirect()->to('/login');
        }

        // Verify the token
        $key = getenv("JWT_SECRET");

        try {
            $decoded = JWT::decode($token, new Key($key, "HS256"));
            // Token is valid, you can access user data using $decoded
            return $request;
        } catch (\Exception $e) {
            // Token is invalid, redirect to login
            // send error message to response
            return redirect()->to('/login');
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop the execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // You can perform additional logic after the controller has executed
        return $response;
    }
}
