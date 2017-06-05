<?php

namespace Dufa\Bundle\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    protected function JsonResponse($data = array(), $code = 200, $msg = 'Operation is successful', $isEnabledSerialize = true, $format = 'json')
    {
        if ($isEnabledSerialize == true) {
            $data = $this->get('serializer')->serialize(array('code' => $code, 'msg' => $msg, 'data' => $data), $format);
            return new Response($data);
        }

        return new JsonResponse(array('code' => $code, 'msg' => $msg, 'data' => $data),200);
    }
}
