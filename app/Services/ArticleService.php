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

    // TODO 分享
    // TODO 下载

}