<?php

namespace app\controllers;

use paul_core\paul_core\Application;
use paul_core\paul_core\Controller;
use paul_core\paul_core\middlewares\AuthMiddleware;
use paul_core\paul_core\Request;
use paul_core\paul_core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile'])); //new AuthMiddleware(['profile'])
        //$this->registerMiddleware(new AuthMiddleware(['kackboon']));
    }

    public function login(Request $request, Response $response) {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login())  {
                 $response->redirect('/');
                 exit;
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' =>$loginForm
        ]);
    }
    public function register(Request $request)  {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
             //var_dump($user);
            if($user->validate() && $user->save())    {
                // header('Location: /'); /*das ist die einfache lösung*/

                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/');
                exit;
            }

            return $this->render("register",[
                'model' => $user
            ]);
        }
        return $this->render("register",[
            'model' => $user
        ]);
        $this->setLayout('auth');
        return $this->render('register');
    }
    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }
    public function profile()
    {

        return $this->render('profile');
    }
    public function kackboon()
    {
        return $this->render('profile');
    }
}