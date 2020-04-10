<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtMetric extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_metrics";
    
    protected $guarded = [];
    
    public function exams() {
        return $this->hasMany('App\CdtExam');
    }
}
