<?php
class Controller_main extends diam\test\Controller
{
    function __construct()
    {
        $this->view = new diam\test\View();
    }
    
    function action_index()//основная страница (для незаергистрированных)
    {
        $client_id = '5965813'; // ID приложения
        $redirect_uri = 'http://gsk17.adr.com.ua/main/login'; // Адрес сайта
        $url = 'http://oauth.vk.com/authorize';

        $params = array(
            'client_id'     => $client_id,
            'redirect_uri'  => $redirect_uri,
            'response_type' => 'code'
        );

	$link = $url . '?' . urldecode(http_build_query($params));
        $this->view->generate('login.php', 'stamp_view.php',['link'=>$link]);
    }
    
    function action_login($code){//вход зарегисрированных
        $client_id = '5965813'; // ID приложения
        $client_secret = 'Z727LvJSxWN5R74Ra2Nc'; // Защищённый ключ
        $redirect_uri = 'http://gsk17.adr.com.ua/main/login'; // Адрес сайта
        $url = 'http://oauth.vk.com/authorize';
        $register = FALSE;
       if (isset($code)) {
	    $result = false;
	    $params = array(
	        'client_id' => $client_id,
	        'client_secret' => $client_secret,
	        'code' => $code,
	        'redirect_uri' => $redirect_uri
	    );
	 
	    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

	    if (isset($token['access_token'])) {
	        $params = array(
	            'uids'         => $token['user_id'],
	            'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
	            'access_token' => $token['access_token']
	        );
	 
	        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
	        if (isset($userInfo['response'][0]['uid'])) {
	            $userInfo = $userInfo['response'][0];
	            $result = true;
	        }
	    }
	 
	    if ($result) {
                if (isset($userInfo['first_name'])){
                    $register = TRUE;
                }
	    }
	}
        if ($register){//регистрация пройдена успешно
            $this->view->generate('send_form.php', 'stamp_view.php',['user_id'=>$userInfo['uid']]);
        } else{//регистрация прошла неудачно
            $params = array(
            'client_id'     => $client_id,
            'redirect_uri'  => $redirect_uri,
            'response_type' => 'code'
            );
            $link = $url . '?' . urldecode(http_build_query($params));
            $this->view->generate('login.php', 'stamp_view.php',['link'=>$link]);
        }
    }
    
}