<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Filters\MunOneFilter;
use App\Http\Requests\MunOneRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\MunOneResource;
use App\Models\MunOne;
use App\Models\SourceRules;
use Illuminate\Http\Request;

class MunOneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchRequest $request)
    {
        $data=$request->validated();
        if($data){
            $filter=app()->make(MunOneFilter::class,['queryParams'=>array_filter($data)]);
            $mun_one_id=SourceRules::query()->select('l1_id')->filter($filter)->groupBy('l1_id')->get();
            $mun_one=MunOne::find($mun_one_id)->sortBy('name');
        }
        else{
            $mun_one=MunOne::query()->orderBy('name')->get();
        }
        return MunOneResource::collection($mun_one);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MunOneRequest $request)
    {
        $data=$request->validated();
        $result=MunOne::firstOrCreate($data);
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MunOne  $munOne
     * @return \Illuminate\Http\Response
     */
    public function show(MunOne $mun_one)
    {
        return new MunOneResource($mun_one);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MunOne  $munOne
     * @return \Illuminate\Http\Response
     */
    public function update(MunOneRequest $request, MunOne $munOne)
    {
        $data=$request->validated();
        $result=$munOne->update($data);
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MunOne  $munOne
     * @return \Illuminate\Http\Response
     */
    public function destroy(MunOne $munOne)
    {
        //
    }
}
