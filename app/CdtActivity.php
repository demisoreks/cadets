<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtActivity extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_activities";
    
    protected $guarded = [];
}
