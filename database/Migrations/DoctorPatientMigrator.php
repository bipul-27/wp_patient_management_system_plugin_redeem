<?php

namespace FluentPlugin\Database\Migrations;

class DoctorPatientMigrator
{
    static $tableName = 'doctor_patient';

    public static function migrate()
    {
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();

        $table = $wpdb->prefix. static::$tableName;

        $sql="CREATE TABLE $table(
        doctor_id INT UNSIGNED NOT NULL,
        patient_id INT UNSIGNED NOT NULL,
        created_at TIMESTAMP NULL,
        updated_at TIMESTAMP NULL,
        FOREIGN KEY(doctor_id) REFERENCES {$wpdb->prefix}doctors(doctor_id),
        FOREIGN KEY(patient_id) REFERENCES {$wpdb->prefix}patients(patient_id)
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