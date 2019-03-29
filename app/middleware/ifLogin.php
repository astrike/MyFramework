<?php

namespace Middleware;

class ifLogin
{
    /**
     * Посредник проверяет авторизован пользователь или нет.
     * @return bool|redirect
     */
    public function handler() {
        global $auth;
        if ($auth->isLoggedIn()) {
            return true;
        } else {
            return redirect('/');
        }
    }
}