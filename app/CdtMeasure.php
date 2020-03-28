<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtMeasure extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_measures";
    
    protected $guarded = [];
}
