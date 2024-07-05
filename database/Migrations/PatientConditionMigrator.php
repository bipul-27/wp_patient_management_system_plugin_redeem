<?php

namespace FluentPlugin\Database\Migrations;

class PatientConditionMigrator
{
    static $tableName = 'patient_conditions';

    public static function migrate()
    {
        
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();
        $table = $wpdb->prefix . static::$tableName;

        $sql = "CREATE TABLE $table(
        condition_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        patient_id INT UNSIGNED NOT NULL,
        condition ENUM('critical' , 'stable' , 'other') NOT NULL,
        created_at TIMESTAMP NULL,
        updated_at TIMESTAMP NULL,
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