<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MunTwo extends Model
{
    protected $table="fs_mun_l2";
    public $timestamps=false;
    protected $guarded=[];


    public function synonyms()
    {
        return $this->hasMany(MunTwoSyn::class,'l2_id','id');
    }
}
