<?php
require_once 'core/init.php';

$loginError = false;
$loginErrorMessage = '';

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username_login' => array('required' => true),
			'password_login' => array('required' => true)
		));

		if($validation->passed()){
				$user = new User();

				$remember = (Input::get('remember') === 'on') ? true : false;
				$login = $user->login(Input::get('username_login'), Input::get('password_login'), $remember);

				if($login) {
					Redirect::redirectTo('index.php');
				}else{
                    $loginError = true;
					$loginErrorMessage = 'Username/Password wrong !';
				}

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

    <div class="container-bubble container-bubble--small <?php if($loginError) echo 'error-form';?>">
        <form class="small-form" method="post">
            <h1 class="small-form-title">Sign In</h1>
            <input type="text" placeholder="username" class="login-input" name="username_login" required>
            <input type="password" placeholder="password" class="login-input" name="password_login" required>
            <label class="login-label">
                <input type="checkbox" name="remember">
                <span>Remember me</span>
            </label>
            <p class="error-message"> <?php  echo $loginErrorMessage; ?></p>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input type="hidden" name="action" value="login">

            <button type="submit" class="login-button">Login</button>
        </form>
    </div>

    <h1 class="container-title">AuctioX</h1>

    <div class="container-bubble container-bubble--mini">
        <a class="sing-un-button" style="width: 90%; margin-bottom: 0" href="register.php"> Make an account</a>
    </div>

</main>
</body>
</html>