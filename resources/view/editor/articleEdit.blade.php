@extends('layouts.layout')

@section('styles')
    <link href="{{asset('modules/toggle/css')}}/style.css" rel="stylesheet">

    <script src="/modules/ckeditor/ckeditor.js"></script>
    <style type="text/css">
        .fld {
            background: whitesmoke;
            border-radius: 3px;
            padding: 10px;
            max-width: max-content;

        }

        .fld2 {
            background: whitesmoke;
            border-radius: 3px;
            padding: 15px;
            max-width: max-content;
            height: 82px;
            margin-bottom: 15px;
            margin-top: 15px;
        }

    </style>
@endsection

@section('content')
    <div class="general-single-page-layout single-page-layout-one" style="margin-bottom: 100px">
        <div class="single-page-wrapper">
            <div class="single-page-inner">
                <div class="container">
                    <div class="row">
                        <p><h3 id="ca">Создание статьи<br/></h3></p>

                        {{--<!------- Список ошибок формы ------->--}}
                        {{--@if (count($errors) > 0)--}}
                            {{--<div class="alert alert-danger">--}}
                                {{--<strong>Упс! Что-то пошло не так!</strong>--}}
                                {{--<br><br>--}}
                                {{--<ul>--}}
                                    {{--@foreach ($errors->all() as $error)--}}
                                        {{--<li>{{ $error }}</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        <form id="form" class="blocks" action="/articleEdit" method="post" enctype="multipart/form-data">
{{--                            {{ csrf_field() }}--}}
                            <div class="fld">
                                <p>
                                    <label >Заголовок:</label>
                                    <input type="text" class="text" name="title" value="{{$article->title}}" />
                                </p>
                                <p>
                                    <label >Категория:</label>
                                    <select class="sel" name="category_id" size="1">\
                                        <?php
                                            $i=0;
                                            $articleCategory = \Models\Category::find($article->category_id);
                                        ?>
                                                <option selected value='{{$articleCategory->id}}'>{{$articleCategory->name}}</option>
                                        @foreach($categories as $cat)
                                            @if($cat != $articleCategory)
                                                <option value='{{$cat->id}}'>{{$cat->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </p>
                            </div>
                            <br/>
                            <p class="area">
                                <textarea class="text" name="text" id="text" rows="10" cols="80">{{$article->text}}</textarea>
                            </p>
                            <script>
                                CKEDITOR.replace('text')
                            </script>

                            <p>
                                Тип заголовка(фото/видео)
                            </p>
                            <p style="margin-top: 10px">
                                <label class="switch switch_type1" role="switch" >
                                    <input type="checkbox" class="switch__toggle" name="checkType" id="checkType">
                                    <span class="switch__label"></span>
                                </label>
                            </p>
                            <div class="fld2" id="fld1" >
                                <p>
                                    <label id="lp">Фото для заголовка:</label>
                                    <input id="img" type="file"  name="image">
                                </p>
                            </div>
                            <div class="fld2" id="fld2" style="display: none">
                                <p>
                                    <label id="lp">Видео для заголовка:</label>
                                <p>
                                    <input id="img2" type="text"  name="video">
                                </p>
                                </p>
                            </div>
                            <input type="hidden" name = "user_id" value="{{$auth->getUserId()}}" />
                            <input type="hidden" name = "article_id" value="{{$article->id}}" />
                            <p>
                                <label>&nbsp;</label>
                                <input type="submit" class="btn" value="Опубликовать" />
                            </p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/modules/ckeditor/ckeditor.js"></script>

    <script>

        jQuery(function($){


            $("#checkType").click(function () {
                if (document.getElementById('checkType').checked) {
                    document.getElementById('fld2').style.display = 'block';
                    document.getElementById('fld1').style.display = 'none';
                }
                else {document.getElementById('fld1').style.display = 'block';
                    document.getElementById('fld2').style.display = 'none';
                }
            })

        });
    </script>
@endsection