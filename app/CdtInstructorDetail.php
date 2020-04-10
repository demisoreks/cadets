<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtInstructorDetail extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_instructor_details";
    
    protected $guarded = [];
    
    public function state() {
        return $this->belongsTo('App\CdtState');
    }
    
    public function employee() {
        return $this->hasOne('App\AccEmployee');
    }
}
