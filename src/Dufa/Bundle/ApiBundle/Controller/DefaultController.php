<?php

namespace Dufa\Bundle\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DufaApiBundle:Default:index.html.twig');
    }
}
