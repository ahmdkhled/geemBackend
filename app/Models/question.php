<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory;
    protected $table='questions';
    protected $fillable=['id','textQuestion','exam_id','choices','rightChoice'];
    public $timestamps=false;

    public function exam()
    {
        return $this->belongsTo(exam::class,'exam_id');
    }
}
