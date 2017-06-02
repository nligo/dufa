<?php

namespace Dufa\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DufaCoreBundle:Default:index.html.twig');
    }
}
