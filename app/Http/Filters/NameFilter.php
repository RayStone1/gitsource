<?php

namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class NameFilter extends AbstractFilter
{
    public const PROVINCE='province';
    public const MUN_ONE='mun_one';
    public const MUN_TWO='mun_two';

    protected function getCallbacks(): array
    {
        return [
            self::PROVINCE=>[$this,'province'],
            self::MUN_ONE=>[$this,'mun_one'],
            self::MUN_TWO=>[$this,'mun_two'],
        ];
    }
    public function province(Builder $builder,$value){
        $builder->where('province_id',$value);
    }
    public function mun_one(Builder $builder,$value){
        $builder->where('l1_id',$value);
    }
    public function mun_two(Builder $builder,$value){
        $builder->where('l2_id',$value);
    }

}
