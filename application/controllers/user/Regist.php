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

    }

    protected function myIndex($arrInput){
        $arrInput = [];
        $this->checkParam($arrInput);

//        throw new MException('hello world', 100, null);
        return $this->input->get('hello');
    }
}
