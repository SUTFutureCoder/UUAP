<?php
/**
 * 百度语音
 *
 * Created by PhpStorm.
 * User: lin
 * Date: 17-2-12
 * Time: 下午9:24
 */
class BdVoice {

    const ACCESS_TOKEN_REDIS_KEY = 'third:bdvoice:accesstoken';
    const RETRY_TIME = 3;

    /**
     * 文字转语音
     *
     * @param $strText
     * @return mixed
     * @throws MException
     */
    public function textToVoice($strText){
        if (empty($strText)){
            throw new MException(CoreConst::MODULE_THIRD_BDVOICE, ErrorCodes::ERROR_THIRD_BDVOICE_ERROR, null, 'Text can not be empty');
        }
//        header("content-type:audio/mp3;charset=utf-8");
        $url = "http://tsn.baidu.com/text2audio";

        $array = array(
            "tex"   => $strText,
            "lan"   => 'zh',
            "tok"   => $this->getAccessToken(),
            'ctp'   => 1,
            "cuid"  => 'qwertyuiopiuytsa123',
            "spd"   => 1,
            "vol"   => 9,
        );

        for ($i = 0; $i < self::RETRY_TIME; ++$i){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array));
            $response = curl_exec($ch);
            if(curl_errno($ch))
            {
                continue;
            } else {
                curl_close($ch);
                break;
            }
        }

        return $response;
    }

    /**
     * 获取accesstoken
     *
     * @return bool
     * @throws MException
     */
    private function getAccessToken(){
        $CI  =& get_instance();
        $CI->load->library('util/RedisLib');
        $accessToken = RedisLib::get(self::ACCESS_TOKEN_REDIS_KEY);
        if (empty($accessToken)){
            for ($i = 0; $i < self::RETRY_TIME; ++$i){
                //需要重新获取
                $voiceConfig = $CI->config->item('bd_voice');
                if (empty($voiceConfig)){
//                    MLog::fatal(CoreConst::MODULE_THIRD_BDVOICE, 'BD Voice config is missing');
                    throw new MException(CoreConst::MODULE_THIRD_BDVOICE, ErrorCodes::ERROR_THIRD_BDVOICE_ERROR, null, 'BD Voice config is missing');
                }

                //put your params here
//                $cuid       = $voiceConfig['app_id'];
                $apiKey     = $voiceConfig['api_key'];
                $secretKey  = $voiceConfig['secret_key'];

                $auth_url = "https://openapi.baidu.com/oauth/2.0/token?grant_type=client_credentials&client_id=".$apiKey."&client_secret=".$secretKey;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $auth_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                $response = curl_exec($ch);
                if(curl_errno($ch))
                {
                    throw new MException(CoreConst::MODULE_THIRD_BDVOICE, ErrorCodes::ERROR_THIRD_BDVOICE_ERROR, curl_error($ch));
                }
                curl_close($ch);
                $response = json_decode($response, true);
                if (!empty($response['access_token'])){
                    $accessToken = $response['access_token'];
                    RedisLib::setex(self::ACCESS_TOKEN_REDIS_KEY, $response['expires_in'], $response['access_token']);
                    break;
                }
            }
        }

        return $accessToken;
    }


}