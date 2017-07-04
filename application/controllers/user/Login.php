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
//        Validator::isString($arrInput['test'], 'test不能为空');
    }

    public function myIndex($arrInput)
    {
        $this->load->library('session');
        print_r($this->session->userdata());
        print_r($arrInput);
    }
}