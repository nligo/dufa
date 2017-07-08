<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;

use Dufa\Bundle\CoreBundle\Entity\Banner;
use Dufa\Bundle\CoreBundle\Entity\News;
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
     *          "dataType"="string",
     *          "description"="栏目Id"
     *      }
     *  },
     *     parameters={
     *      {"name"="searchParam[]", "dataType"="array", "required"=true, "description"="要搜索的参数"},
     *      {"name"="start", "dataType"="integer", "required"=false, "description"="start 默认为0"},
     *      {"name"="limit", "dataType"="integer", "required"=false, "description"="limit 默认为100"},
     *  },
     *     views={"all","news","master"},
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function listAction($cId = 0,Request $request)
    {
        $condition = $request->query->get('searchParam',[]);
        $start = $request->query->getInt('start',0);
        $limit = $request->query->get('limit',100);
        $list = $this->em()->getRepository("DufaCoreBundle:News")->getDataBy($cId,$condition,$start,$limit);
        $count = $this->em()->getRepository("DufaCoreBundle:News")->getCount($cId,$condition);
        $result = [
            'total' => $count['total'],
            'list' => $list,
        ];
        return $this->JsonResponse($result);
    }

    /**
     * @ApiDoc(
     *     description="资讯详情",
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
     *          "description"="资讯Id"
     *      }
     *  },
     *     views={"all","news","master"},
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function detailsAction($id)
    {
        $info = $this->em()->getRepository("DufaCoreBundle:News")->find($id);
        return $this->JsonResponse($info);
    }
}
