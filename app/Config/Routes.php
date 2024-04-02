<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index');

use App\Controllers\Pages;
use App\Controllers\Home;
use App\Controllers\Voucher;

$routes->get('pages', [Pages::class, 'index']);
$routes->get('voucher', [Voucher::class, 'index']);
$routes->post('voucher/getData', [Voucher::class, 'getData']);
$routes->get('voucher/new/(:any)', 'Voucher::new/$1');
$routes->get('(:segment)', [Pages::class, 'view']);


//page voucher

$routes->get('voucher/(:any)', 'Voucher::voucherLookup/$1');
