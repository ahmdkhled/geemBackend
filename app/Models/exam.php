<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exam extends Model
{
    use HasFactory;
    protected $fillable=['id','name','acive','subsection_id','type'];

    protected $table='exams';

    public function examsubsection()
    {
        return $this->belongsToMany(subSection::class,'exam_sub_section','exam_id','subsection_id');
    }
    public function question()
    {
        return $this->hasMany(question::class,'exam_id');
    }
    public function result()
    {
        return $this->hasMany(result::class,'exam_id');
    }
    public function subsection()
    {
        return $this->belongsTo(subSection::class,'subsection_id');
    }
}
