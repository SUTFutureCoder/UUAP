<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: lin
 * Date: 17-2-12
 * Time: 下午7:58
 */
class GetVoiceCaptcha extends BASE_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function checkParam($arrInput)
    {
        // TODO: Implement checkParam() method.
    }

    public function myIndex($arrInput)
    {
        //生成随机码,并保存到session中
        $this->load->library('session');

        $tmpCode = $this->getNumCode();
        $strCode = str_replace('', '。', $tmpCode);

        $this->session->set_userdata(ProjectConst::SESSION_VOICE_CAPTCHA, strtolower($tmpCode));

        //声音验证码
        //声音验证码和图形验证码对上一个即可
        //注意调用时务必加上随机码，否则会走缓存
        //例如 http://localhost/UUAP/index.php/platform/GetVoiceCaptcha?state=test123
        $this->load->library('util/ThirdParty/BdVoice');
        header("Expires: Mon, 26 Jul 1970 05:00:00 GMT");
        header("content-type:audio/mp3;charset=utf-8");
        $captcha = $this->bdvoice->textToVoice($strCode);
        echo $captcha;
        exit;
    }

    /**
     * 获取随机码
     *
     * @return string
     */
    private function getCode(){
        //这个需要解决连读问题
        $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';//随机因子
        $codelen = 4;//验证码长度
        $_len    = strlen($charset) - 1;
        $code    = '';
        for ($i  = 0; $i < $codelen; $i++) {
            $code .= $charset[mt_rand(0, $_len)];
        }
        return $code;
    }

    /**
     * 获取数字随机码
     *
     * @return string
     */
    private function getNumCode(){
        $charset = '0123456789';//随机因子
        $codelen = 4;//验证码长度
        $_len    = strlen($charset) - 1;
        $code    = '';
        for ($i  = 0; $i < $codelen; $i++) {
            $code .= $charset[mt_rand(0, $_len)];
        }
        return $code;
    }
}