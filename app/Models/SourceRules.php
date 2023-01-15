<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceRules extends Model
{
    use Filterable;

    protected $table="fs_source_rules";
    public $timestamps=false;
    protected $primaryKey='source_id';
    protected $guarded=[];

    public function province()
    {
        return $this->belongsTo(Province::class,'province_id','id');
    }
    public function mun_one()
    {
        return $this->belongsTo(MunOne::class,'l1_id','id');
    }
    public function mun_two()
    {
        return $this->belongsTo(MunTwo::class,'l2_id','id');
    }
    public function name()
    {
        return $this->belongsTo(Name::class,'name_id','id');
    }

    public function source()
    {
        return $this->belongsTo(Source::class,'source_id','id');
    }
}
