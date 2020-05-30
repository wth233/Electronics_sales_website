<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign up</title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript" src="js/ie6Fixpng.js"></script>
<![endif]-->
</head>

<script>
    function check(){
        //var reg = /^\w+((.\w+)|(-\w+))@[A-Za-z0-9]+((.|-)[A-Za-z0-9]+).[A-Za-z0-9]+$/;
        var reg = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
        var obj = document.getElementById("email");

        if(!reg.test(obj.value)){
            alert("email wrong format");
            return false;
        }else{
            return true;
        }

    }
</script>

<body>
<div class="headerBar">
	<div class="logoBar red_logo">
		<div class="comWidth">
			<div class="logo fl">
				
			</div>
			<h3 class="welcome_title">Welcome to sign up</h3>
		</div>
	</div>
</div>

<div class="regBox">
	<div class="login_cont">
	<form method="post" enctype="multipart/form-data" action="doAction.php?act=reg" >
		<ul class="login">
			<li><span class="reg_item"><i>*</i>Account：</span><div class="input_item"><input type="text"  name="account"  placeholder="Please input account" class="login_input user_icon" required="required"></div></li>
			<li><span class="reg_item"><i>*</i>Password：</span><div class="input_item"><input type="password"  name="password"   class="login_input user_icon"required="required"></div></li>
			<li><span class="reg_item"><i>*</i>Name：</span><div class="input_item"><input type="text" name="name" placeholder="Please input name" class="login_input user_icon"required="required"></div></li>
			<li><span class="reg_item"><i>*</i>Email：</span><div class="input_item"><input type="email" name="email" id="email" placeholder="Please input correct email" class="login_input user_icon"required="required"></div></li>
			<li><span class="reg_item"><i>*</i>Birth：</span><div class="input_item"><input type="text" name="birth" placeholder="Please input birth" class="login_input user_icon"required="required"></div></li>
			<li><span class="reg_item"><i>*</i>Gender：</span><div class="input_item">
			<input type="radio"  name="gender" value="male"> male
			<input type="radio"  checked="checked" name="gender" value="female" > female
			
			</div></li>

            <li><span class="reg_item"><i>*</i>Address：</span><div class="input_item"><input type="text" name="address" placeholder="Please input address" class="login_input user_icon"required="required"></div></li>

			<li><span class="reg_item">&nbsp;</span><button onclick="check();" style="border:none;width:180px;height:40px;outline:none;"><img src="images/reg2.jpg" alt="" /></button></li>
		</ul>
		</form>
	</div>
</div>


</body>
</html>
