<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Cors implements FilterInterface
{
    protected $allowedOrigin = 'http://localhost:5173';
    protected $allowedMethods = 'GET, POST, PUT, DELETE, OPTIONS';
    protected $allowedHeaders = 'Content-Type, Authorization, X-Requested-With';

    public function before(RequestInterface $request, $arguments = null)
    {
        $response = service('response');

        $response->setHeader('Access-Control-Allow-Origin', $this->allowedOrigin);
        $response->setHeader('Access-Control-Allow-Headers', $this->allowedHeaders);
        $response->setHeader('Access-Control-Allow-Methods', $this->allowedMethods);
        $response->setHeader('Access-Control-Allow-Credentials', 'true');

        // Handle preflight request
        if (strtoupper($request->getMethod()) === 'OPTIONS') {
            return $response->setStatusCode(200);
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Ensure headers are present on normal responses
        $response->setHeader('Access-Control-Allow-Origin', $this->allowedOrigin);
        $response->setHeader('Access-Control-Allow-Headers', $this->allowedHeaders);
        $response->setHeader('Access-Control-Allow-Methods', $this->allowedMethods);
        $response->setHeader('Access-Control-Allow-Credentials', 'true');
    }
}
