<?php
/*
Plugin Name: Patient management
Description: A plugin that integrates Laravel for managing a patient management system.
Version: 1.0
Author: Bipul Karmokar
*/

register_activation_hook(__FILE__, 'activate_my_laravel_plugin');
register_deactivation_hook(__FILE__, 'deactivate_my_laravel_plugin');

function activate_my_laravel_plugin() {
    require_once plugin_dir_path(__FILE__) . 'database/Migrations/UserMigrator.php';
    require_once plugin_dir_path(__FILE__) . 'database/Migrations/DoctorMigrator.php';
    require_once plugin_dir_path(__FILE__) . 'database/Migrations/DoctorPatientMigrator.php';
    require_once plugin_dir_path(__FILE__) . 'database/Migrations/PatientConditionMigrator.php';
    require_once plugin_dir_path(__FILE__) . 'database/Migrations/PatientsMigrator.php';
    FluentPlugin\Database\Migrations\UserMigrator::migrate();
    FluentPlugin\Database\Migrations\DoctorMigrator::migrate();
    FluentPlugin\Database\Migrations\PatientsMigrator::migrate();
    
    
    FluentPlugin\Database\Migrations\PatientConditionMigrator::migrate();
    FluentPlugin\Database\Migrations\DoctorPatientMigrator::migrate();
    
    
   
}

function deactivate_my_laravel_plugin() {
    require_once plugin_dir_path(__FILE__) . 'database/Migrations/UserMigrator.php';
    require_once plugin_dir_path(__FILE__) . 'database/Migrations/DoctorMigrator.php';
    require_once plugin_dir_path(__FILE__) . 'database/Migrations/DoctorPatientMigrator.php';
    require_once plugin_dir_path(__FILE__) . 'database/Migrations/PatientConditionMigrator.php';
    require_once plugin_dir_path(__FILE__) . 'database/Migrations/PatientsMigrator.php';
    FluentPlugin\Database\Migrations\DoctorPatientMigrator::drop();
    FluentPlugin\Database\Migrations\PatientConditionMigrator::drop();
    FluentPlugin\Database\Migrations\PatientsMigrator::drop();
    FluentPlugin\Database\Migrations\DoctorMigrator::drop();
    FluentPlugin\Database\Migrations\UserMigrator::drop();
    
    
    
    
    
    
    
    
    
}
