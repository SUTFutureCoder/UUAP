<?php
/**
 * 用户表
 *
 * Created by PhpStorm.
 * User: lin
 * Date: 17-7-6
 * Time: 上午12:51
 */
class UsersModel extends CI_Model {

    const TABLE_NAME = 'oauth_users';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 添加用户
     *
     * @param $userInfo
     * @return bool
     */
    public function addUser($userInfo){
        if (empty($userInfo)){
            return false;
        }

        return $this->db->insert(
            self::TABLE_NAME,
            [
                'user_id'   => $userInfo['reg_user_id'],
                'user_name' => $userInfo['reg_user_name'],
                'password'  => $userInfo['reg_hash_password'],
                'user_email'    => $userInfo['reg_email'],
                'user_phone'    => $userInfo['reg_phone'],
                'status'        => CoreConst::STATUS_INVALID,
                'create_time'   => time(),
            ]
        );
    }

}