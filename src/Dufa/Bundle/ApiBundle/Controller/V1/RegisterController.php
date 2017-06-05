<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="用户注册",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         420 = "System error.",
     *     },
     *     views={"all","user"},
     *     parameters={
     *      {"name"="username", "dataType"="string", "required"=true, "description"="用户名"},
     *      {"name"="phone", "dataType"="string", "required"=true, "description"="手机号"},
     *      {"name"="vail_code", "dataType"="string", "required"=true, "description"="验证码"},
     *      {"name"="password", "dataType"="string", "required"=true, "description"="密码"},
     *  },
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function userRegAction(Request $request)
    {
        $result = [];

        return $this->JsonResponse();
    }

    /**
     * @ApiDoc(
     *     description="企业注册",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         420 = "System error.",
     *     },
     *     views={"all","user"},
     *     parameters={
     *      {"name"="username", "dataType"="string", "required"=true, "description"="用户名"},
     *      {"name"="password", "dataType"="string", "required"=true, "description"="密码"},
     *  },
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function companyRegAction(Request $request)
    {
        $result = [];

        return $this->JsonResponse();
    }

    /**
     * @ApiDoc(
     *     description="企业认证",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         420 = "System error.",
     *     },
     *     views={"all","user"},
     *     parameters={
     *      {"name"="contents", "dataType"="string", "required"=true, "description"="认证内容"},
     *      {"name"="business_license", "dataType"="string", "required"=true, "description"="营业执照"},
     *      {"name"="brand", "dataType"="string", "required"=true, "description"="商标"},
     *      {"name"="patent", "dataType"="string", "required"=true, "description"="专利"},
     *  },
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function companyApproveAction($id,Request $request)
    {
        $result = [];

        return $this->JsonResponse();
    }
}
