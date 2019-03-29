@extends('layouts.layout')
@section('content')

    <div class="container">
        <div class="main-post-area-wrapper main-post-area-layout-one">
            <div class="main-post-area-inner">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="main-post-area-holder">
                            @foreach($articles as $article)
                                <article class="post-details-holder wow  fadeInUp">
                                    <div class="post-image">
                                        @if(stristr($article->image,'http')==TRUE)
                                            <iframe width="560" height="315" src="{{$article->image}}" frameborder="0"
                                                    gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                                        @else
                                            <img src="{{$article->image}}" alt="....">
                                        @endif
                                    </div>
                                    <!-- // post image -->
                                    <div class="post-title">
                                        <h2>{{$article->title}}</h2>
                                    </div>
                                    <!-- // post-title -->
                                    <div class="post-the-content clearfix layout-one-first-letter" style="word-wrap:break-word">

                                    <?php
                                        $txt = preg_replace ('/<img.*>/Uis', '', $article->text);
                                        $txt = preg_replace('/\s{2,}/', '', $txt);
                                        $txt = mb_strimwidth($txt,0,300,'...')
                                    ?> <!---  обрезаем колво символов для превью статей на главной --->

                                        <p>{!!$txt!!}</p>
                                    </div>
                                    <!-- // post-the-content -->
                                    <div class="post-permalink">
                                        <a href="/article/{{$article->id}}">Читать далее</a>
                                    </div>
                                    <!-- // post-permalink -->
                                    <div class="post-meta-and-share">
                                        <div class="row">
                                            <?php
                                                $articleUser = \Models\User::find($article->user_id);
                                            ?>
                                            @if (isset($articleUser))
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                    <div class="post-author">
                                                        <span class="post-author"><a>{{$articleUser->username}}</a></span>
                                                    </div>
                                                </div>
                                            @endif
                                            <!-- // col 4 -->
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="post-share">
                                                    <?php
                                                    $textt =  strip_tags($article->text);
                                                    ?>
                                                    <div class="ya-share2" async="async" data-url="http://светланачечина.рус/article/{{$article->id}}"
                                                         data-title="{{$article->title}}" data-description="{{$textt}}" data-image="{{$article->image}}"
                                                         data-services="vkontakte,odnoklassniki,gplus,whatsapp,telegram"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <div class="post-comment-count">
                                                    <span class="post-comment-count"><a>{{(new DateTime($article->created_at))->format('d-m-Y')}} </a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                        @endforeach
                        </div>
                    </div>

                    <!--СайдБар-->
                    @include('layouts.rigthColumn')


                <!--Пагинация-->
                <div class="pagination_holder">
                    <ul class="pagination">
                        {{--{{$articles->links()}}--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection