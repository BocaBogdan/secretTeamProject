<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
	Redirect::redirectTo('index.php');
}

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'password_curent' => array(
				'required' => true,
				'min' => 6
			),
			'password_new' => array(
				'required' => true,
				'min' => 6
			),
			'password_new_again' => array(
				'required' => true,
				'min' => 6
			)
		));
		if($validation->passed()){
			if(Hash::make(Input::get('password_curent'), $user->data()->salt)!== $user-data()->password){
				echo 'curent password wrong';
			}else {
				$salt = Hash::salt(32);
				$user->update(array(
				'password' => Hash::make(Input::get('password_new'),$salt),
				'salt' => $salt;
				));
				
				Session::flash('home', 'Password chaged');
				Redirect::redirectTo('index.php');
			}
		}else{
			foreach($validation->errors() as $error){
				echo $error, '<br>';
			}
		}
	}
}
?>

<form action="" method="post">
	<div class="field">
		<label for="password_curent">Curent password</label>
		<input type="password" name="password_curent" id="password_curent" >
	</div>
	
	<div class="field">
		<label for="password_new">New Password</label>
		<input type="password" name="password_new" id="password_new">
	</div>
	
	<div class="field">
		<label for="password_new_again">New password again</label>
		<input type="password" name="password_new_again" id="password_new_again">
	</div>
	
	
												<!--generam un token-->
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit"  value="Change">
</form>