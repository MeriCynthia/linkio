<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextBlock extends Model
{
    use HasFactory;

    protected $table = 'text_block';
    protected $primaryKey = 'textblock_id'; // Sesuaikan jika id utama memiliki nama berbeda
    protected $fillable = [
        'mylink_id',
        'title',
        'font',
        'alignment',
        'bold',
        'italic',
        'color',
    ];

    // Relasi ke MyLink
    public function mylink()
    {
        return $this->belongsTo(MyLink::class, 'mylink_id');
    }
}
