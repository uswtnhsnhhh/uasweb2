<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        $input = $this->request->getJSON(true);

        $username = isset($input['username']) ? $input['username'] : null;
        $password = isset($input['password']) ? $input['password'] : null;

        if (!$username || !$password) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'username and password required'
            ]);
        }

        $userModel = new UserModel();

        $user = $userModel
            ->where('username', $username)
            ->where('password', md5($password))
            ->first();

        if ($user) {
            try {
                $token = bin2hex(random_bytes(16));
            } catch (\Exception $e) {
                $token = 'TOK' . time() . bin2hex(substr(md5($username . time()), 0, 8));
            }

            $file = WRITEPATH . 'tokens.json';
            $tokens = [];
            if (is_file($file)) {
                $tokens = json_decode(file_get_contents($file), true) ?: [];
            }

            $tokens[$token] = [
                'username' => $username,
                'created_at' => date('c')
            ];

            file_put_contents($file, json_encode($tokens, JSON_PRETTY_PRINT));

            return $this->response->setJSON([
                'status' => true,
                'token' => $token,
                'user' => [
                    'username' => $username
                ]
            ]);
        }

        return $this->response
            ->setStatusCode(401)
            ->setJSON([
                'status' => false,
                'message' => 'Username atau password salah'
            ]);
    }
}