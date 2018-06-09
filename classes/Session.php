<?php
class Session{
	//aici facem sessiunea
	public static function put($name, $value){
		return $_SESSION[$name] = $value;
	}
	
	public static function exists($name){
    return (isset($_SESSION[$name])) ? true : false;
	}
	
	public static function get($name){
		return $_SESSION[$name];
	}
	
	public static function delete($name){
		if(self::exists($name)){
			unset($_SESSION[$name]);
		}
	}
	
	//asta o functie pentru flash data asa se numeste 
	// aici cand facem registerul si reuseste user-ul sa se inregistreze iti arata ca ai reusit si daca dai refresh nu mai face register inca odata deoarece datele se sterg
	public static function flash($name, $string = ''){
		if(self::exists($name)){
			$session = self::get($name);
			self::delete($name);
			return $session;
		}else {
			self::put($name, $string);
		}
	}
}
?>