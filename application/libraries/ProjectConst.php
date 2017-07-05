<?php
/**
 * 项目专用的常量
 *
 * Created by PhpStorm.
 * User: linxingchen_iwm
 * Date: 2017/7/4 0004
 * Time: 16:59
 */
class ProjectConst {

    //验证码session名称
    const SESSION_IMG_CAPTCHA   = 'session_img_captcha';
    const SESSION_VOICE_CAPTCHA = 'session_voice_captcha';
    const SESSION_USER_ID       = 'session_user_id';
    const SESSION_USER_NAME     = 'session_user_name';

    //REDIS相关
    //手机验证码系列
    const REDIS_PHONE_CAPTCHA = 'phone:captcha:%s'; //手机号
    const REDIS_PHONE_CAPTCHA_PHONE_TIME_LIMIT = 'phone:captcha:limit:%s'; //手机号
}