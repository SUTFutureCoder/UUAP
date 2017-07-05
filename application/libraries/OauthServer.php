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
        require_once(__DIR__.'/../third_party/Oauth2/src/OAuth2/Autoloader.php');
        require_once APPPATH . 'config/database.php';
        $config = $db['default'];

        Oauth2\Autoloader::register();
        $this->storage = new Oauth2\Storage\Pdo(['dsn' => $config['dsn'], 'username' => $config['username'], 'password' => $config['password']]);
        $this->server  = new Oauth2\Server($this->storage, ['allow_implicit' => true]);
        $this->request = Oauth2\Request::createFromGlobals();
        $this->response = new Oauth2\Response();
    }

    /**
     * 用于平台验证
     *
     * password_credentials, for more see: http://tools.ietf.org/html/rfc6749#section-4.3
     * @link http://homeway.me/2015/06/29/build-oauth2-under-codeigniter/#Resource_Owner_Password_Credentials
     */
    public function passwordCredentials(){
        $users = ['user' => ['password' => 'pass', 'first_name' => 'hw', 'last_name' => 'lin']];
        $storage = new Oauth2\Storage\Memory(['user_credentials' => $users]);
        $this->server->addGrantType(new Oauth2\GrantType\UserCredentials($storage));
        $this->server->handleTokenRequest($this->request)->send();
    }

}