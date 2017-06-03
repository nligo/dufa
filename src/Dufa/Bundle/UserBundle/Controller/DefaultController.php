<?php

namespace Dufa\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DufaUserBundle:Default:index.html.twig');
    }
}
