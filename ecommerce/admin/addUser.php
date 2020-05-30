<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<h3>Add user</h3>
<form action="doAdminAction.php?act=addUser" method="post" enctype="multipart/form-data">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">account</td>
		<td><input type="text" name="account" placeholder="Please input account"/></td>
	</tr>
	<tr>
		<td align="right">password</td>
		<td><input type="text" name="password" /></td>
	</tr>
	<tr>
		<td align="right">name</td>
		<td><input type="text" name="name" /></td>
	</tr>
	<tr>
		<td align="right">gender</td>
		<td><input type="text" name="gender" /></td>
	</tr>
	<tr>
		<td align="right">is_vip</td>
		<td><input type="text" name="is_vip" /></td>
	</tr>
	<tr>
		<td align="right">birth</td>
		<td><input type="text" name="birth" /></td>
	</tr>
	<tr>
		<td align="right">email</td>
		<td><input type="text" name="email" /></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="submit"/></td>
	</tr>

</table>
</form>
</body>
</html>