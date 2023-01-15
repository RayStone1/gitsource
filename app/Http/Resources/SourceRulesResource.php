<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SourceRulesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'province'=>new ProvinceResource($this->province),
            'mun_one'=>new MunOneResource($this->mun_one),
            'mun_two'=>new MunTwoResource($this->mun_two),
            'name'=>new NameResource($this->name),
        ];

    }
}
