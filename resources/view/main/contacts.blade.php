@extends('layouts.layout')
@section('content')
<div class="general-single-page-layout single-page-layout-one">
    <div class="breadcrumb-wrapper">
        <div class="breadcrumb" style="padding: 20px; margin-bottom: 0px; background:url({{asset('images')}}/banner/fon.jpg)">
            <ul class="breadcrumb-listing">
                <li><a href="/">Главная</a></li>
                <li><a>Обратная связь</a></li>
            </ul>
            <div class="mask"></div>
        </div>
    </div>

    <div style="margin-top: 50px">
        <script  type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A81561f71bdda6d9fd4c148f2b6c3a05e94e8584a83bf1821d75906f9ec1d284b&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
    </div>

    <div class="single-page-wrapper">
        <div class="single-page-inner">
            <div class="container">
                <div class="row">
                    <section id="contact-page" style="margin-top: 40px">
                        <div class="container">
                            <div class="center" style="text-align: center;padding: 30px">
                                <h2>Задать мне вопрос</h2>
                            </div>
                            <div class="row contact-wrap">
                                <div class="status alert alert-success" style="display: none"></div>
                                <div class="col-md-6 col-md-offset-3">
                                    {{--<div>--}}
                                        {{--@if(isset($done))--}}
                                            {{--<h3>Ваше сообщение отправлено</h3>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                    {{--@if (count($errors) > 0)--}}
                                        {{--<div class="alert alert-danger">--}}
                                            {{--<ul>--}}
                                                {{--@foreach ($errors->all() as $error)--}}
                                                    {{--<li>{{ $error }}</li>--}}
                                                {{--@endforeach--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                    {{--@endif--}}

                                    <form action="/send" method="post" role="form" >
                                        {{--{{csrf_field()}}--}}
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Ваше имя" />
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Ваш Email" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Тема" />
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="text" rows="5"> </textarea>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="submit" class="btn btn-primary btn-lg">Отправить сообщение</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection