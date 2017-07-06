<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 用户注册相关
 *
 * Created by PhpStorm.
 * User: linxingchen_iwm
 * Date: 2017/1/26
 * Time: 21:04
 */
class Regist extends BASE_Controller {

    public function __construct(){
        parent::__construct();
    }

    protected function checkParam($arrInput){
        Validator::isEmail($arrInput['reg_email'], '请输入正确邮箱地址');
        Validator::stringRange($arrInput['reg_user_name'], 1, 32, '请输入小于32个字符的用户名');
        Validator::stringRange($arrInput['reg_password'], 8, 32, '密码需要大于8位');
        Validator::isMobile($arrInput['reg_phone'], '请输入正确手机号码');
        Validator::isNotEmpty($arrInput['reg_phone_captcha'], '请输入正确短信验证码');
    }

    protected function myIndex($arrInput){
        $this->load->library('session');
        $this->load->library('encryption');
        $this->load->library('util/RedisLib');
        $this->load->library('util/Uuid');

        //验证手机验证码是否正确
        if (RedisLib::get(sprintf(ProjectConst::REDIS_PHONE_CAPTCHA, $arrInput['reg_phone'])) != $arrInput['reg_phone_captcha']){
            $this->response->jsonFail(ErrorCodes::ERROR_ACCOUNT_PHONE_WRONG, ErrorCodes::$error_codes[ErrorCodes::ERROR_ACCOUNT_PHONE_WRONG]);
        }

        //检查手机及邮箱是否已经存在
        $this->load->model('UsersModel');
        if ($this->UsersModel->checkPhoneAndEMailUnique($arrInput['reg_phone'], $arrInput['reg_email'])){
            $this->response->jsonFail(ErrorCodes::ERROR_ACCOUNT_PHONE_EMAIL_NOT_UNIQUE, ErrorCodes::$error_codes[ErrorCodes::ERROR_ACCOUNT_PHONE_EMAIL_NOT_UNIQUE]);
        }

        //准备数据
        $arrInput['reg_user_id'] = Uuid::genUUID(CoreConst::USER_UUID);
        $encryptedPassword = $this->encryption->encrypt($arrInput['reg_password']);
        if ($encryptedPassword === false){
            throw new MException(CoreConst::MODULE_KERNEL, ErrorCodes::ERROR_ACCOUNT_PASSWORD_ENCRYPT_FAIL);
        }

        $arrInput['reg_hash_password'] = $encryptedPassword;

        //插入数据库
        if (false === $this->UsersModel->addUser($arrInput)){
            throw new MException(CoreConst::MODULE_DATABASE, ErrorCodes::ERROR_DB_INSERT);
        }

        //设置session
        $this->session->set_userdata(ProjectConst::SESSION_USER_ID, $arrInput['reg_user_id']);
        $this->session->set_userdata(ProjectConst::SESSION_USER_NAME, $arrInput['reg_user_name']);

        return true;
    }
}
