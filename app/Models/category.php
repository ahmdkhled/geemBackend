<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table='category';
    protected $fillable=['id','name'];

    public function user_detail()
    {
        return $this->hasMany(User_detail::class,'category_id');
    }

    public function material()
    {
        return $this->hasMany(material::class,'category_id');
    }
}
