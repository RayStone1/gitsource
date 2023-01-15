<?php

namespace App\Http\Controllers;

use App\Http\Filters\NameFilter;
use App\Http\Requests\NameRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\NameResource;
use App\Models\Name;
use App\Models\SourceRules;
use Illuminate\Http\Request;

class NameController extends Controller
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
            $filter=app()->make(NameFilter::class,['queryParams'=>array_filter($data)]);
            $name_id=SourceRules::select('name_id')->filter($filter)->groupBy('name_id')->get();
            $names=Name::find($name_id)->sortBy('name');
        }
        else{
            $names=Name::query()->orderBy('name')->get();
        }
        return NameResource::collection($names);
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
    public function store(NameRequest $request)
    {
        $data=$request->validated();
        $result=Name::firstOrCreate($data);
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Name  $name
     * @return \Illuminate\Http\Response
     */
    public function show(Name $name)
    {
        return new NameResource($name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Name  $name
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Name  $name
     * @return \Illuminate\Http\Response
     */
    public function update(NameRequest $request, Name $name)
    {
        $data=$request->validated();
        $result=$name->update($data);
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Name  $name
     * @return \Illuminate\Http\Response
     */
    public function destroy(Name $name)
    {
        //
    }
}
