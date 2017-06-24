<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;


use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Dufa\Bundle\CoreBundle\Entity\AskQuestions;
use Dufa\Bundle\CoreBundle\Entity\AskQuestionsAnswer;
use Dufa\Bundle\CoreBundle\Entity\Base;
use Dufa\Bundle\CoreBundle\Entity\Comments;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Response;

class AskQuestionsAnswerController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="顾问-问题-回答问题",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","questions","master"},
     *  requirements={
     *      {
     *          "name"="aqId",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="aqId"
     *      }
     *  },
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="userToken"},
     *      {"name"="answer", "dataType"="string", "required"=true, "description"="答案"},
     *  },
     *     tags={
     *         "完成" = "green",
     *     }
     *  )
     */
    public function answerAction($aqId,Request $request)
    {
        $user = $this->checkUserToken();
        if(is_string($user))
        {
            return new Response($user);
        }
        $param['aqId'] = $aqId;
        $param['answer'] = $request->request->get("answer",'');
        if ($this->checkParam($param) == false) {
            return $this->JsonResponse($param, -1, 'parameter error.');
        }
        $aqInfo = $this->get("dufa_core_manager.ask_questions")->getRepository()->find($aqId);
        $answer = new AskQuestionsAnswer();
        $answer
            ->setUser($this->getUser())
            ->setAqId($aqInfo)
            ->setAnswer($param['answer']);
        $this->em()->persist($answer);
        $this->em()->flush($answer);
        return $this->JsonResponse($answer);
    }

    /**
     * @ApiDoc(
     *     description="顾问-问题-评论",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","questions","master"},
     *  requirements={
     *      {
     *          "name"="aqaId",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="aqaId"
     *      }
     *  },
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="userToken"},
     *      {"name"="contents", "dataType"="string", "required"=true, "description"="内容"},
     *  },
     *     tags={
     *         "完成" = "green",
     *     }
     *  )
     */
    public function commentAction($aqaId,Request $request)
    {
        $user = $this->checkUserToken();
        if(is_string($user))
        {
            return new Response($user);
        }
        $contents = $request->request->get("contents","");
        $aqaInfo = $this->getDoctrine()->getRepository("DufaCoreBundle:AskQuestionsAnswer")->find($aqaId);
        $comment = new Comments();
        $comment
            ->setUser($this->getUser())
            ->setContents($contents)
            ->setAqaId($aqaInfo)
            ->setAqId($aqaInfo->getAqId())
            ;
        $this->em()->persist($comment);
        $this->em()->flush($comment);
        return $this->JsonResponse($comment);
    }

    /**
     * @ApiDoc(
     *     description="顾问-问题-设置答案状态",
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
     *          "description"="答案Id"
     *      }
     *  },
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="userToken"},
     *      {"name"="type", "dataType"="integer", "required"=true, "description"="类型 1为采纳为最佳答案 2为采纳为一般答案 默认为2"},
     *  },
     *     views={"all","questions","master"},
     *     tags={
     *         "完成" = "green",
     *     }
     *  )
     */
    public function changeStatusAction($id,Request $request)
    {
        $obj = [];
        $user = $this->checkUserToken();
        if(is_string($user))
        {
            return new Response($user);
        }
        $type = $request->request->getInt('type',2);
        if($type == 1)
        {
            $obj = $this->get('dufa_core_service.adopt_anwer')->best($id);
        }
        if($type == 2)
        {
            $obj = $this->get('dufa_core_service.adopt_anwer')->general($id);
        }
        return $this->JsonResponse($obj);
    }
}