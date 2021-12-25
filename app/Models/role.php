<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table='roles';
    use HasFactory;

    public function user_details()
    {
        return $this->hasMany(user_detail::class,'role_id');
    }
}
