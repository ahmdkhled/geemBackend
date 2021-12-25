<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_detail extends Model
{
    use HasFactory;
    protected $table='user_details';
    protected $fillable=['username','fullName','gov','role_id','user_id','category_id'];
    public $timestamps=false;

    public function category()
    {
        return $this->belongsTo(category::class,'category_id');
    }
    public function role()
    {
        return $this->belongsTo(role::class,'role_id');
    }
}
