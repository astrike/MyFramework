<?php

namespace Controllers;

use Models\About;
use Models\AboutMe;
use Models\Article;
use Models\Social;
use SDK\Classes\Request;
use SDK\Facades\Image;

class AdminController
{
    /**
     * Внесение изменений в информацию "Обо мне".
     * @param Request $request
     * @return redirect
     */
    public function aboutMeEditPost(Request $request) {
        $aboutMe = AboutMe::find(1);
        if (isset($request->foto)){
            $imageTempPath = getTempFilePathFromRequest($request, 'foto');
            $randomString = rand(1000, 9999);
            $imageNewPath = ROOT . '/public/storage/users/'. $randomString . getFullFileNameFromRequestImage($request);

            Image::make($imageTempPath)->resize(780,480)->save($imageNewPath);
            $pathImageForMySql = '/storage/users/' . $randomString . getFullFileNameFromRequestImage($request);

            $aboutMe->update([
                'foto'=>$pathImageForMySql,
                'name'=>$request->name,
                'title'=>$request->title,
                'text'=>$request->text,
            ]);
        }
        else{
            $aboutMe->update([
                'name'=>$request->name,
                'title'=>$request->title,
                'text'=>$request->text,
            ]);
        }
        return redirect('/admin/aboutMeEdit');
    }

    /**
     * Внесение изменений в информацию о социальных сетях.
     * @param Request $request
     * @return redirect
     */
    public function socialEditPost(Request $request) {
        $social = Social::find(1);
        $social->update([
            'ok'=>$request->ok,
            'vk'=>$request->vk,
            'inst'=>$request->inst,
            'utub'=>$request->utub,
        ]);
        return redirect('/admin/aboutMeEdit');
    }

    /**
     * Вывод страницы с каталогом статей.
     * @return \SDK\Classes\ViewObject
     */
    public function articlesCatalog() {
        $articles = Article::orderBy('created_at','DESC');//->paginate(30);
        return view('admin.articleCatalogAdmin', ['articles'=>$articles]);
    }

    /**
     * Вывод страницы с редактированием информациеи "Обо мне".
     * @return \SDK\Classes\ViewObject
     */
    public function aboutMePageEdit() {
        $aboutMe = About::find(1);
        return view('editor.aboutMePageEdit',['aboutMe'=>$aboutMe]);
    }

    /**
     * Вывод страницы "Обо мне".
     * @param Request $request
     * @return redirect
     */
    public function aboutMePagePost(Request $request) {
        $about = About::find(1);
        $about->update([
            'text'=>$request->text,
        ]);
        return redirect('/about');
    }

    /**
     * Вывод админской страницы
     * @return \SDK\Classes\ViewObject
     */
    public function adminPanel() {
        return view('admin.index');
    }
}