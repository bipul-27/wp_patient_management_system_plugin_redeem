<?php

namespace FluentPlugin\App\Hooks\Handlers;

use FluentPlugin\Framework\Foundation\Application;
use FluentPlugin\Database\Migrations\DoctorMigrator;
use FluentPlugin\Database\Migrations\PatientsMigrator;

class DeactivationHandler
{
    protected $app = null;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    
    public function handle()
    {
        PatientsMigrator::drop();
        DoctorMigrator::drop();
        
    }
}
