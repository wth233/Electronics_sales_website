<?php 
require_once '../include.php';
require_once '../lib/image.func.php';
require_once '../core/admin.inc.php';
require_once '../lib/common.func.php';
$account=$_POST['account'];
$account=addslashes($account);
$password=$_POST['password'];
$verify=$_POST['verify'];
$verify1=$_SESSION['verify'];
$autoFlag=$_POST['autoFlag'];
//echo $verify;
//echo $verify1;

if($verify==$verify1){
    $sql="select * from administrator where account='{$account}' and password='{$password}'";
    //echo $sql;
	$row=checkAdmin($sql);
	//$row;
	if($row){
		//如果选了一周内自动登陆
		if($autoFlag){
			setcookie("adminName",$row['name'],time()+7*24*3600);
			setcookie("account",$row['account'],time()+7*24*3600);
		}
		$_SESSION['adminName']=$row['account'];
		$_SESSION['adminId']=$row['id'];
		alertMes("Login Successfully","index.php");
	}else{
		alertMes("Login failed","login.php");
	}
}else{
	alertMes("Verification Code Error","login.php");
}

// $sql="select * from administrator where account='{$account}' and password='{$password}'";
// echo $sql;