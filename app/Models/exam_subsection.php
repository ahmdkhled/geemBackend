<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exam_subsection extends Model
{
    use HasFactory;
protected $table='exam_sub_section';
protected $fillable=['exam_id','subsection_id'];
}
