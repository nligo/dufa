<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;

use Dufa\Bundle\CoreBundle\Entity\Dictionay;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class DictionayController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="百科列表",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     parameters={
     *      {"name"="searchParam[yourfileds_like]", "dataType"="array", "required"=true, "description"="搜索参数"},
     *      {"name"="start", "dataType"="integer", "required"=false, "description"="start 默认为0"},
     *      {"name"="limit", "dataType"="integer", "required"=false, "description"="limit 默认为100"},
     *  },
     *     views={"all","dictionay","master"},
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function listAction(Request $request)
    {
        $condition = $request->query->get('searchParam',[]);
        $start = $request->query->getInt('start',0);
        $limit = $request->query->get('limit',100);
        $list = $this->em()->getRepository("DufaCoreBundle:Dictionay")->getDataBy($condition,$start,$limit);
        $count = $this->em()->getRepository("DufaCoreBundle:Dictionay")->getCount($condition);
        $result = [
            'total' => $count['total'],
            'list' => $list,
        ];
        return $this->JsonResponse($result);
    }

    /**
     * @ApiDoc(
     *     description="行业百科 添加",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","dictionay"},
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="用户token"},
     *      {"name"="title", "dataType"="string", "required"=true, "description"="词条名称"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="描述"},
     *      {"name"="cnName", "dataType"="string", "required"=false, "description"="中文标题"},
     *      {"name"="enName", "dataType"="string", "required"=false, "description"="英文标题"},
     *      {"name"="mean", "dataType"="string", "required"=false, "description"="释义"},
     *      {"name"="effect", "dataType"="string", "required"=false, "description"="作用"},
     *      {"name"="secondTitle", "dataType"="string", "required"=true, "description"="二级标题"},
     *      {"name"="contents", "dataType"="string", "required"=true, "description"="内容"},
     *  },
     *     views={"all","dictionay","master"},
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function newAction(Request $request)
    {
        $checkUser = $this->checkUserToken();
        if(is_string($checkUser))
        {
            return $this->Response($checkUser);
        }
        $param['title'] = $request->request->get("title");
        $param['secondTitle'] = $request->request->get("secondTitle");
        $param['contents'] = $request->request->get("contents");
        $param['description'] = $request->request->get("description");
        $param['cnName'] = $request->request->get("cnName");
        $param['enName'] = $request->request->get("enName");
        $param['mean'] = $request->request->get("mean");
        $param['effect'] = $request->request->get("effect");
        if($this->checkParam($param) == false)
        {
            return $this->JsonResponse($param,-1);
        }
        $dictonay = new Dictionay();
        $dictonay->setUser($checkUser);
        foreach ($param as $k => $v) {
            $setMethod = 'set'.ucfirst($k);
            $dictonay->$setMethod($v);
        }
        $this->em()->persist($dictonay);
        $this->em()->flush();
        return $this->JsonResponse($dictonay);
    }

    /**
     * @ApiDoc(
     *     description="行业百科 编辑",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","dictionay"},
     *     parameters={
     *      {"name"="title", "dataType"="string", "required"=false, "description"="词条名称"},
     *      {"name"="description", "dataType"="string", "required"=false, "description"="描述"},
     *      {"name"="cnName", "dataType"="string", "required"=false, "description"="中文标题"},
     *      {"name"="enName", "dataType"="string", "required"=false, "description"="英文标题"},
     *      {"name"="mean", "dataType"="string", "required"=false, "description"="释义"},
     *      {"name"="effect", "dataType"="string", "required"=false, "description"="作用"},
     *      {"name"="secondTitle", "dataType"="string", "required"=false, "description"="二级标题"},
     *      {"name"="contents", "dataType"="string", "required"=false, "description"="内容"},
     *  },
     *     views={"all","dictionay","master"},
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function editAction($id,Request $request)
    {
        $checkUser = $this->checkUserToken();
        if(is_string($checkUser))
        {
            return $this->Response($checkUser);
        }
        $dictonay = $this->em()->getRepository("DufaCoreBundle:Dictionay")->find($id);

        if(empty($dictonay))
        {
            return $this->JsonResponse([],-1);
        }
        $param['title'] = $request->request->get("title");
        $param['secondTitle'] = $request->request->get("secondTitle");
        $param['contents'] = $request->request->get("contents");
        $param['description'] = $request->request->get("description");
        $param['cnName'] = $request->request->get("cnName");
        $param['enName'] = $request->request->get("enName");
        $param['mean'] = $request->request->get("mean");
        $param['effect'] = $request->request->get("effect");
        $dictonay->setUser($checkUser);
        foreach ($param as $k => $v) {
            $setMethod = 'set'.ucfirst($k);
            $dictonay->$setMethod($v);
        }
        $this->em()->persist($dictonay);
        $this->em()->flush();
        return $this->JsonResponse($dictonay);
    }

    /**
     * @ApiDoc(
     *     description="百科详情",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","dictionay","master"},
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function detailsAction($id)
    {
        $info = $this->em()->getRepository("DufaCoreBundle:Dictionay")->find($id);

        $result = [
            'info' => $info,
            'comments' => [],
        ];
        return $this->JsonResponse($result);
    }

    /**
     * @ApiDoc(
     *     description="作者信息",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","dictionay","user"},
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function authorInfoAction($id)
    {
        $checkUser = $this->checkUserToken();
        if(is_string($checkUser))
        {
            return $this->Response($checkUser);
        }
        $result = [];
        return $this->JsonResponse();
    }

    /**
     * @ApiDoc(
     *     description="行业百科 搜索",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *
     *     views={"all","dictionay","search","master"},
     *     parameters={
     *      {"name"="searchParam[title_like]", "dataType"="string", "required"=false, "description"="搜索标题"},
     *      {"name"="start", "dataType"="integer", "required"=false, "description"="start 默认为0"},
     *      {"name"="limit", "dataType"="integer", "required"=false, "description"="limit 默认为100"},
     *  },
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function searchAction(Request $request)
    {
        $condition = $request->query->get('searchParam',[]);
        $start = $request->query->getInt('start',0);
        $limit = $request->query->get('limit',100);
        $list = $this->em()->getRepository("DufaCoreBundle:Dictionay")->getDataBy($condition,$start,$limit);
        $count = $this->em()->getRepository("DufaCoreBundle:Dictionay")->getCount($condition);
        $result = [
            'total' => $count['total'],
            'list' => $list,
        ];
        return $this->JsonResponse($result);
    }


    /**
     * @ApiDoc(
     *     description="行业百科 热搜推荐",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","dictionay","search"},
     *     parameters={
     *      {"name"="start", "dataType"="integer", "required"=false, "description"="start 默认为0"},
     *      {"name"="limit", "dataType"="integer", "required"=false, "description"="limit 10"},
     *  },
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function hotSearchAction(Request $request)
    {
        $limit = $request->query->get('limit',10);
        $list = $this->em()->getRepository("DufaCoreBundle:Dictionay")->findBy([],['viewNum' => 'DESC'],$limit);
        return $this->JsonResponse($list);
    }
}
