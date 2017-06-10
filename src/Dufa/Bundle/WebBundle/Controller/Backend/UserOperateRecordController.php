<?php

namespace Dufa\Bundle\WebBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserOperateRecordController extends Controller
{
    public function listAction(Request $request)
    {
        $param = $request->get('searchParam');
        $page = $request->query->get('page');
        $param = isset($param) ? $param : array();
        $param['page'] = isset($page) ? $page : 1;
        $list = $this->getDoctrine()->getManager()->getRepository("DufaCoreBundle:UserOperateRecord")->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $list,
            $request->query->getInt('page', $param['page'])
        );
        return $this->render('DufaWebBundle:Backend/UserOperateRecord:list.html.twig', array(
            'searchParam' => $param,
            'pagination' => $pagination,
        ));
    }
    public function welcomeAction()
    {
        return $this->render('DufaWebBundle:Backend:welcome.html.twig', array(
        ));
    }
}
