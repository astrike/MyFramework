<?php

namespace Controllers;

use Delight\Auth\EmailNotVerifiedException;
use Delight\Auth\InvalidEmailException;
use Delight\Auth\InvalidPasswordException;
use Delight\Auth\TooManyRequestsException;

class AuthController
{
    /**
     * Логин в систему.
     * @return \SDK\Classes\ViewObject
     */
    public function login() {
        return view('auth.login');
    }

    /**
     * Логаут из системы.
     * @return redirect
     * @throws \Delight\Auth\AuthError
     */
    public function logout() {
        global $auth;
        $auth->logOut();
        return redirect('/');
    }

    /**
     * Регистрация нового пользователя.
     * \SDK\Classes\ViewObject
     */
    public function register() {
        return view('auth.register');
    }

    /**
     * Переадресация на главную после логина.
     * @return redirect
     * @throws \Delight\Auth\AttemptCancelledException
     * @throws \Delight\Auth\AuthError
     */
    public function postLogin() {
        global $auth;

        if (isset($_POST['remember'])) {
            $rememberDuration = (int) (60 * 60 * 24 * 365.25);
        }
        else {
            $rememberDuration = null;
        }

        try {
            $auth->login($_POST['email'], $_POST['password'], $rememberDuration);
            return redirect('/');
        }
        catch (InvalidEmailException $e) {
            die('Wrong email address');
        }
        catch (InvalidPasswordException $e) {
            die('Wrong password');
        }
        catch (EmailNotVerifiedException $e) {
            die('Email not verified');
        }
        catch (TooManyRequestsException $e) {
            die('Too many requests');
        }
    }

    /**
     * Переадресайия на главную после регистрации.
     * @return redirect
     * @throws \Delight\Auth\AuthError
     */
    public function postRegister() {
        global $auth;

        try {
            $userId = $auth->register($_POST['email'], $_POST['password'], $_POST['username']);
            return redirect('/');
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            die('Invalid email address');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Invalid password');
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            die('User already exists');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
    }
}