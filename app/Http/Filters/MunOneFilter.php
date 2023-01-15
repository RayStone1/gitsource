<?php

namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class MunOneFilter extends AbstractFilter
{
    public const PROVINCE='province';
    public const NAME='name';

    protected function getCallbacks(): array
    {
        return [
            self::PROVINCE=>[$this,'province'],
            self::NAME=>[$this,'name'],
        ];
    }
    public function province(Builder $builder,$value){
        $builder->where('province_id',$value);
    }
    public function name(Builder $builder,$value){
        $builder->where('name_id',$value);
    }

}
