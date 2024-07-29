<?php


use FluentPlugin\App\Http\Controllers\DoctorController;
use FluentPlugin\App\Http\Controllers\PatientController;


    $router->prefix('doctors')->group(function ($router) {
        $router->get('/', [DoctorController::class, 'index']);
        $router->post('/', [DoctorController::class, 'store']);
        $router->get('/{id}', [DoctorController::class, 'show'])->int('id');
        $router->put('/{id}', [DoctorController::class, 'update'])->int('id');
        $router->delete('/{id}', [DoctorController::class, 'destroy'])->int('id');
    });

    //Define routes for patients
    $router->prefix('doctors/{doctorId}/patients')->group(function ($router) {
        $router->get('/', [PatientController::class, 'index']);
        $router->post('/', [PatientController::class, 'store']);
    //     $router->get('/{id}', [PatientController::class, 'show'])->int('id');
        $router->put('/{id}', [PatientController::class, 'update'])->int('id');
        $router->delete('/{id}', [PatientController::class, 'destroy'])->int('id');
    //     $router->get('/condition/{condition}', [PatientController::class, 'filterByCondition'])->string('condition');
    });
