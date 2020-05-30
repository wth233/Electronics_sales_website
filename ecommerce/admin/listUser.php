<?php 
require_once '../include.php';
checkLogined();
$sql="select id,account,password, name, gender, is_vip, birth, email from customer";
$rows=fetchAll($sql);
if(!$rows){
	alertMes("Sorry, no users, please add!","addUser.php");
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="Add user" class="add"  onclick="addUser()">
                        </div>
                            
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="15%">ID</th>
                                <th width="20%">account</th>
                                <th width="20%">password</th>
                                <th width="20%">name</th>
                                <th width="20%">gender</th>
                                <th width="20%">is_vip</th>
                                <th width="20%">birth</th>
                                <th width="20%">email</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                                <td><?php echo $row['account'];?></td>
                                <td><?php echo $row['password'];?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['gender'];?></td>
                                <td><?php echo $row['is_vip'];?></td>
                                 <td><?php echo $row['birth'];?></td>
                                <td><?php echo $row['email'];?></td>
                               
                                
                                <td align="center"><input type="button" value="Edit" class="btn" onclick="editUser(<?php echo $row['id'];?>)"><input type="button" value="Delete" class="btn"  onclick="delUser(<?php echo $row['id'];?>)"></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
</body>
<script type="text/javascript">

	function addUser(){
		window.location="addUser.php";	
	}
	function editUser(id){
			window.location="editUser.php?id="+id;
	}
	function delUser(id){
			if(window.confirm("Are you sure?")){
				window.location="doAdminAction.php?act=delUser&id="+id;
			}
	}
</script>
</html>