<?php

namespace Appcoachs\Bundle\UserBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class IndexController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="user info .",
     *     statusCodes={
     *         200 = "Validation success.",
     *         410 = "user is not login",
     *         411 = "user is not active",
     *         412 = "user is not login",
     *         412 = "token error",
     *         420 = "System error.",
     *     },
     *     tags={
     *         "完成待对接" = "green",
     *     },
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="userToken"},
     *  },
     *  )
     */
    public function userInfoAction(Request $request)
    {
        $tokenId = $request->request->get('userToken');
        if(empty($request->getSession()->get($tokenId)))
        {
            return $this->JsonResponse(array(), 413, 'token error');
        }
        $user = $request->getSession()->get($tokenId)->getUser();
        if(empty($user))
        {
            return $this->JsonResponse(array(), 413, 'token error');
        }
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->JsonResponse(array(), 410, 'user is not login');
        }
        if ($this->getUser()->getIsActive() == 'no') {
            return $this->JsonResponse(array(), 411, 'user is not active');
        }
        if ($this->getUser()->getIsLocked() == 'yes') {
            return $this->JsonResponse(array(), 412, 'user is locked');
        }
        try
        {
            $data['rolePermissions'] = [];
            $data['userInfo'] = $this->get('appcoachs_user_manager.user')->getRepository()->find($user->getId());
            if(!empty($data['userInfo']->getUserrole()))
            {
                foreach ($data['userInfo']->getUserrole() as $k=>$v)
                {
                    $rolepermissions = $this->get('appcoachs_user_manager.rolepermissions')->getRepository()->findBy(array('roleId.id' => $v->getId()));
                    if(!empty($rolepermissions))
                    {
                        $data['rolePermissions'][$v->getRoleName()]  = $rolepermissions;
                    }
                }
            }
            return $this->UserJsonResponse($data);
        }catch (\Exception $e)
        {
            return $this->JsonResponse(array(),420,$e->getMessage());
        }
    }
}
