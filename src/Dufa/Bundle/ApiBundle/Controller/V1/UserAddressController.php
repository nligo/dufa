<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class UserAddressController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="个人中心-地址管理",
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
    public function listAction(Request $request)
    {
        $result = [];
        return $this->JsonResponse();
    }

    /**
     * @ApiDoc(
     *     description="个人中心-新增地址",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         420 = "System error.",
     *     },
     *     views={"all","user-center"},
     *     parameters={
     *      {"name"="username", "dataType"="string", "required"=true, "description"="联系人"},
     *      {"name"="phone", "dataType"="string", "required"=true, "description"="电话"},
     *      {"name"="address", "dataType"="string", "required"=true, "description"="地址"},
     *  },
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function newAction(Request $request)
    {
        $result = [];
        return $this->JsonResponse();
    }

    /**
     * @ApiDoc(
     *     description="个人中心-编辑地址",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         420 = "System error.",
     *     },
     *     parameters={
     *      {"name"="username", "dataType"="string", "required"=true, "description"="联系人"},
     *      {"name"="phone", "dataType"="string", "required"=true, "description"="电话"},
     *      {"name"="address", "dataType"="string", "required"=true, "description"="地址"},
     *  },
     *     views={"all","user-center"},
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function editAction($id,Request $request)
    {
        $result = [];
        return $this->JsonResponse();
    }

    /**
     * @ApiDoc(
     *     description="个人中心-删除地址",
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
    public function deleteAction($id,Request $request)
    {
        $result = [];
        return $this->JsonResponse();
    }
}
