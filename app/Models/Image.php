<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $primaryKey = 'image_id';
    protected $fillable = [
        'mylink_id',
        'image_name',
        'image',
    ];

    // Relasi ke MyLink (hanya satu image per MyLink)
    public function myLink()
    {
        return $this->belongsTo(MyLink::class, 'mylink_id');
    }
}

