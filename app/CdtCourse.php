<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtCourse extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_courses";
    
    protected $guarded = [];
    
    public function location() {
        return $this->belongsTo('App\CdtLocation');
    }
    
    public function cadets() {
        return $this->hasMany('App\CdtCadet');
    }
}
