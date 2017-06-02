<?php

namespace Appcoachs\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class BaseController extends Controller
{
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

    protected function JsonResponse($data = array(), $code = 200, $msg = 'Operation is successful', $isEnabledSerialize = true, $format = 'json')
    {
        if ($isEnabledSerialize == true) {
            $data = $this->get('serializer')->serialize(array('code' => $code, 'msg' => $msg, 'data' => $data), $format);

            return new Response($data);
        }

        return new JsonResponse(array('code' => $code, 'msg' => $msg, 'data' => $data), 200);
    }

    protected function UserJsonResponse($user,$code = 200 , $msg = 'Operation is successful',  $format = 'json')
    {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getUserProfile();
        });
        $serializer = new Serializer(array($normalizer), array($encoder));
        $data = $serializer->serialize(array('code' => $code, 'msg' => $msg, 'data' => $user), $format);
        return new Response($data);
    }

    /**
     * Shortcut to return the DoctrineMongodb Registry service.
     *
     * @return Registry
     *
     * @throws \LogicException If DoctrineMongodbBundle is not available
     */
    protected function getDoctrineMongoDB()
    {
        if (!$this->container->has('doctrine_mongodb')) {
            throw new \LogicException('The DoctrineMongodbBundle is not registered in your application.');
        }

        return $this->container->get('doctrine_mongodb');
    }

    /**
     * @return mixed
     */
    protected function _dm()
    {
        return $this->getDoctrineMongoDB()->getManager();
    }

    /**
     * 处理参数.
     *
     * @param $param
     *
     * @return string
     */
    protected function dealparam($param)
    {
        $url = array();
        if (!empty($param)) {
            foreach ($param as $k => $v) {
                if ($v !== '' && $v !== false) {
                    $url[] = $k.'='.$v;
                }
            }
        }

        return !empty($url) ? implode('&', $url) : '';
    }
}
