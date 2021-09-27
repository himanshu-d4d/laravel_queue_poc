<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class socialRegister extends Model
{
    use HasFactory;
    protected $table = 'social_register';
    protected $fillable = [     
        'name',
        'email',
        'provider_name',
        'provider_id',
        'image',
    ];
}
