<?php

namespace Dufa\Bundle\WebBundle\Controller\Backend;


use Dufa\Bundle\CoreBundle\Entity\Goods;
use Dufa\Bundle\WebBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class GoodsController extends BaseController
{

    public function listAction(Request $request)
    {
        $param = $request->get('searchParam');
        $page = $request->query->get('page');
        $param = isset($param) ? $param : array();
        $param['page'] = isset($page) ? $page : 1;
        $list = $this->getDoctrine()->getManager()->getRepository("DufaCoreBundle:Goods")->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $list,
            $request->query->getInt('page', $param['page'])
        );
        return $this->render('DufaWebBundle:Backend/Goods:list.html.twig', array(
            'searchParam' => $param,
            'pagination' => $pagination,
        ));
    }

    public function newAction(Request $request)
    {

    }

    public function editAction(Goods $goods,Request $request)
    {

    }

    public function delAction(Goods $goods,Request $request)
    {

    }

}
