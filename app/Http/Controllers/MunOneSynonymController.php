<?php

namespace App\Http\Controllers;

use App\Http\Requests\MunOneRequest;
use App\Http\Requests\SynonymRequest;
use App\Http\Resources\SynonymResource;
use App\Models\MunOne;
use App\Models\MunOneSyn;
use Illuminate\Http\Request;

class MunOneSynonymController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MunOne $mun_one)
    {
        $data=$mun_one->synonyms;
        return SynonymResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MunOne $mun_one,SynonymRequest $request)
    {
        $data=$request->validated();
        $result=MunOneSyn::firstOrCreate([
            'l1_id'=>$mun_one->id,
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
    public function update(MunOneRequest $request,MunOne $munOne, MunOneSyn $synonym)
    {
        unset($request['type'],$request['parent_id']);
        $data=$request->validated();
        $result=$synonym->update($data);
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($mun_one,MunOneSyn $synonym)
    {
        $synonym->delete();
    }
}
