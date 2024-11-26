<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyLink extends Model
{
    use HasFactory;

    protected $primaryKey = 'mylink_id';
    protected $fillable = [
        'user_id',
        'total_views',
        'total_clicks',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke LinkBlock (banyak)
    public function linkBlocks()
    {
        return $this->hasMany(LinkBlock::class, 'mylink_id');
    }

    // Relasi ke ImageBlock (hanya satu)
    public function image()
    {
        return $this->hasOne(Image::class, 'mylink_id');
    }

}
