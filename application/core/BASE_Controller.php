<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 控制器基类
 *
 *
 * Created by PhpStorm.
 * User: linxingchen_iwm
 * Date: 2017/1/26
 * Time: 21:27
 */
abstract class BASE_Controller extends CI_Controller {

    public function __construct(){
        parent::__construct();

        //载入类 尽可能不要污染autoload和config
        $this->load->library('util/CoreConst');
        $this->load->library('util/ErrorCodes');
        $this->load->library('util/MLog');
        $this->load->library('util/MException');
        $this->load->library('util/Validator');
        $this->load->library('util/Response');
    }

    abstract protected function checkParam($arrInput);
    abstract protected function myIndex($arrInput);

    //默认执行
    public function index(){

        try {
            //模糊化get post
            $arrInput = $this->input->get(null, true) + $this->input->post(null, true);
            $this->checkParam($arrInput);
            //检查是否有错误
            if ('' !== Validator::getMessage()){
                $this->response->jsonFail(ErrorCodes::ERROR_PARAM_ERROR, Validator::getMessage());
            }
            $ret = $this->myIndex($arrInput);
            $this->response->jsonSuccess($ret);
        } catch (Exception $e){
            //标准化输出
            throw new MException($e->getMessage(), $e->getCode(), null);
        }
    }

}