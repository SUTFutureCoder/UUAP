<?php
/**
 * 调取oauth sdk用
 *
 * Created by PhpStorm.
 * User: lin
 * Date: 17-7-4
 * Time: 下午10:50
 */
class OauthServer {

    public function __construct()
    {
        require_once(__DIR__ . '/../third_party/OAuth2/src/OAuth2/Autoloader.php');
        require_once APPPATH . 'config/database.php';
        $config = $db['default'];

        OAuth2\Autoloader::register();
        $this->storage = new OAuth2\Storage\Pdo(['dsn' => $config['dsn'], 'username' => $config['username'], 'password' => $config['password']]);
        $this->server  = new OAuth2\Server($this->storage, ['allow_implicit' => true]);
        $this->request = OAuth2\Request::createFromGlobals();
        $this->response = new OAuth2\Response();

        $this->ci = &get_instance();
    }

    /**
     * 用于平台验证
     *
     * 需要传 client id : password authorize header
     * password_credentials, for more see: http://tools.ietf.org/html/rfc6749#section-4.3
     * @link http://homeway.me/2015/06/29/build-oauth2-under-codeigniter/#Resource_Owner_Password_Credentials
     */
    public function passwordCredentials(){
//        $users = array("user" => array("password" => 'pass', 'first_name' => 'homeway', 'last_name' => 'yao'));
//        $storage = new OAuth2\Storage\Memory(array('user_credentials' => $users));
        $this->server->addGrantType(new OAuth2\GrantType\UserCredentials($this->storage));
        $this->server->handleTokenRequest($this->request)->send();
    }

    /**
     * 统一进行返回
     *
     * @param \Oauth2\Response $response
     */
    private function result(Oauth2\Response $response){
        if ($response->getStatusCode() != 200){
            $this->ci->response->jsonFail($response->getStatusCode(), $response->getParameters()['error_description']);
        }
    }

}