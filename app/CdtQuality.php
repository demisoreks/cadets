<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtQuality extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_quality";
    
    protected $guarded = [];
    
    public function measure() {
        return $this->belongsTo('App\CdtMeasure');
    }
    
    public function cadet() {
        return $this->belongsTo('App\CdtCadet');
    }
}
