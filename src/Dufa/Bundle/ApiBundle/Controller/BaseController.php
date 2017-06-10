<?php

namespace Dufa\Bundle\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    protected function JsonResponse($data = array(), $code = 0, $msg = 'Operation is successful', $isEnabledSerialize = true, $format = 'json')
    {
        if ($isEnabledSerialize == true) {
            $data = $this->get('serializer')->serialize(array('code' => $code, 'msg' => $msg, 'data' => $data), $format);
            return new Response($data);
        }

        return new JsonResponse(array('code' => $code, 'msg' => $msg, 'data' => $data),200);
    }

    /**
     * @author  coffey
     * 效验字符串是否为空
     *
     * @param $paramName
     */
    protected function checkParam($paramArray = array())
    {
        if (in_array(0, array_map(create_function('&$v', 'return empty($v)?0:1;'), $paramArray))) {
            return false;
        }

        return true;
    }

    public function em()
    {
        return $this->getDoctrine()->getManager();
    }

    public function checkUserToken()
    {
        $userToken = isset($_POST['userToken']) ? $_POST['userToken'] : "";
        if (empty($userToken)) {
            $result = [
                "code" => -2,
                "msg" => 'token error.',
            ];
            return json_encode($result);
        }
        $user = $this->get('session')->get($userToken)->getUser();
        return $user;
    }
}
