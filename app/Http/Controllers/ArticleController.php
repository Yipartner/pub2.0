<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ArticleController extends Controller
{
    //

    private $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function createNewArticle(Request $request)
    {
        $user = $request->user();
        $article = [];
        $rule = [
            'title',
            'content' ,
            'type_id',
            'picture_id' ,
            'status',
        ];
        foreach ($rule as $item){
            $article[$item]=$request->input($item,"未填写");
        }
        $article['user_id']=$user->id;
        $article['created_at']=Carbon::now();
        $article_id=$this->articleService->create($article);
        return redirect('/article/'.$article_id);
    }

    public function editArticle(Request $request){
        $article = [];
        $rule = [
            'id',
            'title',
            'content' ,
            'type_id',
            'picture_id',
            'status',
        ];
        foreach ($rule as $item){
            $article[$item]=$request->input($item,"未填写");
        }
        $this->articleService->edit($article['id'],$article);
        return redirect('/article/'.$article['id']);
    }

    public function showArticlesByType($typeId,Request $request){
        $articles=$this->articleService->searchByType($typeId,$request->user()->id??-1);
        return view('home',[
            'articles'=>$articles
        ]);
    }
    public function showArticlesByTag($tagId,Request $request){
        $articles=$this->articleService->searchByTag($tagId,$request->user()->id??-1);
        return view('home',[
            'articles'=>$articles
        ]);
    }
    
}
