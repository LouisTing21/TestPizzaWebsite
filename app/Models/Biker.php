<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biker extends Model
{
    use HasFactory;

    protected $fillable=[
        'biker_id',
        'name',
        'phone',
        'address',
        'gender',
    ];
}
