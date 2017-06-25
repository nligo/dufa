<?php

namespace Dufa\Bundle\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    public function indexAction()
    {
        return $this->render('DufaWebBundle:Default:index.html.twig');
    }
}
