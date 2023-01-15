<?php

namespace App\Http\Resources;

use App\Models\MunOne;
use Illuminate\Http\Resources\Json\JsonResource;

class MunOneResource extends JsonResource
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
            'synonyms'=>MunOneSynResource::collection($this->synonyms),
            'type'=>'mun-one'
        ];
    }
}
