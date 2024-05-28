<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;
    protected $table = 'wisatas';
    public $timestamps = false;
    protected $primaryKey = 'wisata_id';
    protected $keyType = 'string';
    protected $fillable = [
        'wisata_name',
        'wisata_description',
        'wisata_picture',
        'wisata_latitude',
        'wisata_longitude',
        'wisata_min_price',
        'wisata_max_price',
    ];
}
