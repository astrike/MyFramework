<div class="span3" id="sidebar">
    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
        <li class="active">
            <a href="/"><i class="icon-chevron-right"></i> На главную</a>
        </li>
        <li>
            <a href="/articleCreate"><i class="icon-chevron-right"></i> Создать статью</a>
        </li>
        <li>
            <a href="/admin/aboutMePageEdit"><i class="icon-chevron-right"></i>Обо мне Страница Редактировать</a>
        </li>
        <li>
            <a href="/admin/aboutMePageEdit"><i class="icon-chevron-right"></i> Обо мне информация редактировать</a>
        </li>
        <li>
            <a href="/admin/articles"><span class="badge badge-success pull-right">{{count(\Models\Article::all()) - 2}}</span> Список статей</a>
        </li>
    </ul>
</div>