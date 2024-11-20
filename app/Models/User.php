<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id'; // Primary key non-increment
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'password',
        'phone_number',
        'name',
        'username',
        'email',
        'profile_picture'
    ];
}
