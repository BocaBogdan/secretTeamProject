<?php
class Token {
	//generam token pentru login
	public static function generate(){
		return Session::put(Config::get('session/token_name'), md5(uniqid()));
	}
	// verificam token-ul
	public static function check($token){
		$tokenName = Config::get('session/token_name');
		
		//verificam daca exista sesiunea cu token-ul respectiv si o luam
		if(Session::exists($tokenName) && $token === Session::get($tokenName)){
			//apoi stergem sesiunea luandune dupa token
			Session::delete($tokenName);
			return true;
		}
		return false;
	}
}
?>