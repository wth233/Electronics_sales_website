<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript" src="js/ie6Fixpng.js"></script>
<![endif]-->
</head>

<body>
<div class="headerBar">
	<div class="logoBar login_logo">
		<div class="comWidth">
			<div class="logo fl">
				
			</div>
			<h3 class="welcome_title">Welcome to Login</h3>
		</div>
	</div>
</div>

<div align="center">
    <a href="./admin/login.php">Administrator Login</a>
</div>



<div class="loginBox">
	<div class="login_cont">
	<form method="post" action="doAction.php?act=login" >
		<ul class="login">
			<li class="l_tit">Account</li>
			<li class="mb_10"><input type="text"  name="account" placeholder="Please input your account" class="login_input user_icon"></li>
			<li class="l_tit">Password</li>
			<li class="mb_10"><input type="password" name="password" class="login_input user_icon"></li>
			<li class="autoLogin"><input type="checkbox" id="a1" class="checked"><label for="a1">Automatic login</label></li>
			<li><input type="submit" value="" class="login_btn"></li>
		</ul>
		</form>
		
	</div>
	
</div>

<div align="center">
    <a href="./admin/login.php">Administrator Login</a>
</div>

</body>
</html>
