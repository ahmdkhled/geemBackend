<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    use HasFactory;
    protected $table='sections';
    protected $fillable=['name','material_id'];
public $timestamps=false;

    public function material()
    {
        return $this->belongsTo(material::class,'material_id');
    }

    public function sub_section()
    {
        return $this->hasMany(subSection::class,'section_id');
    }
}
