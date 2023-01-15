<?php

namespace App\Http\Controllers;

use App\Http\Requests\MunTwoRequest;
use App\Http\Requests\SynonymRequest;
use App\Http\Resources\SynonymResource;
use App\Models\MunTwo;
use App\Models\MunTwoSyn;
use Illuminate\Http\Request;

class MunTwoSynonymController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MunTwo $mun_two)
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
    public function store(MunTwo $mun_two,SynonymRequest $request)
    {
        $data=$request->validated();
        $result=MunTwoSyn::firstOrCreate([
            'l2_id'=>$mun_two->id,
            'name'=>$data['name'],
            'minD'=>$data['minD'],
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
    public function update(MunTwoRequest $request,MunTwo $mun_two,MunTwoSyn $synonym)
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
    public function destroy($mun_two,MunTwoSyn $synonym)
    {
        $synonym->delete();
    }
}
