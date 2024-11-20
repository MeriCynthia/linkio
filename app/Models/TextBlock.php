<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'mylink_id',
        'title',
        'font',
        'alignment',
        'bold',
        'italic',
        'color',
    ];

    // Relasi ke model MyLink
    public function mylink()
    {
        return $this->belongsTo(MyLink::class);
    }
}
