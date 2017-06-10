<?php

namespace Dufa\Bundle\WebBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('DufaWebBundle:Backend:layout.html.twig', array(
        ));
    }
    public function welcomeAction()
    {
        return $this->render('DufaWebBundle:Backend:welcome.html.twig', array(
        ));
    }
}
