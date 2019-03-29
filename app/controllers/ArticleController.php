<?php

namespace Controllers;

use Models\Article;
use Models\Category;
use SDK\Classes\Request;
use SDK\Facades\Image;

class ArticleController
{
    /**
     * Отображение выбранной статьи.
     * @param integer $id
     * @return \SDK\Classes\ViewObject
     */
    public function articleView ($id) {
        $articleV = Article::find($id);
        $articleViews = $articleV->views;
        $articlesAll = Article::all();
        $articles = Article::find($id);
        $id = $articles->id;

        return view('article.articleView',['articles'=>$articles,'id'=>$id, 'articlesAll'=>$articlesAll,'articleViews'=>$articleViews]);
    }

    /**
     * Отображение страницы каталога всех статей.
     * @return \SDK\Classes\ViewObject
     */
    public function articleFullCatalog () {
        $articles = Article::orderBy('created_at','DESC');//->paginate(30);
        $title = "Каталог статей";
        return view('article.articleCatalog', ['articles'=>$articles,'title'=>$title]);
    }

    /**
     * Отображение страницы с найдеными статьями.
     * @param integer $id
     * @return \SDK\Classes\ViewObject
     */
    public function findCategory ($id) {
        $articles = (Article::orderBy('created_at','DESC'))->where('category_id',$id);//->paginate(30);

        $category = Category::find($id);
        $category = $category->name;
        $title = "Статьи с категорией $category";
        return view('article.articleCatalog', ['articles'=>$articles,'title'=>$title]);
    }

    /**
     * Поиск со заданной фразе.
     * @param Request $request
     * @return \SDK\Classes\ViewObject
     */
    public function search (Request $request) {
        $articles1 = Article::findLike("%$request->srch%", 'title','articles');//->paginate(30);
        $articles2 = Article::findLike("%$request->srch%", 'text','articles');

        $articles1 = object_to_array($articles1);
        $articles2 = object_to_array($articles2);

        //если данные поиска собраны не из одной статьи то соединяем массивы поиска
        if ($articles1 != $articles2) {
            $articles = array_merge($articles1, $articles2);
        } else {
            $articles = $articles1;
        }

        $articles = array_to_collectionObject($articles);

        if ($articles){
            $title = "Поиск по фразе: $request->srch";
        }else{
            $title = "По фразе: \"$request->srch\" ничего не найдено ";
        }
        return view('article.articleCatalog',['articles' => $articles,'title' => $title]);
    }

    /**
     * Отображение страницы редактора статьи.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\SDK\Classes\ViewObject
     */
    public function create(){
        $categories = Category::all();
        return view('editor.articleCreate',['categories'=>$categories]);
    }

    /**
     * Запись статьи в базу.
     * @param Request $request
     * @return redirect
     */
    public function createPost(Request $request){
        if (isset($request->checkType)){
            if ($request->video != '') {
                $path = $this->_makeUrlVideo($request->video);
                $path = $path . '?rel=0&amp;showinfo=0';
            }else{
                $path = '';
            }
            Article::create([
                'user_id'     => $request->user_id,
                'title'       => $request->title,
                'category_id' => $request->category_id,
                'text'        => $request->text,
                'image'       => $path,
            ]);
        }else {
            $imageTempPath = getTempFilePathFromRequest($request);
            $randomString = rand(1000, 9999);
            $imageNewPath = ROOT . '/public/storage/uploads/'. $randomString . getFullFileNameFromRequestImage($request);
            Image::make($imageTempPath)->resize(780,480)->save($imageNewPath);

            $pathImageForMySql = '/storage/uploads/' . $randomString . getFullFileNameFromRequestImage($request);
            Article::create([
                'user_id'     => $request->user_id,
                'title'       => $request->title,
                'category_id' => $request->category_id,
                'text'        => $request->text,
                'image'       => $pathImageForMySql,
            ]);
        }
        return redirect('/');
    }

    /**
     * Удаление нужной статьи.
     * @param integer $id
     * @return \SDK\Classes\ViewObject
     */
    public function delete($id){
        Article::destroy($id);
        $articles = article::orderBy('created_at','DESC');//->paginate(30);
        return view('admin.articleCatalogAdmin', ['articles'=>$articles]);
    }

    /**
     * Отображение страницы редактора статей.
     * @param integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\SDK\Classes\ViewObject
     */
    public function edit($id){
        $article =  Article::find($id);
        $categories = Category::all();
        return view('editor.articleEdit',['article'=>$article,'categories'=>$categories]);
    }

    /**
     * Сохранение статьи в базу.
     * @param Request $request
     * @return redirect
     */
    public function editPost(Request $request) {
        $article = Article::find($request->article_id);
        if (isset($request->checkType)) {

            if ($request->video != '') {
                $path = $this->_makeUrlVideo($request->video);
                $path = $path . '?rel=0&amp;showinfo=0';

            } else {
                $path = '';
            }
            $article->update([
                'user_id'     => $request->user_id,
                'title'       => $request->title,
                'category_id' => $request->category_id,
                'text'        => $request->text,
                'image'       => $path,
            ]);
        } else {
            if (isset($request->image)) {
                $imageTempPath = getTempFilePathFromRequest($request);
                $randomString = rand(1000, 9999);
                $imageNewPath = ROOT . '/public/storage/uploads/'. $randomString . getFullFileNameFromRequestImage($request);

                Image::make($imageTempPath)->resize(780,480)->save($imageNewPath);
                $pathImageForMySql = '/storage/uploads/' . $randomString . getFullFileNameFromRequestImage($request);

                $article->update([
                    'user_id'     => $request->user_id,
                    'title'       => $request->title,
                    'category_id' => $request->category_id,
                    'text'        => $request->text,
                    'image'       => $pathImageForMySql,
                ]);
            } else {
                $article->update([
                    'user_id'     => $request->user_id,
                    'title'       => $request->title,
                    'category_id' => $request->category_id,
                    'text'        => $request->text,
                ]);
            }
        }
        return redirect('/admin/articles');
    }

    /**
     * Вспомогательный метод подготавливающий URL нужного видео.
     * @param string $str
     * @return bool|string
     */
    private function _makeUrlVideo($str) {
        $mass = explode(" ", $str);
        foreach ($mass as $m){
            if(stristr($m, 'src="') == TRUE) {
                $str = stristr($m,"\"");
                $str = substr($str,1);
                $str = stristr($str,"\"",true);
                return $str;
            }
        }
    }
}