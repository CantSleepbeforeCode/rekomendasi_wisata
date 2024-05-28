<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuliner extends Model
{
    use HasFactory;
    protected $table = 'kuliners';
    public $timestamps = false;
    protected $primaryKey = 'kuliner_id';
    protected $keyType = 'string';
    protected $fillable = [
        'kuliner_name',
        'kuliner_description',
        'kuliner_picture',
        'kuliner_latitude',
        'kuliner_longitude',
        'kuliner_min_price',
        'kuliner_max_price',
    ];
}
