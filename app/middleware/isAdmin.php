<?php

namespace Middleware;

class isAdmin
{

    /**
     * Посредник проверяет авторизован админ или нет.
     * @return bool|redirect
     */
    public function handler() {
        global $auth;
        if ($auth->hasRole(\Delight\Auth\Role::ADMIN)) {
            return true;
        } else {
            return redirect('/');
        }
    }
}