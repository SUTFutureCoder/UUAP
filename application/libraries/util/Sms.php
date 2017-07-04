<?php
/**
 * 发短信类
 *
 * Created by PhpStorm.
 * User: lin
 * Date: 17-6-19
 * Time: 上午8:48
 */
require_once APPPATH . 'third_party/ali_php_sdk/mns-autoloader.php';
use AliyunMNS\Client;
use AliyunMNS\Topic;
use AliyunMNS\Constants;
use AliyunMNS\Model\MailAttributes;
use AliyunMNS\Model\SmsAttributes;
use AliyunMNS\Model\BatchSmsAttributes;
use AliyunMNS\Model\MessageAttributes;
use AliyunMNS\Exception\MnsException;
use AliyunMNS\Requests\PublishMessageRequest;

class Sms
{
    public function run($mobile, $template_code, $pars = array())
    {
        $CI =& get_instance();
        /**
         * Step 1. 初始化Client
         */
        $this->endPoint = $CI->config->item('ali_sms')['endpoint'];
        $this->accessId = $CI->config->item('ali_sms')['access_id'];
        $this->accessKey = $CI->config->item('ali_sms')['access_key'];
        $this->client = new Client($this->endPoint, $this->accessId, $this->accessKey);
        /**
         * Step 2. 获取主题引用
         */
        $topicName = $CI->config->item('ali_sms')['topic_name'];//"sms.topic-cn-hangzhou";
        $topic = $this->client->getTopicRef($topicName);
        /**
         * Step 3. 生成SMS消息属性
         */
        // 3.1 设置发送短信的签名（SMSSignName）和模板（SMSTemplateCode）
        $batchSmsAttributes = new BatchSmsAttributes($CI->config->item('ali_sms')['SMS_sign_name'], $template_code);
        // 3.2 （如果在短信模板中定义了参数）指定短信模板中对应参数的值
        $batchSmsAttributes->addReceiver($mobile, $pars);
        // $batchSmsAttributes->addReceiver("YourReceiverPhoneNumber2", array("YourSMSTemplateParamKey1" => "value1"));
        $messageAttributes = new MessageAttributes(array($batchSmsAttributes));
        /**
         * Step 4. 设置SMS消息体（必须）
         *
         * 注：目前暂时不支持消息内容为空，需要指定消息内容，不为空即可。
         */
        $messageBody = "smsmessage";
        /**
         * Step 5. 发布SMS消息
         */
        $request = new PublishMessageRequest($messageBody, $messageAttributes);
        try {
            $res = $topic->publishMessage($request);
            return $res->isSucceed();
//            echo $res->isSucceed();
//            echo "\n";
//            echo $res->getMessageId();
//            echo "\n";
        } catch (MnsException $e) {
            //记录错误日志，比如我的helper里面有个write_log方法
            throw new MException(CoreConst::MODULE_THIRD_ALISMS, ErrorCodes::ERROR_THIRD_ALISMS_ERROR, null, $e->getMessage());
            return false;
        }
    }
}