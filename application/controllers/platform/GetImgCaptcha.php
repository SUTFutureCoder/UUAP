<?php
/**
 * 获取图片验证码
 *
 * Created by PhpStorm.
 * User: lin
 * Date: 17-2-13
 * Time: 下午11:53
 */
class GetImgCaptcha extends BASE_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function checkParam($arrInput)
    {
        // TODO: Implement checkParam() method.
    }

    public function myIndex($arrInput)
    {
        $this->load->library('util/ValidateCode');
        echo $this->validatecode->doimg();
        $strCode = $this->validatecode->getCode();
        $this->load->library('session');
        $this->session->set_userdata(CoreConst::SESSION_IMG_CAPTCHA, $strCode);
    }

}