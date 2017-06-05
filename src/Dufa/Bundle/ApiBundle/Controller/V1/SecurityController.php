<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="用户登录",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         420 = "System error.",
     *     },
     *     views={"all","user"},
     *     parameters={
     *      {"name"="_username", "dataType"="string", "required"=true, "description"="用户名"},
     *      {"name"="_password", "dataType"="string", "required"=true, "description"="密码"},
     *  },
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function loginAction(Request $request)
    {
        $result = [];

        return $this->JsonResponse();
    }

    /**
     * @ApiDoc(
     *     description="用户退出",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         420 = "System error.",
     *     },
     *     views={"all","news"},
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function logoutAction()
    {
        $result = [];
        return $this->JsonResponse();
    }
}
