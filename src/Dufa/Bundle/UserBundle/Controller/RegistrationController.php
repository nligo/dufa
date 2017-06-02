<?php

namespace Appcoachs\Bundle\UserBundle\Controller;

use Appcoachs\Bundle\UserBundle\Document\User;
use Appcoachs\Bundle\UserBundle\Document\UserProfile;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends BaseController
{
    /**
     * @ApiDoc(
     *     description="user register .",
     *     statusCodes={
     *         200 = "Validation success.",
     *         410 = "Email is registered.",
     *         412 = "parameters error.",
     *         413 = "role is not exits.",
     *         420 = "System error.",
     *     },
     *  parameters={
     *      {"name"="email", "dataType"="email", "required"=true, "description"="email"},
     *      {"name"="password", "dataType"="string", "required"=true, "description"="password"},
     *      {"name"="user_type", "dataType"="string", "required"=true, "description"="user_type adverister or developer，adverister developer，default：adverister"}
     *  },
     *     tags={
     *         "完成待对接" = "green",
     *     }
     *  )
     */
    public function registerAction(Request $request)
    {
        $param['email'] = $request->request->get('email');
        $param['password'] = $request->request->get('password');
        $param['userrole'] = $request->request->get('user_type');
        $user = $this->get('appcoachs_user_manager.user')->getRepository()->findOneBy(array('email' => $param['email']));
        if (!empty($user)) {
            return $this->JsonResponse($param, 412, '邮箱被注册');
        }
        $userRole = $this->get('appcoachs_user_manager.roles')->getRepository()->findOneBy(array('roleName' => 'ROLE_'.strtoupper($param['userrole'])));
        if (empty($userRole)) {
            return $this->JsonResponse($param, 413, 'role is not exits');
        }
        try {
            $user = new User();
            $user->setEmail($param['email']);
            $encoded = $this->get('appcoachs_user_manager.user')->encodePassword($user, $param['password']);
            $user->setPassword($encoded);
            $user->addUserrole($userRole);
            $this->_dm()->persist($user);
            $user->setConfirmToken(base64_encode($user->getId()));
            $user->setTokenValidTime(time());
            $this->_dm()->persist($user);
            $userProfile = new UserProfile();
            $userProfile->setUser($user);
            $this->_dm()->persist($userProfile);
            $user->setUserProfile($userProfile);
            $this->_dm()->persist($user);
            $this->_dm()->flush();
            $request->request->set('email', $user->getEmail());
            $response = $this->forward('AppcoachsUserBundle:Registration:active', array(
            ));
            return $response;
        } catch (\Exception $e) {
            return $this->JsonResponse(array(), 420, $e->getMessage());
        }
    }

    /**
     * @ApiDoc(
     *     description="user active confirm .",
     *     statusCodes={
     *         413 = "user not exits.",
     *         414 = "token过期或失效",
     *     },
     *     tags={
     *         "完成待对接" = "green",
     *     }
     *  )
     */
    public function confirmAction(Request $request,$token)
    {
        $token = base64_decode($token);
        $user = $this->get('appcoachs_user_manager.user')->getRepository()->find($token);
        if (empty($user)) {
            return $this->JsonResponse(array(), 413, 'user not exits');
        }
        if ((time() - $user->getTokenValidTime()) < 3600 * 24) {
            $user->setIsActive('yes');
        } else {
            return $this->JsonResponse(array(), 413, 'token过期或失效');
        }
        $this->_dm()->persist($user);
        $this->_dm()->flush($user);
        return new RedirectResponse($this->container->getParameter('migu_domain')."/login");
    }

    /**
     * @ApiDoc(
     *     description="user active send email .",
     *     statusCodes={
     *         200 = "Validation success.",
     *         410 = "user not exits.",
     *         411 = "user is actived.",
     *         420 = "System error.",
     *     },
     *  parameters={
     *      {"name"="email", "dataType"="email", "required"=true, "description"="email"},
     *  },
     *     tags={
     *         "完成待对接" = "green",
     *     }
     *  )
     */
    public function activeAction(Request $request)
    {
        $email = $request->request->get('email');
        $user = $this->get('appcoachs_user_manager.user')->getRepository()->findOneBy(array('email' => $email));
        if (empty($user)) {
            return $this->JsonResponse(array(), 410, 'user not exits.');
        }
        if ($user->getIsActive() == 'yes') {
            return $this->JsonResponse(array(), 411, 'user is actived');
        }
        $user->setConfirmToken(base64_encode($user->getId()));
        $user->setTokenValidTime(time());
        $this->_dm()->persist($user);
        $this->_dm()->flush();
        $receivers = [
            'from' => [
                $this->container->getParameter('mailer_from_user') => $this->container->getParameter('mailer_from_user'),
            ],
            'to' => [
                [$user->getEmail() => $user->getEmail()],
            ],
        ];
        // Email subject and body (string):
        $subject = 'Users activate email';
        $body = $this->renderView('AppcoachsUserBundle:Regisration:email.html.twig', array('user' => $user, 'company_name' => $this->container->getParameter('company_name')), 'text/html');
        $mailer = $this->get('appcoach.mailer');
        $mailer->send($receivers, $subject, $body);

        return $this->JsonResponse();
    }
}
