<?php
require_once 'core/init.php';

//var_dump(Token::check(Input::get('token')));

$registerErrorMessage = '';

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'users'
			),
			'password' => array(
				'required' => true,
				'min' => 6
			),
			'password_again' => array(
				'required' => true,
				'matches' => 'password'
			),
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			)
		));

		if($validation->passed()){
			$user = new User();

			//sa vedeti despre ce este vorba in legatura cu salt
			/*
				$salt = Hash::salt(32);
			*/
			$salt = Hash::salt(32);
			try{
				$user->create(array(
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,
					'name' => Input::get('name'),
					'joined' => date('Y-m-d H:i:s'),
					'group' => 1
				));

				Session::flash('home', 'Regiter has been completed');
				Redirect::redirectTo('index.php');

			}catch(Exception $e){
				die($e->getMessage());
			}
		}else{
            $registerErrorMessage = $validation->errors()[0];
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:700" rel="stylesheet">

    <!-- style -->
    <link href="style/common.css" rel="stylesheet">
    <link href="style/login.css" rel="stylesheet">
</head>
<body>
<main class="container">

	<div class="container-bubble container-bubble--big <?php if($registerErrorMessage) echo 'error-form';?>">
		<form class="large-form" method="post">
			<h1 class="large-form-title">Make an <br>account</h1>
			<input type="text" placeholder="username" class="sing-un-input" name="username" required minlength="2">
			<input type="password" placeholder="password" class="sing-un-input" name="password" required minlength="6">
			<input type="password" placeholder="password again" class="sing-un-input" name="password_again" required minlength="6">
			<input type="text" placeholder="App name" class="sing-un-input" name="name" required minlength="2">
			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
			<input type="hidden" name="action" value="register">
			<p class="error-message"> <?php  echo $registerErrorMessage; ?></p>
			<button type="submit" class="sing-un-button">Register</button>
		</form>
	</div>

    <h1 class="container-title">AuctioX</h1>

	<div class="container-bubble container-bubble--mini">
		<a class="sing-un-button" style="width: 90%; margin-bottom: 0" href="login.php">Login</a>
	</div>

</main>
</body>
</html>