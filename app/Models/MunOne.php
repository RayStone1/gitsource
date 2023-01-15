<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MunOne extends Model
{
    protected $table="fs_mun_l1";
    public $timestamps=false;
    protected $guarded=false;
    public function synonyms()
    {
        return $this->hasMany(MunOneSyn::class,'l1_id','id');
    }
}
