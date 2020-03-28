<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtLocation extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_locations";
    
    protected $guarded = [];
    
    public function region() {
        return $this->belongsTo('App\CdtRegion');
    }
}
