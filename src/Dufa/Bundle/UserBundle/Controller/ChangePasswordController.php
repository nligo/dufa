<?php

namespace Appcoachs\Bundle\UserBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

class ChangePasswordController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="user change password.",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameter error.",
     *         413 = "user not exits.",
     *         414 = "passowrd error.",
     *         420 = "System error.",
     *     },
     *  parameters={
     *      {"name"="user_id", "dataType"="string", "required"=true, "description"="user_id"},
     *      {"name"="password", "dataType"="string", "required"=true, "description"="password"},
     *      {"name"="new_password", "dataType"="string", "required"=true, "description"="new_password"},
     *  },
     *     tags={
     *         "完成待对接" = "green",
     *     }
     *  )
     */
    public function changePasswordAction(Request $request)
    {
        $param['password'] = $request->request->get('password');
        $param['userId'] = $request->request->get('user_id');
        $param['newPassword'] = $request->request->get('new_password');
        if ($this->checkParam($param) == false) {
            return $this->JsonResponse($param, 412, 'parameter error.');
        }
        $userInfo = $this->get('appcoachs_user_manager.user')->getRepository()->find($param['userId']);
        if (empty($userInfo)) {
            return $this->JsonResponse($param, 413, 'user not exits.');
        }
        $encoderService = $this->get('security.encoder_factory');
        $encoder = $encoderService->getEncoder($userInfo);
        if ($encoder->isPasswordValid($userInfo->getPassword(), $param['password'], $userInfo->getSalt())) {
            $encoder = $this->container->get('security.encoder_factory')
                ->getEncoder($userInfo)
            ;
            $encoded = $encoder->encodePassword($param['newPassword'], $userInfo->getSalt());
            $userInfo->setPassword($encoded);
            $this->_dm()->persist($userInfo);
            $this->_dm()->flush();

            return $this->JsonResponse();
        } else {
            return $this->JsonResponse(array(), 414, 'password is error');
        }
    }
}
