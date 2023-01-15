<?php

namespace App\Http\Controllers;

use App\Http\Filters\SourceFilter;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\SourceRequest;
use App\Http\Resources\SearchSourceResource;
use App\Http\Resources\SourceResource;
use App\Http\Resources\SourcesResources;
use App\Models\MunOne;
use App\Models\MunTwo;
use App\Models\Name;
use App\Models\Province;
use App\Models\Source;
use App\Models\SourceRules;
use Illuminate\Http\Request;

class   SourceController extends Controller
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
        return SourceResource::collection($sources);
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
    public function store(SourceRequest $request)
    {
        $data=$request->validated();

        $province=Province::find($data['province_id'])->name;
        $mun_one=MunOne::find($data['l1_id'])->name;
        $mun_two=MunTwo::find($data['l2_id'])->name??false;
        $name=Name::find($data['name_id'])->name;

        $source_name=$mun_two?"$province\\$mun_one\\$mun_two\\$name":"$province\\$mun_one\\$name";
        $result=Source::firstOrCreate([
            'name'=>$source_name,
            'topic_name'=>$data['topic_name'],
            'header_name'=>$data['header_name']
        ]);

        unset($data['topic_name'],$data['header_name']);

        $data['source_id']=$result['id'];
        $data['l2_id']=$data['l2_id']??0;

        $rules=SourceRules::firstOrCreate($data);
        return $rules;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SourceRules $source)
    {
        return new SourceResource($source);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SourceRequest $request, $id)
    {
        $data=$request->validated();
        $source=Source::find($id);
        $rules=SourceRules::find($id);
        $province=Province::find($data['province_id'])->name;
        $mun_one=MunOne::find($data['l1_id'])->name;
        $mun_two=MunTwo::find($data['l2_id'])->name??0;

        $name=Name::find($data['name_id'])->name;
        $source_name=$mun_two?"$province\\$mun_one\\$mun_two\\$name":"$province\\$mun_one\\$name";

        $result=$source->update([
            'name'=>$source_name,
            'topic_name'=>$data['topic_name'],
            'header_name'=>$data['header_name']
        ]);

        unset($data['topic_name'],$data['header_name']);
        $data['source_id']=$id;
        $data['l2_id']=$data['l2_id']??0;

        $result=$rules->update($data);
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $source=Source::find($id);
        $source_rules=SourceRules::find($id);
        $source_rules->delete();
        $source->delete();
    }
}
