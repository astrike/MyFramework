@extends('layouts.layout')

@section('styles')
    <?php
    $textt =  strip_tags($articles->text);
    ?>
    <meta property="og:title" content="{{$articles->title}}"/>
    <meta property="og:description" content="{{$textt}}"/>
    <meta property="og:image" content="{{$articles->image}}"/>
    <meta property="og:url" content= "http://светланачечина.рус/article/{{$articles->id}}" />
    <meta name="title" content="{{$articles->title}}" />
    <meta name="description" content="{{$textt}}" />
    <link rel="image_src" href="http://светланачечина.рус/{{$articles->image}}" />

    <link href="{{asset('modules/lightbox')}}/jquery-lightbox.css" type="text/css" rel="stylesheet" />
@endsection

@section('content')
    <script type="text/javascript" src="{{asset('modules/lightbox')}}/scripts/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="{{asset('modules/lightbox')}}/scripts/jquery.lightbox.js"></script>



    <script>
        jQuery.noConflict();
        jQuery(function($){
            $('#artText img').css("height", "auto");
            $('#artText img').css("width", "auto");
        });
    </script>

    <script>
        if ( !(navigator.userAgent.indexOf('MSIE 6') >= 0) ){
            jQuery.noConflict();
            jQuery(function($){
                $("#artText a").lightbox();
                $.Lightbox.construct({
                    "speed": 500,
                    "show_linkback": true,
                    "keys": {
                        close:	"q",
                        prev:	"z",
                        next:	"x"
                    },
                    "opacity": 0.9,
                    text: {
                        image:		"Картинка",
                        of:			"из",
                        close:		"Закрыть",
                        closeInfo:	"Завершить просмотр можно, кликнув мышью вне картинки.",
                        help: {
                            close:		"",
                            interact:	"Интерактивная подсказка"
                        },
                        about: {
                            text: 	"",
                            title:	"",
                            link:	"/index.html"
                        }
                    }
                });
            });
        }
    </script>
    <div class="general-single-page-layout single-page-layout-one">
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb" style="padding: 20px; margin-bottom: 0px; background:url({{asset('images')}}/banner/fon.jpg)">
                <ul class="breadcrumb-listing">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/articleCatalog">Каталог статей</a></li>
                    <li><a>{{$articles->title}}</a></li>
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

                                <article class="single-page-details-holder wow fadeInUp">
                                    <div class="post-image">
                                        @if(stristr($articles->image,'http')==TRUE)
                                                <iframe max-width="800" width="100%" height="430" src="{{$articles->image}}" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                                            @else
                                                <img src="{{$articles->image}}" alt="....">
                                            @endif
                                    </div>
                                    <div class="single-page-other-information-holder">
                                        <div class="posted-category">
                                            <div class="post-meta-category">
                                                <?php $category = \Models\Category::find($articles->category_id);
                                                $category = $category->name;?>
                                                <span><a href="#">{{$category}}</a></span>
                                            </div>
                                        </div>
                                        <div class="post-title">
                                            <h2>{{$articles->title}}</h2>
                                        </div>
                                        <!-- // post-title -->
                                        <div class="post-extra-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="post-author">

                                                        <?php
                                                            $us = \Models\User::find($articles->user_id);
                                                            if(isset($us)){
                                                            $user = $us->username;
                                                            $ava =$us->avatar;
                                                            }
                                                        ?>

                                                        @if(isset($ava))
                                                            @if(strpos($ava,'users'))
                                                                <img src="{{$ava}}" alt="...." style="max-height: 50px; max-width: 50px">
                                                            @else
                                                                <img src="{{$ava}}" alt="...." style="max-height: 50px; max-width: 50px">
                                                            @endif
                                                            <span><a href="#">{{$user}}</a></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- // col -->
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="posted-date">
                                                        <span><a>{{(new DateTime($articles->created_at))->format('d  F  Y  в  H:i')}}</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="artText" class="post-the-content" style="word-wrap:break-word">
                                            <p>{!! $articles->text !!}</p>
                                        </div>
                                            <div class="post-share" style="text-align: center">
                                                <?php
                                                $textt =  strip_tags($articles->text);
                                                ?>
                                                <div class="ya-share2" data-url="http://светланачечина.рус/article/{{$articles->id}}" data-title="{{$articles->title}}" data-description="{{$textt}}" data-image="{{$articles->image}}" data-services="vkontakte,odnoklassniki,gplus,whatsapp,telegram"></div>
                                            </div>
                                        <div class="tags-meta-and-others clearfix">
                                            <div class="post-tags">
                                                <span><a href="#">{{$category}}</a></span>
                                            </div>
                                            <div class="view-count">
                                                <span class="display-view-count"><i class="fa fa-eye" aria-hidden="true"></i>{{$articleViews}} просмотра(ов)</span>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                                <div class="comment-area-wrapper">
                                    <div class="comment-area-inner">
                                        <div class="comments">
                                            <div class="comments__list">
                                                <div class="comment-listing-tile">
                                                    <h4>Блок комментариев</h4>
                                                </div>
                                                <div style="padding-bottom: 320px">
                                                    @include('comments.comments_block')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('layouts.rigthColumn')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection