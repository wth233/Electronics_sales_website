<?php 
require_once '../include.php';
$id=$_REQUEST['id'];
$sql="select account,name,email,password from administrator where id='{$id}'";
$row=fetchOne($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<h3>Edit Admin</h3>
<form action="doAdminAction.php?act=editAdmin&id=<?php echo $id;?>" method="post">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">Admin account</td>
		<td><input type="text" name="account" value="<?php echo $row['account'];?>"/></td>
	</tr>
	<tr>
		<td align="right">Admin Name</td>
		<td><input type="text" name="name" value="<?php echo $row['name'];?>"/></td>
	</tr>
	<tr>
		<td align="right">Admin password</td>
		<td><input type="password" name="password"  value="<?php echo $row['password'];?>"/></td>
	</tr>
	<tr>
		<td align="right">Admin email</td>
		<td><input type="text" name="email" value="<?php echo $row['email'];?>"/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="Edit Admin"/></td>
	</tr>

</table>
</form>
</body>
</html>