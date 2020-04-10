<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtAssessment extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_assessments";
    
    protected $guarded = [];
    
    public function checks() {
        return $this->hasMany('App\CdtCheck');
    }
}
