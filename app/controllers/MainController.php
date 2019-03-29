<?php

namespace Controllers;

use Models\About;
use Models\Article;

class MainController
{
    /**
     * Главная страница
     * @return \SDK\Classes\ViewObject
     */
    public function index() {
        $articles = Article::All()->reverse();
        return view('main.index',['articles' => $articles]);
    }

    /**
     * Страница обо мне
     * @return \SDK\Classes\ViewObject
     */
    public function about() {
        $aboutMe = About::find(1);
        return view('main.about', ['aboutMe' => $aboutMe]);
    }

    /**
     * Страница с контактами
     * @return \SDK\Classes\ViewObject
     */
    public function contacts() {
        return view('main.contacts');
    }
}