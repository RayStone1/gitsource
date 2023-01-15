<?php

namespace App\Http\Controllers;

use App\Http\Filters\SourceFilter;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\SourceRequest;
use App\Http\Requests\SourceRulesRequest;
use App\Http\Resources\SearchSourceResource;
use App\Models\SourceRules;
use Illuminate\Http\Request;

class SourceRulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchRequest $request)
    {
        $data=$request->validated();
        $filter=app()->make(SourceFilter::class,['queryParams'=>array_filter($data)]);
        $sources=SourceRules::filter($filter)->get();
        return SearchSourceResource::collection($sources);
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
    public function store(SourceRulesRequest $request)
    {
        $data=$request->validated();
        return $data;
        $result=SourceRules::firstOrCreate([]);
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SourceRules  $sourceRules
     * @return \Illuminate\Http\Response
     */
    public function show(SourceRules $sourceRules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SourceRules  $sourceRules
     * @return \Illuminate\Http\Response
     */
    public function edit(SourceRules $sourceRules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SourceRules  $sourceRules
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SourceRules $sourceRules)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SourceRules  $sourceRules
     * @return \Illuminate\Http\Response
     */
    public function destroy(SourceRules $sourceRules)
    {
        //
    }
}
