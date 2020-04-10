<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtState extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_states";
    
    protected $guarded = [];
    
    public function locations() {
        return $this->hasMany('App\CdtLocation');
    }
    
    public function cadets() {
        return $this->hasMany('App\CdtCadet');
    }
    
    public function instructorDetails() {
        return $this->hasMany('App\CdtInstructorDetail');
    }
}
