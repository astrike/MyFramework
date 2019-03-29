<header class="general-header header-layout-one">
    <div class="general-header-inner" >
        <div class="header-top-wrapper">
            <div class="header-top-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="search">
                                <form action="/search" method="post">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <input id="search" type="search" name="srch" placeholder="Поиск ..........">
                                    <input type="submit" id="submit" style="display: none">
                                </form>

                            </div>
                        </div>
                        <!-- // col -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="social-networks">
                                <ul class="social-links" style="font-size: 16px">

                                    @if ($auth->isLoggedIn())
                                            @if ($auth->hasRole(\Delight\Auth\Role::ADMIN))
                                                <a style="margin-right: 35px" href="/admin">{{$auth->getUsername()}}</a>
                                                <a style="margin-right: 35px" href="/logout">Выйти</a>
                                            @else
                                                <a style="margin-right: 35px">{{$auth->getUsername()}}</a>
                                                <a style="margin-right: 35px" href="/logout">Выйти</a>
                                            @endif
                                        @else
                                            <a style="margin-right: 35px" href="/login">Войти на сайт</a>
                                        @endif
                                            <script src="//ulogin.ru/js/ulogin.js"></script>
                                            <a id="uLogin" data-ulogin="display=panel;theme=classic;fields=first_name,last_name,email,photo_big,city,photo;
                                            providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;redirect_uri={{'http://'. $_SERVER['HTTP_HOST']}}/ulogin;
                                            mobilebuttons=0;"></a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="site-info">
                <h1 class="site-title">Svetlana Chechina Blog</h1>
            </div>
        </div>
        <nav class="main-nav layout-one">
            <div id="main-nav" class="stellarnav" >
                <ul>
                    <li><a style="font-size: 15px" href="/">Главная</a></li>

                    <li><a style="font-size: 15px" href="/about">Обо мне</a></li>

                    <li><a style="font-size: 15px" href="/articleCatalog">Каталог статей</a>
                        <ul>
                            <li><a style="font-size: 15px">По категориям</a>
                                <ul>
                                    <?php
                                    $categoriesAll = \Models\Category::all();
                                    ?>
                                    @foreach($categoriesAll as $cat)
                                        <li><a href="/articleCatalog/category/{{$cat->id}}">{{$cat->name}}</a></li>
                                    @endforeach

                                </ul>
                            </li>
                            <li><a style="font-size: 15px" href="/articleCatalog">Все статьи</a></li>
                            </li>
                        </ul>
                    </li>
                    <li><a style="font-size: 15px" href="/contacts">Обратная связь</a></li>

                    @if ($auth->isLoggedIn() and $auth->hasRole(\Delight\Auth\Role::ADMIN))
                        <li><a style="font-size: 15px" href="/articleCreate">Добавить статью</a></li>
                    @else
                        <li><a style="font-size: 15px" href="">Предложить статью</a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>
