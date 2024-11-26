<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    
    use HasApiTokens, HasFactory;

    protected $primaryKey = 'user_id'; // Primary key non-increment
    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'password',
        'phone_number',
        'name',
        'username',
        'email',
        'profile_picture',
    ];

    // Relasi satu ke satu dengan MyLink
    public function myLink()
    {
        return $this->hasOne(MyLink::class, 'user_id'); // 'user_id' adalah foreign key
    }

}
