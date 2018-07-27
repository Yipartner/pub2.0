<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class ArticleService
{
    // 创建文章
    public function create($data)
    {

        DB::table('articles')
            ->insert($data);
    }

    // 改变文章的发布状态
    public function changeStatus($article_id, $status)
    {
        DB::table('articles')
            ->where('id', $article_id)
            ->update([
                'status' => $status
            ]);
    }

    /**
     * 删除文章
     * @param $article_id
     * @return bool delete result
     */
    public function delete($article_id)
    {
        $num = DB::table('articles')
            ->where('id', $article_id)
            ->delete();
        return $num == 1;
    }

    // 编辑文章
    public function edit($article_id, $data)
    {

        DB::table('articles')
            ->where('id', $article_id)
            ->update($data);
    }

    public function searchByTitle(string $title){
        $articles = DB::table('articles')
            ->where('title','like','%'.$title.'%')
            ->paginate(config('article.page_size'));
        return $articles;
    }

    public function searchByType($type_id){
        $articles =DB::table('articles')
            ->where('type_id',$type_id)
            ->paginate(config('article.page_size'));
        return $articles;
    }

    public function searchByTag($tag_id){
        $articles = DB::table('article_tag_relations')
            ->where('tag_id','=',$tag_id)
            ->join('articles','article_id','=','articles.id')
            ->select('articles.*')
            ->paginate(config('article.page_size'));
        return $articles;
    }

    // TODO 根据文章内容搜索
    // TODO 分享
    // TODO 下载

}