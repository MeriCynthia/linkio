<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkBlock extends Model
{
    use HasFactory;

    protected $primaryKey = 'link_block_id';
    protected $fillable = [
        'mylink_id',
        'link_title',
        'url',
    ];

    // Relasi ke tabel mylinks (banyak link_block dimiliki satu mylink)
    public function mylink()
    {
        return $this->belongsTo(MyLink::class, 'mylink_id');
    }
}