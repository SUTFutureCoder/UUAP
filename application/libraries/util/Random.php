<?php
/**
 * 随机系列
 *
 * Created by PhpStorm.
 * User: lin
 * Date: 17-2-12
 * Time: 下午11:33
 */
class Random {

    public function createHashRandomCode($algorithm = 'sha256'){
        if (!in_array($algorithm, hash_algos())){
            return false;
        }
//        return hash($algorithm, $this->createRandomBytes());
    }

    public function createRandomBytes($length = 32){
        return bin2hex(random_bytes($length / 2));
    }

    public function createRandomInt($min, $max){
        return random_int($min, $max);
    }

}