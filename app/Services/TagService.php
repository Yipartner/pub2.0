<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class TagService
{

    public function create($data)
    {
        DB::table('tags')->insert($data);
    }

    public function edit($tag_id, $tag_info)
    {
        DB::table('tags')
            ->where('id', $tag_id)
            ->update($tag_info);
    }

    public function delete($tag_id)
    {
        DB::transaction(function () use ($tag_id) {
            DB::table('tags')
                ->where('id', $tag_id)
                ->delete();
            DB::table('article_tag_relations')
                ->where('tag_id', $tag_id)
                ->delete();
        });
    }
    public function getTagByNotSureName($name){
        $tag = DB::table('tags')
            ->where('name','like','%'.$name.'%')
            ->orWhere('name','=',$name)
            ->get();
        return $tag;
    }
    public function showTagList(){
        $tags=DB::table('tags');
        return $tags;
    }
}