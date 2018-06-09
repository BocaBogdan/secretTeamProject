<?php
// bun aici o sa facem criptarea. probabi v-ati intrebarea ce dracu e salt 
// este pentru a face criptarea mai buna de ceva google it
//adauga un string generat random la sfarsitul parolei
class Hash{
	public static function make($string, $salt = ''){
		return hash('sha256', $string . $salt);
	}
	
	public static function salt($length){
		return mcrypt_create_iv($length);
	}
	
	public static function unique(){
		return self::make(uniqid());
	}
}
?>