<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;

use Dufa\Bundle\CoreBundle\Entity\Banner;
use Dufa\Bundle\CoreBundle\Entity\Experts;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class ExpertsController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="用户-人工服务",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","user","master"},
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
    public function serviceAction(Request $request)
    {
        $checkUser = $this->checkUserToken();
        if(is_string($checkUser))
        {
            return $this->Response($checkUser);
        }
        $condition = [];
        $start = $request->request->getInt("start",0);
        $limit = $request->request->getInt("limit",100);
        $list = $this->get('dufa_core_manager.experts')->getList(Experts::TYPE_SERVICE,$condition,$start,$limit);
        return $this->JsonResponse($list);
    }

    /**
     * @ApiDoc(
     *     description="用户-评委列表",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="userToken"},
     *      {"name"="start", "dataType"="integer", "required"=true, "description"="start"},
     *      {"name"="limit", "dataType"="integer", "required"=true, "description"="limit"},
     *  },
     *     views={"all","user","master"},
     *     tags={
     *         "完成" = "green",
     *     }
     *  )
     */
    public function judgesAction(Request $request)
    {
        $checkUser = $this->checkUserToken();
        if(is_string($checkUser))
        {
            return $this->Response($checkUser);
        }
        $condition = [];
        $start = $request->request->getInt("start",0);
        $limit = $request->request->getInt("limit",100);
        $list = $this->get('dufa_core_manager.experts')->getList(Experts::TYPE_JUDGES,$condition,$start,$limit);
        return $this->JsonResponse($list);

    }
}
