<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtBand extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_bands";
    
    protected $guarded = [];
}
