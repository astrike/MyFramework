@extends('layouts.layout')

@section('styles')
    <style type="text/css">
        .articleCatalog {
            font-size: 14px;
            background: whitesmoke;
            border-radius: 1px;
            padding: 10px;
            width: max-content;
            margin-top: 10px;
        }
        .articleTime{
            font-size: 11px;
            margin-left: 50px;
        }



    </style>
@endsection

@section('content')
    <div class="general-single-page-layout single-page-layout-one">
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb" style="padding: 20px; margin-bottom: 0px; background:url({{asset('images')}}/banner/fon.jpg)">
                <ul class="breadcrumb-listing">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Lifestyle</a></li>
                    <li><a href="#">Post</a></li>
                </ul>
                <div class="mask"></div>
            </div>
        </div>
        <div class="single-page-wrapper">
            <div class="single-page-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <div class="main-post-area-holder">
                                <h4 style="margin:50px ">Список статей</h4>

                                @foreach($articles as $article)
                                    <div class="articleCatalog">
                                        <?php
                                        $cat = \Models\Category::find($article->category_id);
                                        $cat = $cat->name;
                                        $us = \Models\User::find($article->user_id);
                                        if(isset($us)){
                                            $user = $us->username;
                                            $ava =$us->avatar;
                                        }
                                        ?>
                                        @if(isset($ava))
                                            <p>
                                                <img src="{{$ava}}" alt="...." style="max-height: 35px; max-width: 35px; margin-right: 35px">
                                                <a href="/article/{{$article->id}}">{{$article->title}} - #{{$cat}}</a>
                                                <a type="button" style="margin-left: 10px; padding: 4px" href="/article/delete/{{$article->id}}" onClick="return confirm('Вы подтверждаете удаление?');">Удалить</a>
                                                <a type="button" style="margin-left: 10px; padding: 4px" href="/articleEdit/{{$article->id}}" >Редактировать</a>
                                            </p>
                                        @else
                                            <p>
                                                <a style="margin-left: 70px" href="/article/{{$article->id}}">{{$article->title}} - #{{$cat}}</a>
                                                <a type="button" style="margin-left: 10px; padding: 4px" href="/article/delete/{{$article->id}}" onClick="return confirm('Вы подтверждаете удаление?');">Удалить</a>
                                                <a type="button" style="margin-left: 10px; padding: 4px" href="/articleEdit/{{$article->id}}">Редактировать</a>
                                            </p>
                                        @endif
                                        <?php unset($ava)?>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    @include('layouts.rigthColumn')
                    <!--Пагинация-->
                        {{--<div class="pagination_holder">--}}
                            {{--<ul class="pagination">--}}
                                {{--{{$articles->links()}}--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection
