<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtState extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_states";
    
    protected $guarded = [];
    
    public function regions() {
        return $this->hasMany('App\CdtRegion');
    }
}
