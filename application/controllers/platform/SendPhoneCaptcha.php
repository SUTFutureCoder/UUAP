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
        Validator::isString($arrInput['reg_captcha'], '验证码不能为空');
        Validator::isMobile($arrInput['reg_phone'], '手机号码不能为空');
    }

    protected function myIndex($arrInput)
    {
        $this->load->library('session');
        $this->load->library('util/random');

        //检查验证码
        if (!in_array($arrInput['reg_captcha'], [
            $this->session->userdata(CoreConst::SESSION_IMG_CAPTCHA),
            $this->session->userdata(CoreConst::SESSION_VOICE_CAPTCHA),
        ])) {
            $this->response->jsonFail(ErrorCodes::ERROR_ACCOUNT_CAPTCHA_ERROR, ErrorCodes::$error_codes[ErrorCodes::ERROR_ACCOUNT_CAPTCHA_ERROR]);
        }

        $userPhoneToken = $this->random->createRandomBytes();


        $userPhoneCaptcha = $this->random->createRandomBytes(4);


        //这里需要对手机号进行限制，每日最多三次请求
        $expireTime = 900;

        $this->load->library('util/Sms');
        $templateCode = 'SMS_71350740';
        if (!$this->sms->run($arrInput['reg_phone'], $templateCode, [
            'number' => $userPhoneCaptcha,
            'namea'  => '门神',
            'time'   => $expireTime / 60 . '分钟',
            'nameb'  => '门神',
        ])) {
            throw new MException(CoreConst::MODULE_ACCOUNT, ErrorCodes::ERROR_ACCOUNT_PHONE_SEND_CAPTCHA_FAIL);
        }
    }

}