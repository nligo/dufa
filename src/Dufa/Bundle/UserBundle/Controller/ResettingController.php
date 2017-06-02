<?php

namespace Appcoachs\Bundle\UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ResettingController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="user resetting password reset.",
     *     statusCodes={
     *         200 = "success.",
     *         412 = "parameter error.",
     *         413 = "user not exits.",
     *         420 = "System error.",
     *     },
     *  parameters={
     *      {"name"="password", "dataType"="string", "required"=true, "description"="password"},
     *  },
     *     tags={
     *         "完成待对接" = "green",
     *     }
     *  )
     */
    public function resetAction(Request $request, $token = 0)
    {
        $userInfo = $this->get('appcoachs_user_manager.user')->getRepository()->find($token);
        if (empty($userInfo)) {
            return $this->JsonResponse(array(), 413, 'token error');
        }
        if ($request->isMethod('post')) {
            $param['password'] = $request->request->get('password');
            if ($this->checkParam($param) == false) {
                return $this->JsonResponse($param, 412);
            }
            $encoder = $this->container->get('security.encoder_factory')
                ->getEncoder($userInfo)
            ;
            $encoded = $encoder->encodePassword($param['password'], $userInfo->getSalt());
            $userInfo->setPassword($encoded);
            $this->_dm()->persist($userInfo);
            $this->_dm()->flush();

            return $this->JsonResponse();
        } elseif ($request->isMethod('get')) {
            return new RedirectResponse($this->container->getParameter('migu_domain')."/change-password?".$userInfo->getId());
        } else {
            return $this->JsonResponse(array(), 412);
        }
    }

    /**
     * @ApiDoc(
     *     description="user resetting password send email .",
     *     statusCodes={
     *         200 = "Validation success.",
     *         410 = "user not exits.",
     *         411 = "user is actived.",
     *         420 = "System error.",
     *     },
     *  parameters={
     *      {"name"="email", "dataType"="email", "required"=true, "description"="email"},
     *      {"name"="return_url", "dataType"="email", "required"=true, "description"="returnUrl"},
     *  },
     *     tags={
     *         "完成待对接" = "green",
     *     }
     *  )
     */
    public function sendEmailAction(Request $request)
    {
        $email = $request->request->get('email', '');
        $user = $this->get('appcoachs_user_manager.user')->getRepository()->findOneBy(array('email' => $email));
        if (empty($user)) {
            return $this->JsonResponse(array(), 410, 'user not exits.');
        }
        try {
            $receivers = [
                'from' => [
                    $this->container->getParameter('mailer_from_user') => $this->container->getParameter('mailer_from_user'),
                ],
                'to' => [
                    [$user->getEmail() => $user->getEmail()],
                ],
            ];
            // Email subject and body (string):
            $subject = 'User Resetting password email';
            $body = $this->renderView('AppcoachsUserBundle:Resetting:email.html.twig', array('user' => $user, 'company_name' => $this->container->getParameter('company_name')), 'text/html');
            $mailer = $this->get('appcoach.mailer');
            $mailer->send($receivers, $subject, $body);

            return $this->JsonResponse();
        } catch (\Exception $e) {
            return $this->JsonResponse(array(), 420, $e->getMessage());
        }
    }
}
