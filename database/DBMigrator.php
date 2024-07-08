<?php

namespace FluentPlugin\Database;

use FluentPlugin\Database\Migrations\DoctorMigrator;
use FluentPlugin\Database\Migrations\PatientsMigrator;

class DBMigrator
{
    public static function run($network_wide = false)
    {
        static::migrate();
        
    }
    private static function migrate()
    {
        DoctorMigrator::migrate();
        PatientsMigrator::migrate();
        
    }
}
