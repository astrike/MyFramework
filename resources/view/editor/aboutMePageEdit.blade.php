@extends('layouts.layout')

@section('styles')
    <script src="/modules/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <div class="general-single-page-layout single-page-layout-one" style="margin-bottom: 100px">
        <div class="single-page-wrapper">
            <div class="single-page-inner">
                <div class="container">
                    <div class="row">
                        <p><h3 id="ca">Редактировать информацию о себе<br/></h3></p>

                        <!------- Список ошибок формы ------->
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

                        <form id="form" class="blocks" action="/admin/aboutMePageEdit" method="post" enctype="multipart/form-data">
                            {{--{{ csrf_field() }}--}}
                            <div class="fld">
                                <br/>
                                <p class="area">
                                    <textarea class="text" name="text" id="text" rows="10" cols="80">{{$aboutMe->text}}</textarea>
                                    <script>
                                        CKEDITOR.replace('text')
                                    </script>
                                </p>
                                <p>
                                    <input type="submit" class="btn" value="Готово" />
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/modules/ckeditor/ckeditor.js"></script>
@endsection