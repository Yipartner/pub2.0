<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class TagService{

    public function create($data){
        DB::table('tags')->insert($data);
    }

    public function edit($tag_id,$tag_info){
        DB::table('tags')
            ->where('id',$tag_id)
            ->update($tag_info);
    }

    public function delete($tag_id){
        DB::table();
    }
}