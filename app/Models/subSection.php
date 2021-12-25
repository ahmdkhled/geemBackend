<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subSection extends Model
{
    use HasFactory;
    protected $table='sub_sections';
    protected $fillable=['name','section_id'];
    public $timestamps=false;
    public function examsubsection()
    {
        return $this->belongsToMany(exam::class,'exam_sub_section','exam_id','subsection_id');
    }
    public function section()
    {
        return $this->belongsTo(section::class,'section_id');
    }
    public function exam()
    {
        return $this->belongsTo(exam::class,'subsection_id');
    }

}
