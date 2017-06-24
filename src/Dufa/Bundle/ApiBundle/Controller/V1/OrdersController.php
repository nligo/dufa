<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;

use Dufa\Bundle\CoreBundle\Entity\Banner;
use Dufa\Bundle\CoreBundle\Entity\Orders;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="商城管理-订单管理",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","orders","shopping","master"},
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="userToken"},
     *      {"name"="start", "dataType"="integer", "required"=true, "description"="start"},
     *      {"name"="limit", "dataType"="integer", "required"=true, "description"="limit"},
     *  },
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function listAction(Request $request)
    {
        $checkUser = $this->checkUserToken();
        if(is_string($checkUser))
        {
            return $this->Response($checkUser);
        }
        $condition = [];
        $start = $request->request->getInt("start",0);
        $limit = $request->request->getInt("limit",100);
        $list = $this->get('dufa_core_manager.orders')->getOrdersList($condition,$start,$limit);
        return $this->JsonResponse($list);
    }

    /**
     * @ApiDoc(
     *     description="商城管理-订单管理-详情",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="订单Id"
     *      }
     *  },
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="userToken"},
     *  },
     *     views={"all","goods","shopping","master"},
     *     tags={
     *         "完成" = "green",
     *     }
     *  )
     */
    public function detailsAction($id,Request $request)
    {
        $checkUser = $this->checkUserToken();
        if(is_string($checkUser))
        {
            return $this->Response($checkUser);
        }
        $info = $this->get('dufa_core_manager.orders')->getRepository()->find($id);
        return $this->JsonResponse($info);
    }

    /**
     * @ApiDoc(
     *     description="商城管理-订单管理-创建订单",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "参数错误.",
     *         -3 = "数据不存在.",
     *         1 = "系统错误.",
     *     },
     *  requirements={
     *      {
     *          "name"="goodsId",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="goodsId"
     *      },
     *      {
     *          "name"="addressId",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="addressId"
     *      }
     *  },
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="userToken"},
     *  },
     *     views={"all","goods","shopping","master"},
     *     tags={
     *         "完成" = "green",
     *     }
     *  )
     */
    public function createOrderAction($goodsId,$addressId,Request $request)
    {
        $checkUser = $this->checkUserToken();
        if(is_string($checkUser))
        {
            return $this->Response($checkUser);
        }
        $addressIdInfo = $this->get('dufa_core_manager.useraddress')->getRepository()->find($addressId);
        if(is_null($addressIdInfo))
        {
            return $this->JsonResponse([],-3);
        }
        $goodsId = $this->get('dufa_core_manager.goods')->getRepository()->find($goodsId);
        if(is_null($goodsId))
        {
            return $this->JsonResponse([],-3);
        }
        $obj = $this->get('dufa_core_manager.orders')->createOrder($this->getUser(),$goodsId,$addressId);
        return $this->JsonResponse($obj);
    }
}
