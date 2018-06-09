<?php
class Redirect{
	public static function redirectTo($location = null){
		if($location){
			if(is_numeric($location)){
				switch($location){
					case 404:
						header('http/ 404 not found');
						include 'includes/errors/404.php';
						exit();
					break;
				}
			}
			if($location) {
			header('Location: ' . $location);
			exit();
			}
		}
	}
}
?>