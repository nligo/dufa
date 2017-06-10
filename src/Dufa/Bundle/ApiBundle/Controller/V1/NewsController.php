<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;

use Dufa\Bundle\CoreBundle\Entity\Banner;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="资讯列表 传递栏目id为对应的资讯列表",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *  requirements={
     *      {
     *          "name"="cId",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="栏目Id"
     *      }
     *  },
     *     views={"all","news"},
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function listAction($cId,Request $request)
    {
        $result = [];
        return $this->JsonResponse();
    }

    /**
     * @ApiDoc(
     *     description="资讯详情",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         420 = "System error.",
     *     },
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="资讯Id"
     *      }
     *  },
     *     views={"all","news"},
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function detailsAction($id)
    {
        $result = [];
        return $this->JsonResponse();
    }
}
