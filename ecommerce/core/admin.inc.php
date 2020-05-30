<?php 
//require_once '../lib/mysql.func.php';
//require_once '../include';
/**
 * 检查管理员是否存在
 * @param unknown_type $sql
 * @return Ambigous <multitype:, multitype:>
 */
function checkAdmin($sql){
	return fetchOne($sql);
}
/**
 * 检测是否有管理员登陆.
 */
function checkLogined(){
	if($_SESSION['adminName']==""&&$_COOKIE['adminName']==""){
		alertMes("Log in first, please","login.php");
	}
}
/**
 * 添加管理员
 * @return string
 */
function addAdmin(){
	$arr=$_POST;
	if(insert("administrator",$arr)+1){
		$mes="Add Sucessfully!!<br/><a href='addAdmin.php'>Continue to add</a>|<a href='listAdmin.php'>Check</a>";
	}
	else{
		$mes="Add Failed!<br/><a href='addAdmin.php'>Add again</a>";
	}
	return $mes;
}

/**
 * 得到所有的管理员
 * @return array
 */
function getAllAdmin(){
	
	$sql="select account,name,email from administrator ";
	$rows=fetchAll($sql);
	return $rows;
}
function getAdminByPage($page,$pageSize=2){
	$sql="select * from administrator";
	global $totalRows;
	$totalRows=getResultNum($sql);
	global $totalPage;
	$totalPage=ceil($totalRows/$pageSize);
	if($page<1||$page==null||!is_numeric($page)){
		$page=1;
	}
	if($page>=$totalPage)$page=$totalPage;
	$offset=($page-1)*$pageSize;
	$sql="select id,account,name,email from administrator limit {$offset},{$pageSize}";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * 编辑管理员
 * @param int $id
 * @return string
 */
function editAdmin($id){
	$arr=$_POST;
	//$arr['password']=$_POST['password'];
	if(update("administrator", $arr,"id={$id}")){
		$mes="Edit Sucessfully!<br/><a href='listAdmin.php'>Check Admin List</a>";
	}else{
		$mes="No change<br/><a href='listAdmin.php'>Edit again</a>";
	}
	return $mes;
}

/**
 * 删除管理员的操作
 * @param int $id
 * @return string
 */
function delAdmin($id){
	if(delete("administrator","id={$id}")){
		$mes="Delete Sucessfully!<br/><a href='listAdmin.php'>Check Admin List</a>";
	}else{
		$mes="Delete Failed!<br/><a href='listAdmin.php'>Delete again</a>";
	}
	return $mes;
}

/**
 * 注销管理员
 */
function logout(){
	$_SESSION=array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),"",time()-1);
	}
	if(isset($_COOKIE['adminId'])){
		setcookie("adminId","",time()-1);
	}
	if(isset($_COOKIE['adminName'])){
		setcookie("adminName","",time()-1);
	}
	session_destroy();
	header("location:login.php");
}
/**
 * 添加用户的操作
 * @param int $id
 * @return string
 */
function addUser(){
	$arr=$_POST;
	//$arr['password']=$_POST['password'];
	//$arr['regTime']=time();
	//$uploadFile=uploadFile("../uploads");
// 	if($uploadFile&&is_array($uploadFile)){
// 		$arr['face']=$uploadFile[0]['name'];
// 	}else{
// 		return "添加失败<a href='addUser.php'>重新添加</a>";
// 	}
	if(insert("customer", $arr)){
		$mes="Add successfully!<br/><a href='addUser.php'>Continue to add</a>|<a href='listUser.php'>Check</a>";
	}else{
// 		$filename="../uploads/".$uploadFile[0]['name'];
// 		if(file_exists($filename)){
// 			unlink($filename);
		//}
		$mes="Add Failed!<br/><a href='arrUser.php'>Add again</a>|<a href='listUser.php'>Check</a>";
	}
	return $mes;
}
/**
 * 删除用户的操作
 * @param int $id
 * @return string
 */
function delUser($id){
	//$sql="select face from imooc_user where id=".$id;
	//$row=fetchOne($sql);
// 	$face=$row['face'];
// 	if(file_exists("../uploads/".$face)){
// 		unlink("../uploads/".$face);
// 	}
	if(delete("customer","id={$id}")){
		$mes="Delete successfully!<br/><a href='listUser.php'>Check</a>";
	}else{
		$mes="Delete Failed!<br/><a href='listUser.php'>Delete again</a>";
	}
	return $mes;
}
/**
 * 编辑用户的操作
 * @param int $id
 * @return string
 */
function editUser($id){
	$arr=$_POST;
	//$arr['password']=$_POST['password'];
	if(update("customer", $arr,"id={$id}")){
		$mes="Edit successfully!<br/><a href='listUser.php'>Check</a>";
	}else{
		$mes="No change<br/><a href='listUser.php'>Edit again</a>";
	}
	return $mes;
}

function delTran($id){


    $sql1 = "select product_id,count from product_transaction where transaction_id={$id}";
    $rows1 = fetchAll($sql1);

    foreach ($rows1 as $row){
        $sql2 = "select count from inventory where id = {$row['product_id']}";
        $row2 = fetchOne($sql2);
        $tmp_inventory['count'] = $row['count']+$row2['count'];
        update("inventory",$tmp_inventory,"id={$row['product_id']}");


    }

    if(delete("transaction","id={$id}")){
        $mes="Delete successfully!<br/><a href='listTran.php'>Check</a>";
    }else{
        $mes="Delete Failed!<br/><a href='listTran.php'>Delete again</a>";
    }
    return $mes;
}