<?php

namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class MunTwoFilter extends AbstractFilter
{
    public const PROVINCE='province';
    public const MUN_ONE='mun_one';
    public const NAME='name';

    protected function getCallbacks(): array
    {
        return [
            self::PROVINCE=>[$this,'province'],
            self::MUN_ONE=>[$this,'mun_one'],
            self::NAME=>[$this,'name'],
        ];
    }
    public function province(Builder $builder,$value){
        $builder->where('province_id',$value);
    }
    public function mun_one(Builder $builder,$value){
        $builder->where('l1_id',$value);
    }
    public function name(Builder $builder,$value){
        $builder->where('name_id',$value);
    }

}
