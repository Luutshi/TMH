<?php

namespace Mvc\Controllers;

use Config\Controller;


class PageController extends Controller
{
    public function base()
    {
        echo $this->twig->render('Page/home.html.twig');
    }

    public function house()
    {
        echo $this->twig->render('Page/house.html.twig');
    }
    public function information()
    {
        echo $this->twig->render('Page/information.html.twig');
    }
}