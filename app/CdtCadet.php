<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CdtCadet extends Model
{
    use HasHashSlug;
    
    protected $table = "cdt_cadets";
    
    protected $guarded = [];
    
    public function stateOfOrigin() {
        return $this->belongsTo('App\CdtState');
    }
    
    public function course() {
        return $this->belongsTo('App\CdtCourse');
    }
    
    public function exams() {
        return $this->hasMany('App\CdtExam');
    }
    
    public function qualities() {
        return $this->hasMany('App\CdtQuality');
    }
    
    public function checks() {
        return $this->hasMany('App\CdtCheck');
    }
}
