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
     *         -3 = "sms code error.",
     *         -4 = "phone number error.",
     *         1 = "System error.",
     *     },
     *     views={"all","user","master"},
     *     parameters={
     *      {"name"="phone", "dataType"="string", "required"=true, "description"="手机号"},
     *      {"name"="password", "dataType"="string", "required"=true, "description"="密码"},
     *      {"name"="code", "dataType"="string", "required"=true, "description"="验证码"},
     *  },
     *     tags={
     *          "完成" = "green",
     *     }
     *  )
     */
    public function resetAction(Request $request)
    {
        $userManager = $this->get("dufa_core_manager.user");
        $password = $request->request->get('password');
        $code = $request->request->get('code');
        $smsCode = $request->cookies->get("sms_code");
        $phone = $request->request->get('phone','');
        if (!preg_match("/^1[34578]\d{9}$/", $phone)) {
            return $this->JsonResponse([],-4);
        }
        if($code != $smsCode)
        {
            return $this->JsonResponse([], -3, 'sms code error.');
        }
        $userInfo = $userManager->getRepository()->findOneBy(['phone' => $phone]);
        try
        {
            $encodePassword = $userManager->encodePw($userInfo,$password);
            $userInfo->setPassword($encodePassword);
            $this->em()->persist($userInfo);
            $this->em()->flush($userInfo);
            return $this->JsonResponse([], 0);
        }catch (\Exception $e)
        {
            return $this->JsonResponse([], 1,'change password error');

        }
    }

}