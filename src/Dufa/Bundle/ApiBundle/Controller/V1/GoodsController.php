<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;

use Dufa\Bundle\CoreBundle\Entity\Banner;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class GoodsController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="商品列表",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","goods","shopping","master"},
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
        $list = $this->get('dufa_core_manager.goods')->getGoodsList($condition,$start,$limit);
        return $this->JsonResponse($list);
    }

    /**
     * @ApiDoc(
     *     description="商品列表-详情",
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
     *          "description"="商品Id"
     *      }
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
        $info = $this->get('dufa_core_manager.goods')->getRepository()->find($id);
        return $this->JsonResponse($info);
    }
}
