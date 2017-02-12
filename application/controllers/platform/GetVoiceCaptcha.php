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

    public function myIndex()
    {
        //生成随机码,并保存到session中
        $this->load->library('session');
        $captcha = '3 D W W';
        $this->session->set_userdata(CoreConst::SESSION_VOICE_CAPTCHA, $captcha);


        //声音验证码
        //声音验证码和图形验证码对上一个即可
        //注意调用时务必加上随机码，否则会走缓存
        //例如 http://localhost/UUAP/index.php/platform/GetVoiceCaptcha?state=test123
        $this->load->library('util/ThirdParty/BdVoice');
        header("content-type:audio/mp3;charset=utf-8");
        $captcha = $this->bdvoice->textToVoice($captcha);
        echo $captcha;
    }

}