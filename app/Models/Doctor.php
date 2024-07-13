<?php

namespace FluentPlugin\App\Models;

use FluentPlugin\App\Models\Model;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Model
{
    // use HasFactory;
    protected $table = 'doctors';

    protected $fillable = [
        'username',
         'password',
          'email', 
          'name',
           'specialty',
            'contact_info'
            
    ];

    protected $hidden = [
        'password',
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
