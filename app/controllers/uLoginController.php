<?php

namespace Controllers;

use Models\User;

class uLoginController
{
    /**
     * Модуль авторизации пользователя через социальные сети
     * @return redirect
     * @throws \Delight\Auth\AuthError
     * @throws \Delight\Auth\InvalidEmailException
     * @throws \Delight\Auth\InvalidPasswordException
     * @throws \Delight\Auth\TooManyRequestsException
     * @throws \Delight\Auth\UserAlreadyExistsException
     */
    public function login() {
        global $auth;
        // Get information about user.
        $data = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($data, TRUE);

        // Find user in DB.
        $userData = object_to_array(User::where('email', $user['email']));//->first();

        if (!($auth->isLoggedIn())){
            // Check exist user.
            if (isset($userData[0]['username'])) {

                try {
                    $auth->admin()->logInAsUserByEmail($user['email']);
                }
                catch (\Delight\Auth\InvalidEmailException $e) {
                    die('Unknown email address');
                }
                catch (\Delight\Auth\EmailNotVerifiedException $e) {
                    die('Email address not verified');
                }
                return redirect('/');
            } else {
                // Make registration new user.
                $password = 'Damascus13';//hash('md5', quickRandom(8));
                // Create new user in DB.
                $auth->register(
                    $user['email'],
                    $password,
                    $user['first_name'] . ' ' . $user['last_name'],
                );

                try {
                    $auth->admin()->logInAsUserByEmail($user['email']);
                }
                catch (\Delight\Auth\InvalidEmailException $e) {
                    die('Unknown email address');
                }
                catch (\Delight\Auth\EmailNotVerifiedException $e) {
                    die('Email address not verified');
                }
                return redirect('/');
            }
        }else return redirect('/');
    }
}