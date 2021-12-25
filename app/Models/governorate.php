<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class governorate extends Model
{
    use HasFactory;
    protected $table='governorate';
    protected $fillable=['id','name'];
    public $timestamps=false;
    //relation fe el user w el result
}
