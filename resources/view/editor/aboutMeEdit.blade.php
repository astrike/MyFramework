@extends('layouts.layout')
@section('content')

    <div class="container">
        <div class="main-post-area-wrapper main-post-area-layout-one">
            <div class="main-post-area-inner">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="main-post-area-holder">
                                <!--Редактирование Информации Обо мне-->
                                <?php
                                    $oldValue = \Models\AboutMe::find(1);
                                ?>
                                <form action="/admin/aboutMeEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <h3>Редактирование информации о себе</h3>
                                    <p><br></p><p><br></p>

                                    <p><label for="foto">Измените Фото</label></p>
                                    <input type="file" name="foto" >
                                    <p><br></p>

                                    <p><label for="name">Измените имя</label></p>
                                    <input type="text" name="name" value="{{$oldValue->name}}">
                                    <p><br></p>

                                    <p><label for="title">Измените описание</label></p>
                                    <input type="text" name="title" value="{{$oldValue->title}}">
                                    <p><br></p>

                                    <p><label for="text">Измените текст</label></p>
                                    <textarea name="text" cols="70" rows="5">{{$oldValue->text}}</textarea>
                                    <p><br></p>

                                    <p><input type="submit" name="submit" value="Подтвердить"></p>

                                </form>

                            <!--Редактирование информации о соц сетях-->
                                <?php
                                    $oldSocial = \Models\Social::find(1);
                                ?>
                                <form action="/admin/socialEdit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <p><br></p><p><br></p>
                                    <h3>Редактирование информации о соцсетях</h3>
                                    <p><br></p><p><br></p>

                                    <p><label for="ok">Ссылка на одноклассники</label></p>
                                    <input type="text" name="ok" value="{{$oldSocial->ok}}" style="width: 350px">
                                    <p><br></p>

                                    <p><label for="vk">Ссылка на ВКонтакте</label></p>
                                    <input type="text" name="vk" value="{{$oldSocial->vk}}" style="width: 350px">
                                    <p><br></p>

                                    <p><label for="inst">Ссылка на Инстаграмм</label></p>
                                    <input type="text" name="inst" value="{{$oldSocial->inst}}" style="width: 350px">
                                    <p><br></p>

                                    <p><label for="utub">Ссылка на Ютуб</label></p>
                                    <input type="text" name="utub" value="{{$oldSocial->utub}}" style="width: 350px">
                                    <p><br></p>



                                    <p><input type="submit" name="submit" value="Подтвердить"></p>

                                </form>


                            </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <aside class="sidebar">
                            <div class="sidebar-inner">

                            @include('layouts.aboutMe')
                            </div>
                        </aside>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection