<?php

namespace FluentPlugin\App\Models;

use FluentPlugin\App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Model 
{
    use HasFactory;
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