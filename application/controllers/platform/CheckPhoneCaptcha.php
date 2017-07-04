<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 检查短信验证码
 *
 * Created by PhpStorm.
 * User: linxingchen_iwm
 * Date: 2017/7/4 0004
 * Time: 17:44
 */
class CheckPhoneCaptcha extends BASE_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    protected function checkParam($arrInput)
    {
        // TODO: Implement checkParam() method.
    }

    protected function myIndex($arrInput)
    {
        $this->load->library('session');

    }

}