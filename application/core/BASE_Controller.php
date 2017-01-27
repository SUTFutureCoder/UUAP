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
    }

    abstract protected function checkParam($arrInput);
    abstract protected function myIndex();

    //默认执行
    public function index(){

        try {
            $arrInput = [];
            $this->checkParam($arrInput);
            $ret = $this->myIndex();
            echo json_encode([
                'error_no'  => 0,
                'error_msg' => '',
                'result'    => $ret,
            ]);
        } catch (Exception $e){
            //标准化输出
            echo class_exists('BASE_Exception');
            throw new MException($e->getMessage(), $e->getCode(), null);
        }
    }

}