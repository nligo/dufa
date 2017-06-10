<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;

use Dufa\Bundle\CoreBundle\Entity\User;
use Dufa\Bundle\CoreBundle\Entity\UserOperateRecord;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class UserRecordController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="个人中心-用户交易记录",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         420 = "System error.",
     *     },
     *     views={"all","user-center"},
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function tradingAction(Request $request)
    {
        $test1= new User();
        $test1->setNickname('sdfdf')->setEmail("sdfds")->setUsername("sdfds")->setPassword("sdfd")->setSalt("sdf");
        $test = new UserOperateRecord();
        $test->setContents("sdfsdf");
        $test->setUser($test1);
        $test->setOperateType($this->getParameter("user_operate_record_type")['comment']);
        $this->getDoctrine()->getManager()->persist($test1);
        $this->getDoctrine()->getManager()->persist($test);
        $this->getDoctrine()->getManager()->flush();
        $result = [];
        return $this->JsonResponse();
    }

    /**
     * @ApiDoc(
     *     description="个人中心-奖励记录",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         420 = "System error.",
     *     },
     *     views={"all","user-center"},
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function rewardAction(Request $request)
    {
        $result = [];
        return $this->JsonResponse();
    }

    /**
     * @ApiDoc(
     *     description="个人中心-评论记录",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         420 = "System error.",
     *     },
     *     views={"all","user-center"},
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function commentdAction(Request $request)
    {
        $result = [];
        return $this->JsonResponse();
    }

    /**
     * @ApiDoc(
     *     description="个人中心-纠错记录",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         420 = "System error.",
     *     },
     *     views={"all","user-center"},
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function errorCorrectionAction(Request $request)
    {
        $result = [];
        return $this->JsonResponse();
    }

    /**
     * @ApiDoc(
     *     description="个人中心-举报记录",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         420 = "System error.",
     *     },
     *     views={"all","user-center"},
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function informAction(Request $request)
    {
        $result = [];
        return $this->JsonResponse();
    }


}
