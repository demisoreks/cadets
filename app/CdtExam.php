<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtExam extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_exam";
    
    protected $guarded = [];
    
    public function metric() {
        return $this->belongsTo('App\CdtMetric');
    }
    
    public function cadet() {
        return $this->belongsTo('App\CdtCadet');
    }
}
