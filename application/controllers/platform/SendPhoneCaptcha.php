<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 发送手机验证码
 *
 * Created by PhpStorm.
 * User: lin
 * Date: 17-6-17
 * Time: 下午4:42
 */
class SendPhoneCaptcha extends BASE_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    protected function checkParam($arrInput)
    {
        Validator::isMobile($arrInput['reg_phone'], '手机号码不能为空');
    }

    protected function myIndex($arrInput)
    {
        $this->load->library('session');
        var_dump($arrInput);
        var_dump($this->session->userdata());
//        $this->load->library('util/Sms');
//        $templateCode = 'SMS_71350740';
//        if ($this->sms->run($arrInput['reg_phone'], $templateCode, [
//            'number' => '123456',
//            'namea'  => '门神',
//            'time'   => '1024',
//            'nameb'  => '门神',
//        ])) {
//
//        }
    }

}