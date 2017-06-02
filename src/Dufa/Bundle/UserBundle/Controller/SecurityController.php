<?php

namespace Appcoachs\Bundle\UserBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SecurityController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="user login .",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameters error.",
     *         413 = "user is locked.",
     *         414 = "user not active.",
     *         415 = "user does not exist.",
     *         420 = "System error.",
     *     },
     *  parameters={
     *      {"name"="user_email", "dataType"="email", "required"=true, "description"="email"},
     *      {"name"="user_password", "dataType"="string", "required"=true, "description"="password"}
     *  },
     *     tags={
     *         "完成待对接" = "green",
     *     }
     *  )
     */
    public function loginAction(Request $request)
    {
        $param['email'] = $request->request->get('user_email');
        $param['password'] = $request->request->get('user_password');
        if ($this->checkParam($param) == false) {
            return $this->JsonResponse($param, 412, 'parameter error.');
        }
        $result = $this->get('appcoachs_user_manager.user')->loadValidUserByEmail($param['email']);
        if ($result['code'] != 200) {
            return $this->JsonResponse(array(), $result['code'], $result['msg']);
        }
        $userInfo = isset($result['data']) ? $result['data'] : null;
        $encoderService = $this->get('security.encoder_factory');
        $encoder = $encoderService->getEncoder($userInfo);
        if ($encoder->isPasswordValid($userInfo->getPassword(), $param['password'], $userInfo->getSalt())) {
            $token = new UsernamePasswordToken($userInfo->getUsername(), $param['password'], 'appcoachs_user_api_login', $userInfo->getRoles());
            $this->get('security.token_storage')->setToken($token);
            $token->setUser($userInfo);
            $frontTokenId = 'appcoachs_user_api_login_session_'.strtoupper(substr(md5(time()), 0, 10));
            $this->get('session')->set($frontTokenId, $token);
            return $this->JsonResponse(array('userToken'=>$frontTokenId));
        } else {
            return $this->JsonResponse(array(), 415, 'password error.');
        }
    }

    /**
     * @ApiDoc(
     *     description="user logout .",
     *     statusCodes={
     *         200 = "Validation success.",
     *         400 = "Validation failed."
     *  },
     *     tags={
     *         "完成待对接" = "green",
     *     }
     *  )
     */
    public function logoutAction()
    {
        $token = new AnonymousToken('appcoachs_user_api_login', 'anon.');
        $this->get('security.token_storage')->setToken(null);

        return $this->JsonResponse();
    }
}
