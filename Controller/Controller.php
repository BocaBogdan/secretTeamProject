<?php

class Controller extends DB{

	public static function CreateView($viewName){
		require_once("Views/$viewName.php");
	}
	
}
?>