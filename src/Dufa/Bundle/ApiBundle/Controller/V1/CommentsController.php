<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;


use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Dufa\Bundle\CoreBundle\Entity\Comments;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Response;

class CommentsController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="评论--获得评论类型",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","comments"},
     *     tags={
     *         "完成" = "green",
     *     }
     *  )
     */
    public function getCommentTypeAction(Request $request)
    {
        $result = $this->getParameter("comment_type");
        return $this->JsonResponse($result);
    }

    /**
     * @ApiDoc(
     *     description="评论",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","comments"},
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="userToken"},
     *      {"name"="type", "dataType"="string", "required"=true, "description"="从getCommentType 中获得的参数传递过来。"},
     *      {"name"="contents", "dataType"="string", "required"=true, "description"="内容"},
     *      {"name"="id", "dataType"="string", "required"=true, "description"="根据type 来区别是百科id 创意id 问题id"},
     *  },
     *     tags={
     *         "完成" = "green",
     *     }
     *  )
     */
    public function commentAction(Request $request)
    {
        $contents = $request->request->get('contents','');
        $type = $request->request->get('type','default');
        $id = $request->request->getInt('id',0);
        $userToken = $request->request->get('userToken','');
        $user = $this->getUser();
        $result = $this->get("dufa_core_service.comment")->comment($type,$user,$id,$contents);
        if($result)
        {
            return $this->JsonResponse($result);
        }
        return $this->JsonResponse([],1);
    }
}