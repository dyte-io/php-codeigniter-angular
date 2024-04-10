<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->resource('meeting');
$routes->resource('participant');
// $routes->group('', ['filter' => 'cors'], static function (RouteCollection $routes): void {

//     $routes->options('meeting', static function () {
//         // Implement processing for normal non-preflight OPTIONS requests,
//         // if necessary.
//         $response = response();
//         $response->setStatusCode(204);
//         $response->setHeader('Allow:', 'OPTIONS, GET, POST, PUT, PATCH, DELETE');

//         return $response;
//     });
//     $routes->options('meeting/(:any)', static function () {
//     });
//     $routes->options('participant', static function () {
//         // Implement processing for normal non-preflight OPTIONS requests,
//         // if necessary.
//         $response = response();
//         $response->setStatusCode(204);
//         $response->setHeader('Allow:', 'OPTIONS, GET, POST, PUT, PATCH, DELETE');

//         return $response;
//     });
//     $routes->options('participant/(:any)', static function () {
//     });
// });
