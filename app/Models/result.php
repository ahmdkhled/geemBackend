<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class result extends Model
{
    use HasFactory;
    protected $table='results';
    protected $fillable=['result','exam_id','user_id','gov'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function exam()
    {
        return $this->belongsTo(exam::class,'exam_id');
    }
}
