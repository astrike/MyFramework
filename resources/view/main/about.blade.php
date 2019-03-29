@extends('layouts.layout')
@section('content')
    <div class="general-single-page-layout single-page-layout-one">
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb" style="padding: 20px; margin-bottom: 0px; background:url(images/banner/fon.jpg)">
                <ul class="breadcrumb-listing">
                    <li><a href="/">Главная</a></li>
                    <li><a>Обо мне</a></li>
                </ul>
                <div class="mask"></div>
            </div>
        </div>
        <div class="single-page-wrapper">
            <div class="single-page-inner">
                <div class="container">
                    <div class="row">
                        <Div style="text-align: center">
                            {!! $aboutMe->text !!}
                        </Div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection