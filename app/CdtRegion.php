<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtRegion extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_regions";
    
    protected $guarded = [];
    
    public function locations() {
        return $this->hasMany('App\CdtLocation');
    }
    
    public function instructors() {
        return $this->hasMany('App\CdtInstructor');
    }
}
