<footer class="general-footer" style="background-image:url(/images/footerLogo.jpg); margin-top: 50px" >
<div class="footer-mask"></div>
    <div class="footer-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 footer-block">
                    <div class="">
                        <div class="footer-widget-content about-widget">

                            <div class="widget-title">
                                <h2>Обо мне</h2>
                            </div>

                            <div class="widget-about-site-logo">
                                <span>Svetlana Chechina Blog</span>
                            </div>

                            <div class="widget-content">
                                <?php
                                    $aboutMeFooter = \Models\AboutMe::find(1);
                                ?>
                                <p>{{$aboutMeFooter->title}}</p>
                            </div>

                            <div class="social-networks">
                                <ul class="social-links">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 footer-block">
                    <div class="">
                        <div class="footer-widget-content">

                            <div class="widget-title">
                                <h2>Navigation</h2>
                            </div>

                            <div class="widget-content">
                                <ul class="widget-category-listings">

                                    <li><a href="/">Главная</a></li>
                                    <li><a href="/about">Обо мне</a></li>
                                    <li><a href="/articleCatalog">Каталог статей</a></li>
                                    <li><a href="/gallery">Галерея</a></li>
                                    <li><a href="/files">Файлы</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 footer-block">
                    <div class="footArt">
                        <div class="footer-widget-content">
                            <div class="widget-title">
                                <h2>Популярные посты</h2>
                            </div>

                            <?php
                            $popArticlesFooter = \Models\Article::all();//->sortByDesc('views');
                            $i=1;
                            ?>
                            @foreach($popArticlesFooter as $popArticle)
                                @if($i<=4)
                                    <?php $i++?>
                                        <div class="widget-content">
                                            <div class="widget-posts">
                                                <div class="post-title">
                                                    <h5><a href="/article/{{$popArticle->id}}">{{$popArticle->title}}</a></h5>
                                                </div>
                                                <div class="posted-date">
                                                    <span><a href="/article/{{$popArticle->id}}">{{ is_object($popArticle->created_at) ? $popArticle->created_at->format('d  F  Y  в  H:i') : ''}}</a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-and-nav-row">
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="copyrights">
                            <p>Все права защищены @ 2018 by Сафонов Дмитрий</p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <ul class="footer-navigation">
                            <li><a href="/">Главная</a></li>
                            <li><a href="/about">Обо мне</a></li>
                            <li><a href="/articleCatalog">Каталог статей</a></li>
                            <li><a href="/gallery">Галерея</a></li>
                            <li><a href="/files">Файлы</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
