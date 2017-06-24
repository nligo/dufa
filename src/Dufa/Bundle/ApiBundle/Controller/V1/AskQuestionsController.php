<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;


use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Dufa\Bundle\CoreBundle\Entity\AskQuestions;
use Dufa\Bundle\CoreBundle\Entity\Base;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Response;

class AskQuestionsController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="顾问-我的问题列表",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","questions","master"},
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="userToken"},
     *  },
     *     tags={
     *         "完成" = "green",
     *     }
     *  )
     */
    public function listAction(Request $request)
    {
        $checkUser = $this->checkUserToken();
        if(is_string($checkUser))
        {
            return new Response($checkUser);
        }
        $list = $this->em()->getRepository("DufaCoreBundle:AskQuestions")->findBy(['status' => Base::STATUS_ACTIVE],['createdAt' => "DESC"]);
        return $this->JsonResponse($list);
    }

    /**
     * @ApiDoc(
     *     description="顾问-新增问题",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","questions","master"},
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="userToken"},
     *      {"name"="title", "dataType"="string", "required"=true, "description"="标题"},
     *      {"name"="contents", "dataType"="string", "required"=true, "description"="u内容"},
     *      {"name"="rewards", "dataType"="string", "required"=true, "description"="售价"},
     *      {"name"="imgUrl", "dataType"="string", "required"=true, "description"="图片地址"},
     *  },
     *     tags={
     *         "完成" = "green",
     *     }
     *  )
     */
    public function addAction(Request $request)
    {
        $checkUser = $this->checkUserToken();
        if(is_string($checkUser))
        {
            return new Response($checkUser);
        }
        $param['title'] = $request->request->get("title",'');
        $param['contents'] = $request->request->get("contents",'');
        $param['rewards'] = $request->request->get("rewards",0.00);
        $param['imgUrl'] = $request->request->get("imgUrl",'');
        if ($this->checkParam($param) == false) {
            return $this->JsonResponse($param, -1, 'parameter error.');
        }
        $param['user'] = $this->getUser();

        $askQuestion = $this->get('dufa_core_manager.ask_questions')->create($param);
        return $this->JsonResponse($askQuestion);
    }

    /**
     * @ApiDoc(
     *     description="顾问-编辑问题",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","questions","master"},
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="问题Id"
     *      }
     *  },
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="userToken"},
     *      {"name"="title", "dataType"="string", "required"=true, "description"="标题"},
     *      {"name"="contents", "dataType"="string", "required"=true, "description"="u内容"},
     *      {"name"="rewards", "dataType"="string", "required"=true, "description"="售价"},
     *      {"name"="imgUrl", "dataType"="string", "required"=true, "description"="图片地址"},
     *  },
     *     tags={
     *         "完成" = "green",
     *     }
     *  )
     */
    public function editAction($id,Request $request)
    {
        $checkUser = $this->checkUserToken();
        if(is_string($checkUser))
        {
            return new Response($checkUser);
        }
        $param['title'] = $request->request->get("title",'');
        $param['contents'] = $request->request->get("contents",'');
        $param['rewards'] = $request->request->get("rewards",0.00);
        $param['imgUrl'] = $request->request->get("imgUrl",'');
        $param['user'] = $this->getUser();
        $askQuestion = $this->get('dufa_core_manager.ask_questions')->update($id,$param);
        return $this->JsonResponse($askQuestion);
    }

    /**
     * @ApiDoc(
     *     description="顾问-编辑问题",
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
     *          "description"="问题Id"
     *      }
     *  },
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="userToken"},
     *  },
     *     views={"all","questions","master"},
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
            return new Response($checkUser);
        }
        $obj = $this->get("dufa_core_manager.ask_questions")->getRepository()->find($id);
        $answer = $this->getDoctrine()->getRepository("DufaCoreBundle:AskQuestionsAnswer")->findBy(['aqId' => $obj->getId(),'status' => Base::STATUS_ACTIVE]);
        $data = [
            'quesition' => $obj,
            'answer' => $answer
        ];
        return $this->JsonResponse($data);
    }
}