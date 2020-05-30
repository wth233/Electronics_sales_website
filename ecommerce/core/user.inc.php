<?php 
function reg(){
	$arr=$_POST;
	//$arr['password']=$_POST['password'];
	//$arr['regTime']=time();
	//$uploadFile=uploadFile();
	
	//print_r($uploadFile);
	/*if($uploadFile&&is_array($uploadFile)){
		$arr['face']=$uploadFile[0]['name'];
	}else{
		return "注册失败";
	}*/
//	print_r($arr);exit;

    $a = array_slice($arr,0,6,true);
    $b = array_slice($arr,6,1,true);

	
	if(insert("customer", $a)){
		$sql = "select id as customer_id from customer where account='{$arr['account']}'";
		$row = fetchOne($sql);
		if (insert("cart", $row)&&insert("address",$b)) {
            $sql = "select id as address_id from address where address='{$arr['address']}'";
            $row2 = fetchOne($sql);

            $tmp['address_id'] = $row2['address_id'];
            $tmp['customer_id'] = $row['customer_id'];

            insert("customer_address",$tmp);
            $mes="Sign up Successfully!<br/>Jump to the landing page after 3 seconds!<meta http-equiv='refresh' content='3;url=login.php'/>";


		}else{
			$mes="Sign up Failed!222<br/><a href='reg.php'>register again</a>|<a href='index.php'>Home page</a>";
		}
		
	}else{
// 		$filename="uploads/".$uploadFile[0]['name'];
// 		if(file_exists($filename)){
// 			unlink($filename);
// 		}
		$mes="Sign up Failed!333<br/><a href='reg.php'>register again</a>|<a href='index.php'>Home page</a>";
	}
	
	
	
	return $mes;
}
function login(){
    $account=$_POST['account'];
	//addslashes():使用反斜线引用特殊字符
	//$username=addslashes($username);
	//$username=mysqli_escape_string($username);
	$password=$_POST['password'];
    $sql="select * from customer where account='{$account}' and password='{$password}'";
    //echo $sql;
	//$resNum=getResultNum($sql);
	$row=fetchOne($sql);
	//echo $resNum;
	if($row){
		$_SESSION['loginFlag']=$row['id'];
		$_SESSION['account']=$row['account'];
		$mes="Login Successfully！<br/>Jump to the home page after 3 seconds<meta http-equiv='refresh' content='3;url=index.php'/>";
	}else{
		$mes="Login Failed！<a href='login.php'>Login again</a>";
	}
	return $mes;
}

function userOut(){
	$_SESSION=array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),"",time()-1);
	}

	session_destroy();
	header("location:index.php");
}


