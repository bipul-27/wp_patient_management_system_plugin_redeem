<?php

defined( 'ABSPATH' ) || exit;

/**
 * @var $router FluentBooking\Framework\Http\Router
 */
    
    $router->post('/', 'DoctorController@index');