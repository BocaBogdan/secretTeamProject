<?php
// comenturile le scoateti voi
// pornesc sesiunea
session_start();
// facem configurari globale pentru baza de date | remember cookie si cand expira si sesiunea userului
//Nu ar trebui sa fie ceva ce sa nu intelegeti
$GLOBALS['config'] = array(
		'mysql' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'project_db'
		),
		'remember' => array(
			'cookie_name' => 'hash',
			'cookie_expiry' => 604800
		),
		'session' => array(
			'session_name' => 'user',
			'token_name' => 'token'
		)
);
// spl = standard php librarie restul e destul de descriptiv
spl_autoload_register(function($class){
	if(file_exists('./classes/'.$class.'.php')){
		require_once './classes/'.$class.'.php';
	}else if(file_exists('Model/'.$class.'.php')){
		 require_once 'Model/' . $class . '.php';
	}else if(file_exists('Controller/'.$class.'.php')){
		 require_once 'Controller/' . $class . '.php';
	}
		
       
});

require_once 'functions/sanitize.php';

if(Cookie::exists(Config::get('remember/cookie_name'))&& !Session::exists('session/session_name')){
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));
	
	if($hashCheck->count()){
		$user = new User($hashCheck->first()->user_id);
		$user->login();
	}
}
?>