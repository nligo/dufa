<?php

namespace Dufa\Bundle\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DufaWebBundle:Default:index.html.twig');
    }
}
