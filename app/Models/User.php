<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    protected $fillable = [
        'password',
        'phone_number',
        'name',
        'username',
        'email',
        'profile_picture',
    ];

    // Relasi ke MyLink
    public function myLinks()
    {
        return $this->hasMany(MyLink::class, 'user_id');
    }
}
