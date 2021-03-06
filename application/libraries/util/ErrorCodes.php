<?php
/**
 * 错误信息
 *
 * Created by PhpStorm.
 * User: linxingchen_iwm
 * Date: 2017/1/27
 * Time: 23:01
 */
class ErrorCodes {

    //通用错误码,占用100,200开头
    const OK                        = 0;
    const ERROR_PARAM_ERROR         = 100;
    const ERROR_NETWORK_ERROR       = 101;
    const ERROR_USER_NOT_LOGIN      = 102;
    const ERROR_JSON_FORMAT_ERROR   = 103;
    const ERROR_PHP_INPUT_NULL      = 104;
    const ERROR_SAL                 = 105;
    const ERROR_JSON_DECODE         = 106;
    const ERROR_GEN_UUID            = 107;
    const ERROR_UUID_MAX            = 108;
    const ERROR_REDIS               = 109;
    const ERROR_FUNC_NON_EXISTS     = 110;
    const ERROR_IP_UNAUTHORIZED     = 111;

    //DB
    const ERROR_DB_CONNECT = 206;
    const ERROR_DB_INSERT  = 207;
    const ERROR_DB_UPDATE  = 208;
    const ERROR_DB_DELETE  = 209;
    const ERROR_DB_SELECT  = 210;

    //BOS
    const ERROR_BOS_CONTENT_LENGTH  = 10001;
    const ERROR_BOS_KEY_EMPTY       = 10002;
    const ERROR_BOS_CONTENT_MD5     = 10003;
    const ERROR_BOS_CHECK_DATA_FAIL = 10004;
    const ERROR_BOS_MAX_USER_METADATA = 10005;
    const ERROR_BOS_FILE_NOT_EXIST  = 10006;
    const ERROR_BOS_STRING_FILE_NAME_EMPTY = 10007;
    const ERROR_BOS_STRING_DATA_NOT_VALID  = 10008;
    const ERROR_BOS_STRING_MIME_NOT_VALID  = 10009;

    //账号体系
    const ERROR_ACCOUNT_CAPTCHA_ERROR = 20001;
    const ERROR_ACCOUNT_PHONE_SEND_CAPTCHA_FAIL = 20002;
    const ERROR_ACCOUNT_PHONE_TIME_EXCEED = 20003;
    const ERROR_ACCOUNT_PHONE_WRONG = 20004;

    //上传部分
    const ERROR_UPLOAD_STRING_MIME_MISSING = 30001;

    //消息部分
    const ERROR_MESSAGE_UPDATE_STATUS = 40005;

    //第三方部分
    const ERROR_THIRD_BDVOICE_ERROR = 50001;
    const ERROR_THIRD_ALISMS_ERROR  = 50002;

    public static $error_codes = array(
        self::ERROR_PARAM_ERROR     => 'param error',
        self::ERROR_NETWORK_ERROR   => 'network error',
        self::ERROR_USER_NOT_LOGIN  => 'user not login',
        self::ERROR_JSON_FORMAT_ERROR => 'json format error',
        self::ERROR_PHP_INPUT_NULL  => 'file get content php input error',
        self::ERROR_SAL             => 'do http query by sal failed',
        self::ERROR_DB_CONNECT      => 'db connect error',
        self::ERROR_DB_INSERT       => 'db insert error',
        self::ERROR_DB_UPDATE       => 'db update error',
        self::ERROR_DB_DELETE       => 'db delete error',
        self::ERROR_DB_SELECT       => 'db select error',
        self::ERROR_GEN_UUID        => 'gen uuid error',
        self::ERROR_UUID_MAX        => 'uuid too long error',
        self::ERROR_REDIS           => 'redis error',
        self::ERROR_FUNC_NON_EXISTS => 'function non exists error',
        self::ERROR_IP_UNAUTHORIZED => 'unauthorized IP',

        //BOS服务
        self::ERROR_BOS_FILE_NOT_EXIST  => 'file not exist',
        self::ERROR_BOS_CONTENT_LENGTH  => 'content length should be int or long',
        self::ERROR_BOS_KEY_EMPTY       => 'key should not be empty or null',
        self::ERROR_BOS_CONTENT_MD5     => 'content md5 should not be empty or null',
        self::ERROR_BOS_CHECK_DATA_FAIL => 'check data failed',
        self::ERROR_BOS_MAX_USER_METADATA => 'user metadata size is too big',
        self::ERROR_BOS_STRING_FILE_NAME_EMPTY => 'file name was empty',
        self::ERROR_BOS_STRING_DATA_NOT_VALID  => 'string data not valid',
        self::ERROR_BOS_STRING_MIME_NOT_VALID  => 'string mime not valid please check base64 string',

        //账号体系
        self::ERROR_ACCOUNT_CAPTCHA_ERROR => '请输入正确验证码',
        self::ERROR_ACCOUNT_PHONE_SEND_CAPTCHA_FAIL => '发送手机验证码失败',
        self::ERROR_ACCOUNT_PHONE_TIME_EXCEED => '超过短信发送次数限制',
        self::ERROR_ACCOUNT_PHONE_WRONG => '短信验证码错误',

        //上传部分
        self::ERROR_UPLOAD_STRING_MIME_MISSING => 'upload base64 mime type missing',

        //消息部分
        self::ERROR_MESSAGE_UPDATE_STATUS => 'upate message status error',

        //第三方部分
        self::ERROR_THIRD_BDVOICE_ERROR   => 'bd voice error',
        self::ERROR_THIRD_ALISMS_ERROR    => 'ali sms error',

    );

    /**
     * 用于根据常量获取的errno错误码获取错误信息
     *
     *
     * @param $errno
     * @return string
     */
    public static function errMsg($errno){
        if (!isset(self::$error_codes[$errno]) || empty(self::$error_codes[$errno])){
            $errMsg = 'Errno msg not found. errno.:' . $errno;
        }

        return self::$error_codes[$errno];
    }

}