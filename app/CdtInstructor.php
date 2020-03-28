<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtInstructor extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_instructors";
    
    protected $guarded = [];
    
    public function region() {
        return $this->belongsTo('App\CdtRegion');
    }
    
    public function employee() {
        return $this->belongsTo('App\AccEmployee');
    }
}
