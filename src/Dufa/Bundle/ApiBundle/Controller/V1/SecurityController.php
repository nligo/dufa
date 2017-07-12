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
     *     views={"all","user","master"},
     *     parameters={
     *      {"name"="_username", "dataType"="string", "required"=true, "description"="用户名"},
     *      {"name"="_password", "dataType"="string", "required"=true, "description"="密码"},
     *  },
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function loginAction(Request $request)
    {

        if($request->isMethod("post"))
        {
            $em = $this->getDoctrine()->getManager();
            $username = $request->request->get('_username');
            $password = $request->request->get('_password');
            if(empty($username) || empty($password))
            {
                return $this->JsonResponse([], -1, 'parameter error.');
            }
            $user = $this->em()->getRepository("DufaCoreBundle:User")->findOneBy(['username' => $username]);
            if(empty($user))
            {
                return $this->JsonResponse([], -1, 'parameter error.');
            }

            $encoderService = $this->get('security.encoder_factory');
            $encoder = $encoderService->getEncoder($user);
            if (!$encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt())) {
                return $this->JsonResponse(array(), -2, 'password error.');
            }

            $token = new UsernamePasswordToken($user, $password, 'ugogame_frontend_user', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);
            $token->setUser($user);
            $frontTokenId = 'dufa_user_api_login_session_'.strtoupper(substr(md5(time()), 0, 10));

            $user->setToken($frontTokenId);
            $this->em()->persist($user);
            $this->em()->flush($user);
            return $this->JsonResponse(array('userToken'=>$frontTokenId));
        }
        else
        {
            return $this->JsonResponse([], -1, 'parameter error.');
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
     *     views={"all","news","master"},
     *     tags={
     *          "完成" = "green",
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
     *     views={"all","user","master"},
     *     parameters={
     *      {"name"="userToken", "dataType"="string", "required"=true, "description"="用户token"},
     *  },
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function getUserAction(Request $request)
    {
        $param['tokenId'] = $request->request->get('userToken');
        if(empty($param['tokenId']))
        {
            return $this->JsonResponse($param, -1, 'parameter error.');
        }
        $user = $this->get('dufa_core_manager.user')->getRepository()->findOneBy(['token' => $param['tokenId']]);
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
     *         -4 = "phone number is error.",
     *     },
     *     views={"all","user","master"},
     *  parameters={
     *      {"name"="phone", "dataType"="string","required"=true,"description"="手机号码"},
     *  },
     *     tags={
     *          "完成" = "green",
     *     }
     * )
     */
    public function sendcodeAction(Request $request)
    {
        $param['phone'] = $request->request->get('phone','');
        if (!preg_match("/^1[34578]\d{9}$/", $param['phone'])) {
            return $this->JsonResponse([],-4);
        }
        $sms = $this->container->get('dufa_core_sms');
        $result = $sms->sendCode($param['phone']);
        return $this->JsonResponse($result['sms_code']);
    }
}
