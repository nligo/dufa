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
        $param = [
            'username' => $request->request->get("username"),
            'phone' => $request->request->get("phone"),
            'password' => $request->request->get("password"),
        ];
        if ($this->checkParam($param) == false) {
            return $this->JsonResponse($param, -1, 'parameter error.');
        }
        $user = $this->get('dufa_core_manager.user')->create($param);
        return $this->JsonResponse($user);
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
     *      {"name"="name", "dataType"="string", "required"=true, "description"="公司名称"},
     *      {"name"="address", "dataType"="string", "required"=true, "description"="公司地址"},
     *      {"name"="business", "dataType"="string", "required"=true, "description"="公司业务"},
     *      {"name"="compnyType", "dataType"="string", "required"=true, "description"="公司类型"},
     *      {"name"="area", "dataType"="string", "required"=true, "description"="公司位置"},
     *      {"name"="scale", "dataType"="string", "required"=true, "description"="公司规模"},
     *      {"name"="contact", "dataType"="string", "required"=true, "description"="联系人"},
     *      {"name"="contactType", "dataType"="string", "required"=true, "description"="联系人类型"},
     *  },
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function companyRegAction(Request $request)
    {
        $userParam = [
            'username' => $request->request->get('username'),
            'password' => $request->request->get('password'),
        ];
        $companyParam = [
            'name' => $request->request->get('name'),
            'address' => $request->request->get('address'),
            'business' => $request->request->get('business'),
            'compnyType' => $request->request->get('compnyType'),
            'area' => $request->request->get('area'),
            'scale' => $request->request->get('scale'),
            'contact' => $request->request->get('contact'),
            'contactType' => $request->request->get('contactType'),
        ];

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
     *      {"name"="contact", "dataType"="string", "required"=true, "description"="认证人"},
     *      {"name"="contactType", "dataType"="string", "required"=true, "description"="认证人类型"},
     *      {"name"="regContents", "dataType"="string", "required"=true, "description"="认证内容"},
     *      {"name"="license", "dataType"="string", "required"=true, "description"="营业执照"},
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

        $approveParam = [
            'contact' => $request->request->get('contact'),
            'contactType' => $request->request->get('contactType'),
            'regContents' => $request->request->get('regContents'),
            'license' => $request->request->get('license'),
            'brand' => $request->request->get('brand'),
            'patent' => $request->request->get('patent'),

        ];

        return $this->JsonResponse();
    }
}
