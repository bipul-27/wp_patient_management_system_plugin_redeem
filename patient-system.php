<?php defined('ABSPATH') or die;
/*
Plugin Name: Patient management
Description: A plugin that integrates Laravel for managing a patient management system.
Version: 1.0
Author: Bipul Karmokar
*/

require __DIR__ . '/vendor/autoload.php';

call_user_func(function ($bootstrap) {
    $bootstrap(__FILE__);
}, require(__DIR__ . '/boot/app.php'));


// use FluentPlugin\App\Hooks\Handlers\ActivationHandler;

// define('DOCTOR_PLUGIN_PATH', trailingslashit(plugin_dir_path( __FILE__ )));
// define('DOCTOR_PLUGIN_URL',trailingslashit(plugin_dir_url( '',__FILE__ )));

// register_activation_hook(__FILE__, 'activate_my_laravel_plugin');

// register_deactivation_hook(__FILE__, 'deactivate_my_laravel_plugin');


// function activate_my_laravel_plugin() {
    
    
//     require_once plugin_dir_path(__FILE__) . 'database/Migrations/DoctorMigrator.php';
    
//     require_once plugin_dir_path(__FILE__) . 'database/Migrations/PatientsMigrator.php';

   
//     FluentPlugin\Database\Migrations\DoctorMigrator::migrate();
//      FluentPlugin\Database\Migrations\PatientsMigrator::migrate();
    
     
    
// }

// function deactivate_my_laravel_plugin() {
   
//     require_once plugin_dir_path(__FILE__) . 'database/Migrations/DoctorMigrator.php';
    
//     require_once plugin_dir_path(__FILE__) . 'database/Migrations/PatientsMigrator.php';
    
//     FluentPlugin\Database\Migrations\PatientsMigrator::drop();
//     FluentPlugin\Database\Migrations\DoctorMigrator::drop(); 
// }
// add_action('admin_menu', 'my_laravel_plugin_admin_menu');
// add_action('admin_enqueue_scripts','register_scripts_styles');

// function register_scripts_styles()
// {
//     load_scripts();
//     load_styles();
// }

// function load_scripts()
// {
   
// }

// function load_styles()
// {
//     wp_register_style('doctor_admin',DOCTOR_PLUGIN_URL. 'assets/admin/admin.css');
//     wp_enqueue_style( 'doctor_admin');
// }

// function admin_menu()
// {
//     global $submenu;

//     $capability='manage_options';
//     $slug= 'doctor_list';

//     add_menu_page(
//         __('Doctor List', 'textdomain'),
//         __('Doctor List', 'textdomain'),
//         $capability,
//         $slug,
//         [$this, 'menu-page-template'],
//         ''

//     );

//     if(current_user_can( $capability ))
//     {
//         $submenu[$slug][] = [__('List','textdomain'), $capability, 'admin.php?page='.$slug.'#/'];
//     }
// }
function my_laravel_plugin_admin_menu() {
    // $capability = 'manage_options';
    // $slug = 'doctor_list';

    // add_menu_page(
    //     __('Doctor List', 'textdomain'),
    //     __('Doctor List', 'textdomain'),
    //     $capability,
    //     $slug,
    //     'menu_page_template',
    //     ''
    // );

    // add_submenu_page(
    //     $slug,
    //     __('List', 'textdomain'),
    //     __('List', 'textdomain'),
    //     $capability,
    //     $slug . '_list',
    //     'my_laravel_plugin_submenu_page_template'
    // );
}

// function menu_page_template()
// {
//     echo '<div class="wrap"><div id="doctor_list"></div></div>';
// }

