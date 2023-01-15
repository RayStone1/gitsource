<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MunTwoResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'mind'=>$this->minD,
            'synonyms'=>MunTwoSynResource::collection($this->synonyms),
            'type'=>'mun-two'
        ];
    }
}
