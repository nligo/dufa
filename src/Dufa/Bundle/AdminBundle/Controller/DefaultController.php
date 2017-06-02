<?php

namespace Dufa\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DufaAdminBundle:Default:index.html.twig');
    }
}
