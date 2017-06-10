<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class ResettingController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="重置密码",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","user"},
     *     parameters={
     *      {"name"="phone", "dataType"="string", "required"=true, "description"="手机号"},
     *      {"name"="password", "dataType"="string", "required"=true, "description"="密码"},
     *      {"name"="code", "dataType"="string", "required"=true, "description"="验证码"},
     *  },
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function resetAction(Request $request)
    {
        $param['phone'] = $request->request->get('phone');
        $param['password'] = $request->request->get('password');
        $param['code'] = $request->request->get('code');
        if ($this->checkParam($param) == false) {
            return $this->JsonResponse($param, -1, 'parameter error.');
        }


        return $this->JsonResponse(array(), 0);
    }

}