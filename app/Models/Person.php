<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'persons';
    public $timestamps = false;
    protected $primaryKey = 'person_id';
    protected $keyType = 'string';
    protected $fillable = [
        'user_id',
        'person_name',
        'person_phone',
        'person_email',
        'person_age',
        'person_address',
    ];
}
