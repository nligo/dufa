<?php

namespace Dufa\Bundle\ApiBundle\Controller\V1;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Dufa\Bundle\ApiBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SecurityController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="用户登录",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *         1 = "System error.",
     *         -2 = "password error.",
     *     },
     *     views={"all","user"},
     *     parameters={
     *      {"name"="user_name", "dataType"="string", "required"=true, "description"="用户名"},
     *      {"name"="user_password", "dataType"="string", "required"=true, "description"="密码"},
     *  },
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function loginAction(Request $request)
    {
        $param['username'] = $request->query->get('user_name');
        $param['password'] = $request->query->get('user_password');
        if ($this->checkParam($param) == false) {
            return $this->JsonResponse($param, -1, 'parameter error.');
        }
        
        $user = $this->em()->getRepository("DufaCoreBundle:User")->findOneBy(['username' => $param['username']]);
        $encoderService = $this->get('security.encoder_factory');
        $encoder = $encoderService->getEncoder($user);
        if ($encoder->isPasswordValid($user->getPassword(), $param['password'], $user->getSalt())) {
            $token = new UsernamePasswordToken($user->getUsername(), $param['password'], 'dufa_user_api_login', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);
            $token->setUser($user);
            $frontTokenId = 'dufa_user_api_login_session_'.strtoupper(substr(md5(time()), 0, 10));
            $this->get('session')->set($frontTokenId, $token);
            return $this->JsonResponse(array('userToken'=>$frontTokenId));
        } else {
            return $this->JsonResponse(array(), -2, 'password error.');
        }
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
        $this->get('security.token_storage')->setToken(null);
        return $this->JsonResponse();
    }

    /**
     * @ApiDoc(
     *     description="用户信息",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *     },
     *     views={"all","user"},
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="用户token"},
     *  },
     *     tags={
     *         "定义待填写逻辑" = "red",
     *     }
     *  )
     */
    public function getUserAction(Request $request)
    {
        $param['tokenId'] = $request->request->get('userToken');
        if ($this->checkParam($param) == false) {
            return $this->JsonResponse($param, -1, 'parameter error.');
        }
        $user = $request->getSession()->get($param['tokenId'])->getUser();
        return $this->JsonResponse($user);
    }

    /**
     * 发送短信
     *
     * @ApiDoc(
     *  resource=true,
     *  description="发送短信",
     *     statusCodes={
     *         0 = "success.",
     *         -1 = "parameters error.",
     *     },
     *  parameters={
     *      {"name"="phone", "dataType"="string","required"=true,"description"="手机号码"},
     *  },
     * )
     */
    public function sendcodeAction(Request $request)
    {
        $param['phone'] = $request->request->get('phone','');
        if (!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/", $param['phone'])) {
            return $this->JsonResponse([],-1);
        }
        $sms = $this->container->get('dufa_core_sms');
        $result = $sms->sendCode($param['phone']);
        return $this->JsonResponse($result['sms_code']);
    }
}
