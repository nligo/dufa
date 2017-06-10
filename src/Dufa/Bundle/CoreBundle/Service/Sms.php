<?php
namespace Dufa\Bundle\CoreBundle\Service;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author  coffey
 *
 * 发送验证码
 * Class Sms
 */
class Sms
{
    private $smsUrl = 'http://api.smsbao.com/';
    private $smsUsername = 'lmgame';
    private $smsPassword = '123@qwe';
    private $companyName = '捌跃科技';
    private $statusCode = array(
        "0" => "短信发送成功",
        "-1" => "参数不全",
        "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
        "30" => "密码错误",
        "40" => "账号不存在",
        "41" => "余额不足",
        "42" => "帐户已过期",
        "43" => "IP地址限制",
        "50" => "内容含有敏感词"
    );
    private $sendUrl = '';

    public function __construct()
    {
        $this->sendUrl = array(
            'u' =>  $this->smsUsername,
            'p' =>  md5($this->smsPassword),
        );
    }

    /**
     * @author  coffey
     *
     * curl配置 post | get请求
     * @param string $type
     * @param array $data
     * @param string $url
     * @return array|mixed
     */
    private function curl_config($type = 'GET',$data = array(),$url = '')
    {
        $ch = curl_init();
        $output = array('code'=>1);
        switch ($type)
        {
            case "GET":
                $urlParam = $this->dealparam($data);
                $sendUrl = $url.'?'.$urlParam;
                curl_setopt($ch, CURLOPT_URL, $sendUrl);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_HEADER,0);
                break;
            case "POST":
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
        }
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    /**
     * @author  coffey
     *
     * 发送验证码
     * @param int $phone
     * @return mixed
     */
    public function sendCode($phone = 0)
    {
        $result['code'] = -1;
        $result['msg'] = $this->statusCode[$result['code']];
        if (preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/", $phone)) {
            $code = $this->setCode();
            $this->sendUrl['m'] = $phone;
            $contents = "【{$this->companyName}】您的验证码为{$code}";
            $this->sendUrl['c'] = urlencode($contents);
            $url = $this->smsUrl.'sms';
            $result['code'] = $this->curl_config('GET',$this->sendUrl,$url);
            $result['msg'] = $this->statusCode[$result['code']];
            $result['sms_code'] = $code;
        }
        return $result;
    }

    /**
     * 处理参数
     * */
    public function dealparam($param)
    {

        $url = array();
        if(!empty($param)){
            foreach ($param as $k=>$v)
            {
                if($v !== '' &&$v!==false)
                {
                    $url[] = $k.'='.$v;
                }
            }
        }
        return !empty($url) ? implode('&', $url) : '';
    }

    public function setCode()
    {
        $response = new Response();
        $charset = "1234567890";//随机因子
        $codelen = 4; //验证码显示几个文字
        $_leng = strlen($charset) - 1;
        $code = '';
        for ($i = 0; $i < $codelen; $i++) {
            $code.=$charset[mt_rand(0, $_leng)];
        }
        $response->headers->setCookie(new Cookie('sms_code',$code,time()+180));
        $response->send();
        return $code;
    }
}