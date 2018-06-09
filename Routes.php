<?php

Route::set('home',function(){
			Home::CreateView('Home');
			Home::test();
		}
	);
	
Route::set('index.php',function(){
			Index::CreateView('Index');
		}
	);	

?>