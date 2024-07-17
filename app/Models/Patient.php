<?php

namespace FluentPlugin\App\Models;

use FluentPlugin\App\Models\Model;



class Patient extends Model 
{
    
    protected $table = 'patients';
    protected $fillable = [
        'doctor_id',
        'name',
        'email', 
        'age', 
        'gender', 
        'contact_info', 
        'health_condition'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}