<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use Filterable;
    protected $table="fs_sources";
    public $timestamps=false;
    protected $guarded=[];

    public function rules()
    {
        return $this->hasOne(SourceRules::class,'source_id','id');
    }
}
