<?php

namespace App\Http\Controllers;

use App\Http\Filters\MunTwoFilter;
use App\Http\Requests\MunTwoRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\MunTwoResource;
use App\Models\MunTwo;
use App\Models\SourceRules;
use Illuminate\Http\Request;

class MunTwoController extends Controller
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
            $filter=app()->make(MunTwoFilter::class,['queryParams'=>array_filter($data)]);
            $mun_two_id=SourceRules::select('l2_id')->filter($filter)->groupBy('l2_id')->get();
            $mun_two=MunTwo::find($mun_two_id)->sortBy('name');
        }
        else{
            $mun_two=MunTwo::query()->orderBy('name')->get();
        }
        return MunTwoResource::collection($mun_two);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MunTwoRequest $request)
    {
        $data=$request->validated();
        $result=MunTwo::firstOrCreate($data);
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MunTwo  $munTwo
     * @return \Illuminate\Http\Response
     */
    public function show(MunTwo $mun_two)
    {
        return new MunTwoResource($mun_two);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MunTwo  $munTwo
     * @return \Illuminate\Http\Response
     */
    public function edit(MunTwo $munTwo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MunTwo  $munTwo
     * @return \Illuminate\Http\Response
     */
    public function update(MunTwoRequest $request, MunTwo $munTwo)
    {
        $data=$request->validated();
        $munTwo->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MunTwo  $munTwo
     * @return \Illuminate\Http\Response
     */
    public function destroy(MunTwo $munTwo)
    {
        //
    }
}
