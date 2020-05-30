<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Log in</title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<!--[if IE 6]>
<script type="text/javascript" src="../js/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript" src="../js/ie6Fixpng.js"></script>
<![endif]-->
</head>

<body>
<div class="headerBar">
	<div class="logoBar login_logo">
		<div class="comWidth">
			
			<h3 class="welcome_title">Welcome to log in</h3>
		</div>
	</div>
</div>

<div class="loginBox">
	<div class="login_cont">
	<form action="doLogin.php" method="post">
			<ul class="login">
				<li class="l_tit">Administrator account</li>
				<li class="mb_10"><input type="text"  name="account" placeholder="Please enter an administrator account"class="login_input user_icon"></li>
				<li class="l_tit">password</li>
				<li class="mb_10"><input type="password"  name="password" class="login_input password_icon"></li>
				<li class="l_tit">Verification code</li>
				<li class="mb_10"><input type="text"  name="verify" class="login_input password_icon"></li>
				<img src="getVerify.php" alt="" />
				<li class="autoLogin"><input type="checkbox" id="a1" class="checked" name="autoFlag" value="1"><label for="a1">Automatic login (automatic login within one week)</label></li>
				<li><input type="submit" value="" class="login_btn"></li>
			</ul>
		</form>
	</div>
</div>

</body>
</html>