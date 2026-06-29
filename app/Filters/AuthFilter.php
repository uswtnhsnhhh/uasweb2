<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Allow GET requests to public endpoints
        if (strtolower($request->getMethod()) === 'get') {
            return null;
        }

        $authHeader = $request->getHeaderLine('Authorization');
        if (empty($authHeader)) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['status' => false, 'message' => 'Unauthorized']);
        }

        if (!preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['status' => false, 'message' => 'Unauthorized']);
        }

        $token = $matches[1];

        $file = WRITEPATH . 'tokens.json';
        if (!is_file($file)) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['status' => false, 'message' => 'Unauthorized']);
        }

        $content = file_get_contents($file);
        $tokens = json_decode($content, true) ?: [];

        if (!isset($tokens[$token])) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['status' => false, 'message' => 'Unauthorized']);
        }

        // Token valid, allow request
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // no-op
    }
}
