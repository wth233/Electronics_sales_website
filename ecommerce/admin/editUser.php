<?php 
require_once '../include.php';
$id=$_REQUEST['id'];
$sql="select id,account,password, name, gender, is_vip, birth, email from customer where id='{$id}'";
$row=fetchOne($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<h3>Edit User</h3>
<form action="doAdminAction.php?act=editUser&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">account</td>
		<td><input type="text" name="account" value="<?php echo $row['account'];?>"/></td>
	</tr>
	<tr>
		<td align="right">password</td>
		<td><input type="password" name="password" value="<?php echo $row['password'];?>"/></td>
	</tr>
	<tr>
		<td align="right">name</td>
		<td><input type="text" name="name" value="<?php echo $row['name'];?>"/></td>
	</tr>
	<tr>
		<td align="right">gender</td>
		<td><input type="text" name="gender" value="<?php echo $row['gender'];?>"/></td>
	</tr>
	<tr>
		<td align="right">is_vip</td>
		<td><input type="text" name="is_vip" value="<?php echo $row['is_vip'];?>"/></td>
	</tr>
	<tr>
		<td align="right">birth</td>
		<td><input type="text" name="birth" value="<?php echo $row['birth'];?>"/></td>
	</tr>
	<tr>
		<td align="right">email</td>
		<td><input type="text" name="email" value="<?php echo $row['email'];?>"/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="submit"/></td>
	</tr>

</table>
</form>
</body>
</html>