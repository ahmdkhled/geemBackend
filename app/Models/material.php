<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class material extends Model
{
    use HasFactory;
    protected $table='materials';
    protected $fillable=['name','photo','category_id'];
    public $timestamps=false;
    public function category()
    {
        return $this->belongsTo(category::class,'category_id');
    }

    public function section()
    {
        return $this->hasMany(section::class,'material_id');
    }

    public function subsection()
    {
        return $this->hasManyThrough(subSection::class, section::class, 'material_id', 'section_id');
    }
}
