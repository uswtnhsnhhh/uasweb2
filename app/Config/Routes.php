<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

/* =======================
   AUTH
======================= */
$routes->post('api/login', 'Api\Login::index');
$routes->options('api/login', static function () {
    return service('response')->setStatusCode(200);
});

/* =======================
   KATEGORI
======================= */
$routes->group('api', function($routes) {

    // CORS Preflight
    $routes->options('categories', static function () {
        return service('response')->setStatusCode(200);
    });

    $routes->options('categories/(:any)', static function () {
        return service('response')->setStatusCode(200);
    });

    $routes->options('supplier', static function () {
        return service('response')->setStatusCode(200);
    });

    $routes->options('supplier/(:any)', static function () {
        return service('response')->setStatusCode(200);
    });

    $routes->options('barang', static function () {
        return service('response')->setStatusCode(200);
    });

    $routes->options('barang/(:any)', static function () {
        return service('response')->setStatusCode(200);
    });

    $routes->get('categories', 'Api\Kategori::index');
    $routes->post('categories', 'Api\Kategori::create');
    $routes->get('categories/(:num)', 'Api\Kategori::show/$1');
    $routes->put('categories/(:num)', 'Api\Kategori::update/$1');
    $routes->delete('categories/(:num)', 'Api\Kategori::delete/$1');

    /* =======================
       SUPPLIER
    ======================= */
    $routes->get('supplier', 'Api\Supplier::index');
    $routes->post('supplier', 'Api\Supplier::create');
    $routes->get('supplier/(:num)', 'Api\Supplier::show/$1');
    $routes->put('supplier/(:num)', 'Api\Supplier::update/$1');
    $routes->delete('supplier/(:num)', 'Api\Supplier::delete/$1');

    /* =======================
       BARANG
    ======================= */
    $routes->get('barang', 'Api\Barang::index');
    $routes->post('barang', 'Api\Barang::create');
    $routes->get('barang/(:num)', 'Api\Barang::show/$1');
    $routes->put('barang/(:num)', 'Api\Barang::update/$1');
    $routes->delete('barang/(:num)', 'Api\Barang::delete/$1');

});
