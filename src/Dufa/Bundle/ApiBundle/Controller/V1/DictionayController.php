<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;

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
     *      {"name"="searchParam[title]", "dataType"="string", "required"=true, "description"="百科名称"},
     *      {"name"="start", "dataType"="integer", "required"=false, "description"="start 默认为0"},
     *      {"name"="limit", "dataType"="integer", "required"=false, "description"="limit 默认为100"},
     *  },
     *     views={"all","dictionay"},
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function listAction(Request $request)
    {
        $result = [];
        return $this->JsonResponse();
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
     *      {"name"="title", "dataType"="string", "required"=true, "description"="词条名称"},
     *      {"name"="description", "dataType"="string", "required"=true, "description"="描述"},
     *      {"name"="cnName", "dataType"="string", "required"=false, "description"="中文标题"},
     *      {"name"="enName", "dataType"="string", "required"=false, "description"="英文标题"},
     *      {"name"="mean", "dataType"="string", "required"=false, "description"="释义"},
     *      {"name"="effect", "dataType"="string", "required"=false, "description"="作用"},
     *      {"name"="secondTitle", "dataType"="string", "required"=true, "description"="二级标题"},
     *      {"name"="contents", "dataType"="string", "required"=true, "description"="内容"},
     *  },
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function newAction(Request $request)
    {
        $param['title'] = $request->request->get("title");
        $param['secondTitle'] = $request->request->get("secondTitle");
        $param['contents'] = $request->request->get("contents");
        $param['description'] = $request->request->get("description");
        $param['cnName'] = $request->request->get("cnName");
        $param['enName'] = $request->request->get("enName");
        $param['mean'] = $request->request->get("mean");
        $param['effect'] = $request->request->get("effect");
        return $this->JsonResponse();
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
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function editAction($id,Request $request)
    {
        $param['title'] = $request->request->get("title");
        $param['secondTitle'] = $request->request->get("secondTitle");
        $param['contents'] = $request->request->get("contents");
        $param['description'] = $request->request->get("description");
        $param['cnName'] = $request->request->get("cnName");
        $param['enName'] = $request->request->get("enName");
        $param['mean'] = $request->request->get("mean");
        $param['effect'] = $request->request->get("effect");
        return $this->JsonResponse();
    }

    /**
     * @ApiDoc(
     *     description="百科详情",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","dictionay"},
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
     *     views={"all","dictionay","search"},
     *     parameters={
     *      {"name"="keyword", "dataType"="string", "required"=false, "description"="关键字"},
     *      {"name"="start", "dataType"="integer", "required"=false, "description"="start 默认为0"},
     *      {"name"="limit", "dataType"="integer", "required"=false, "description"="limit 默认为100"},
     *  },
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function searchAction(Request $request)
    {
        $result = [];
        return $this->JsonResponse();
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
     *      {"name"="limit", "dataType"="integer", "required"=false, "description"="limit 默认为100"},
     *  },
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function hotSearchAction(Request $request)
    {
        $result = [];
        return $this->JsonResponse();
    }
}
