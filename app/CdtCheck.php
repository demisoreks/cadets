<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtCheck extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_checks";
    
    protected $guarded = [];
    
    public function cadet() {
        return $this->belongsTo('App\CdtCadet');
    }
    
    public function assessment() {
        return $this->belongsTo('App\CdtAssessment');
    }
}
