<?php

namespace Dufa\Bundle\WebBundle\Controller;

use Dufa\Bundle\CoreBundle\Service\Upload;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends Controller
{
    public function indexAction()
    {
        return $this->render('DufaWebBundle:Default:index.html.twig');
    }

    /**
     * 商品的上传地址
     * @return JsonResponse
     */
    public function goodsImgAddressAction()
    {
        //调取图片上传服务处理这个要上传的图片内容
        $upload = new Upload();
        $file = $upload->path('uploads/goodsImgs/' . date('Y/m'))->make();
        if (empty($file)) {
            $errors = $upload->getError();
            return new JsonResponse($errors);
        } else {
            //上传成功，把上传好的信息返给js
            $data = $file[0];
            return new JsonResponse($data, 200);
        }
    }
}
