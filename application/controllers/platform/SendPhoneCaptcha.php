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
        $this->load->library('util/RedisLib');

        //检查验证码
        if (!in_array($arrInput['reg_captcha'], [
            $this->session->userdata(ProjectConst::SESSION_IMG_CAPTCHA),
            $this->session->userdata(ProjectConst::SESSION_VOICE_CAPTCHA),
        ])) {
            $this->response->jsonFail(ErrorCodes::ERROR_ACCOUNT_CAPTCHA_ERROR, ErrorCodes::$error_codes[ErrorCodes::ERROR_ACCOUNT_CAPTCHA_ERROR]);
        }

        //这里需要对手机号进行限制，每日最多三次请求
        $phoneLimit = RedisLib::get(sprintf(ProjectConst::REDIS_PHONE_CAPTCHA_PHONE_TIME_LIMIT, $arrInput['reg_phone']));
        if ($phoneLimit > 3){
            $this->response->jsonFail(ErrorCodes::ERROR_ACCOUNT_PHONE_TIME_EXCEED, ErrorCodes::$error_codes[ErrorCodes::ERROR_ACCOUNT_PHONE_TIME_EXCEED]);
        }

        //expire存入redis
        $expireTime = 900;
        $userPhoneCaptcha = $this->random->createRandomBytes(4);

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

        //设定验证码记录
        $ret = RedisLib::setex(sprintf(ProjectConst::REDIS_PHONE_CAPTCHA, $arrInput['reg_phone']), $expireTime, $userPhoneCaptcha);
        if ($ret === false) {
            throw new MException(CoreConst::MODULE_KERNEL, ErrorCodes::ERROR_REDIS);
        }

        //自增限制
        $ret = RedisLib::incr(sprintf(ProjectConst::REDIS_PHONE_CAPTCHA_PHONE_TIME_LIMIT, $arrInput['reg_phone']));
        if ($ret === false) {
            throw new MException(CoreConst::MODULE_KERNEL, ErrorCodes::ERROR_REDIS);
        }
    }

}