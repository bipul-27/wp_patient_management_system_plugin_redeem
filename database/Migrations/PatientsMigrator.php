<?php

namespace FluentPlugin\Database\Migrations;

class PatientsMigrator
{
    static $tableName = 'patients';

    public static function migrate()
    {
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();
        $table = $wpdb->prefix. static::$tableName;

        $sql = "CREATE TABLE $table(
        patient_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        doctor_id INT UNSIGNED NOT NULL,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        age INT NULL,
        gender ENUM('male','female', 'others') NOT NULL,
        contact_info VARCHAR(255) NULL,
        created_at TIMESTAMP NULL,
        updated_at TIMESTAMP NULL,
        FOREIGN KEY(doctor_id) REFERENCES {$wpdb->prefix}doctors(doctor_id)
        )$charsetCollate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }
    public static function drop()
    {
        global $wpdb;
        $table = $wpdb->prefix . static::$tableName;
        $wpdb->query("DROP TABLE IF EXISTS $table");
    }


}