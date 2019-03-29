@extends('admin.layout')

@section('content')
<div class="span9" id="content">
    <div class="row-fluid">
        <!-- block -->
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Каталог статей</div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Название статьи</th>
                            <th>Текст </th>
                            <th>Время создания</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $articles = \Models\Article::all(); $n = 0;?>
                        @foreach($articles as $article)
                            <tr>
                                <td>{{$n++}}</td>
                                <td><a href="/article/{{$article->id}}">{{$article->title}}</a></td>
                                <td>{{mb_strimwidth(strip_tags($article->text), 0, 40)}}</td>
                                <td>{{$article->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /block -->
    </div>

    <div class="row-fluid">
        <!-- block -->
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Список пользователей</div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Имя пользователя</th>
                            <th>Email</th>
                            <th>Avatar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $users =\Models\User::all(); $n = 0;?>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$n++}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->avatar}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /block -->
    </div>

    <div class="row-fluid">
        <!-- block -->
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Мои социальные сети</div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Аккаунт инстаграмма</th>
                            <th>Аккаунт ВКонтакте</th>
                            <th>Аккаунт Одноклассники</th>
                            <th>Аккаунт Ютуб</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $social =\Models\Social::all(); $n = 0;?>
                        @foreach($social as $soc)
                            <tr>
                                <td>{{$soc->inst}}</td>
                                <td>{{$soc->vk}}</td>
                                <td>{{$soc->ok}}</td>
                                <td>{{$soc->utub}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /block -->
    </div>

</div>
@endsection