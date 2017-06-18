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

    }

}