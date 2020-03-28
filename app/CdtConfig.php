<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtConfig extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_config";
    
    protected $guarded = [];
}
