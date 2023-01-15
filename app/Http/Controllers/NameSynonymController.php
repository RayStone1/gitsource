<?php

namespace App\Http\Controllers;

use App\Http\Requests\NameRequest;
use App\Http\Requests\SynonymRequest;
use App\Http\Resources\SynonymResource;
use App\Models\Name;
use App\Models\NameSyn;
use Illuminate\Http\Request;

class NameSynonymController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Name $mun_two)
    {
        $data=$mun_two->synonyms;
        return SynonymResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Name $name,SynonymRequest $request)
    {
        $data=$request->validated();
        $result=NameSyn::firstOrCreate([
            'name_id'=>$name->id,
            'name'=>$data['name']
        ]);
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NameRequest $request, Name $name,NameSyn $synonym)
    {
        $data=$request->validated();
        $synonym->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($names,NameSyn $synonym)
    {
        $synonym->delete();
    }
}
