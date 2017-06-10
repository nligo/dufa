<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;

use Dufa\Bundle\CoreBundle\Entity\Base;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class UserAddressController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="个人中心-地址管理",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","user-center","user","goods","shopping"},
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="userToken"},
     *  },
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function listAction(Request $request)
    {
        $user = $this->getUser();
        $userId = $user->getId();
        $list = $this->get("dufa_core_manager.useraddress")->getRepository()->findBy(['user' => $userId,'status' => Base::STATUS_ACTIVE],['createdAt' => 'desc']);
        return $this->JsonResponse($list);
    }

    /**
     * @ApiDoc(
     *     description="个人中心-地址管理-新增地址",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *     },
     *     views={"all","user-center","user","goods","shopping"},
     *     parameters={
     *      {"name"="username", "dataType"="string", "required"=true, "description"="联系人"},
     *      {"name"="phone", "dataType"="string", "required"=true, "description"="电话"},
     *      {"name"="address", "dataType"="string", "required"=true, "description"="地址"},
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="用户token"},
     *  },
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function newAction(Request $request)
    {
        $param['username'] = $request->request->get('username','');
        $param['phone'] = $request->request->get('phone','');
        $param['address'] = $request->request->get('address','');
        if ($this->checkParam($param) == false) {
            return $this->JsonResponse($param, -1, 'parameter error.');
        }
        $param['user'] = $this->getUser();
        $obj = $this->get('dufa_core_manager.useraddress')->create($param);
        return $this->JsonResponse($obj);
    }

    /**
     * @ApiDoc(
     *     description="个人中心-地址管理-编辑地址",
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
     *          "description"="地址id"
     *      }
     *  },
     *     views={"all","user-center","user","goods","shopping"},
     *     parameters={
     *      {"name"="username", "dataType"="string", "required"=true, "description"="联系人"},
     *      {"name"="phone", "dataType"="string", "required"=true, "description"="电话"},
     *      {"name"="address", "dataType"="string", "required"=true, "description"="地址"},
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="用户token"},
     *  },
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function editAction($id,Request $request)
    {
        $param['username'] = $request->request->get('username','');
        $param['phone'] = $request->request->get('phone','');
        $param['address'] = $request->request->get('address','');
        if ($this->checkParam($param) == false) {
            return $this->JsonResponse($param, -1, 'parameter error.');
        }
        $param['user'] = $this->getUser();
        $obj = $this->get('dufa_core_manager.useraddress')->update($id,$param);
        return $this->JsonResponse($obj);
    }

    /**
     * @ApiDoc(
     *     description="个人中心-删除地址",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         420 = "System error.",
     *     },
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="地址id"
     *      }
     *  },
     *     views={"all","user-center","user","goods","shopping"},
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="用户token"},
     *  },
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function deleteAction($id,Request $request)
    {
        if($this->get('dufa_core_manager.useraddress')->delete($id))
        {
            return $this->JsonResponse();
        }
    }
}
