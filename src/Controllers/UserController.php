<?php

namespace Mvc\Controllers;

use Config\Controller;
use Mvc\Models\UserModel;

class UserController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        parent::__construct();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']))
        {
            $this->userModel->createUser($_POST['firstname'], $_POST['lastname'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT));

            header('Location: /login');
            exit;
        }

        echo $this->twig->render('User/register.html.twig');
    }

    public function login()
    {
        echo $this->twig->render('User/login.html.twig');
    }
}