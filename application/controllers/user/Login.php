<?php
/**
 * 检查登录
 *
 * Created by PhpStorm.
 * User: lin
 * Date: 17-2-16
 * Time: 上午12:22
 */
class Login extends BASE_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function checkParam($arrInput)
    {
        Validator::isString($arrInput['test'], 'test不能为空');
        // TODO: Implement checkParam() method.
        return $arrInput;
    }

    public function myIndex($arrInput)
    {

    }
}