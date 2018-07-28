@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                @if(json_decode(json_encode($articles))->data!=[])
                    @foreach($articles as $article)
                        {{--<img class="visible-lg" src="http://p39smi668.bkt.clouddn.com/404.jpg" style="float: left;margin: 0.7%;margin-right: 10px" width="26%">--}}
                        <div class="panel panel-default">

                            <div class="panel-heading" >
                                <h4 onclick="window.location.href='{{url('/article/content/'.$article->id)}}'">
                                    <a style="cursor: pointer;">{{$article->title}}</a>
                                </h4>
                            </div>
                            <div class="panel-collapse" style="margin:2%;">
                                &ensp;&ensp;&ensp; {{$article->content}}
                            </div>
                            <div class="panel-footer">
                                @if($article->tags)
                                    @foreach($article->tags as $tag)
                                        <button class="btn-sm" style="background-color: {{$tag['color']}}"
                                                onclick="window.location.href='{{url('/article/tag/'.$tag['tag_id'])}}'">
                                            <span style="font-weight:500;color: white">{{$tag['name']}}</span>
                                        </button>
                                    @endforeach
                                @else
                                    <button class="btn" disabled="true">暂无标签</button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    {{$articles->links('vendor.pagination.bootstrap-4')}}
                @else
                    <div style="text-align: center; margin-top: 30px">
                        <img src="http://p39smi668.bkt.clouddn.com/404%E5%BD%A9.png" width="50%" alt="">
                        <h3>小伙伴还没有该分类的文章</h3>
                        <h3>你可以去看看其他类别下的文章~~</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
