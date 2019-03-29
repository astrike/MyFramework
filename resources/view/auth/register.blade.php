@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Регистрация</div>

                <div class="card-body">
                    <form method="POST" action="register" enctype="multipart/form-data">
                        {{--@csrf--}}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Имя</label>

                            <div class="col-md-6">
                                {{--<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>--}}
                                {{--<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}
                                <input id="name" type="text" class="form-control" name="username" value="" required autofocus>

                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="invalid-feedback">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail адрес</label>

                            <div class="col-md-6">
                                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>--}}
                                <input id="email" type="email" class="form-control" name="email" required>

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="invalid-feedback">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                            <div class="col-md-6">
                                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}
                                <input id="password" type="password" class="form-control" name="password" required>

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="invalid-feedback">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Повторить пароль</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                       <!-- <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Аватарка</label>
                            <div class="col-md-6">
                                <input id="email" type="file" class="form-control" name="foto" style="border: #0b2e13 ">
                            </div>
                        </div>
                        -->

                        {{--<div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }} row">--}}
                        <div class="form-group row">

                            <label for="foto" class="col-md-4 col-form-label text-md-right">Аватарка</label>
                            <div class="col-md-6">
                                <input id="foto" type="file" class="form-control" name="foto" style="border: #0b2e13 ">
                            </div>
                        </div>

                        {{--@if ($errors->has('foto'))--}}
                            {{--<span class="help-block">--}}
                                {{--<strong>{{ $errors->first('foto') }}</strong>--}}
                            {{--</span>--}}
                        {{--@endif--}}

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Регистрация
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection