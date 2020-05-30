<?php 
require_once '../include.php';
$pageSize=6;
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
$rows=getAdminByPage($page,$pageSize);
//$sql="select * from imooc_admin";
//$totalRows=getResultNum($sql);
//$pageSize=2;
//$totalPage=ceil($totalRows/$pageSize);
//$pageSize=2;
//$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
//if($page<1||$page==null||!is_numeric($page)){
//	$page=1;
//}
//if($page>=$totalPage)$page=$totalPage;
//$offset=($page-1)*$pageSize;
//$sql="select id,username,email from imooc_admin limit {$offset},{$pageSize}";
//$rows=fetchAll($sql);

//$rows=getAllAdmin();

if(!$rows){
	alertMes("Sorry, no administrator, please add!","addAdmin.php");
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
                            <input type="button" value="Add admin" class="add"  onclick="addAdmin()">
                        </div>
                            
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="15%">ID</th>
                                <th width="25%">Name</th>
                                <th width="30%">Email</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                               	<td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                       
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td align="center"><input type="button" value="Edit" class="btn" onclick="editAdmin(<?php echo $row['id'];?>)"><input type="button" value="Delete" class="btn"  onclick="delAdmin(<?php echo $row['id'];?>)"></td>
                            </tr>
                            <?php endforeach;?>
                            <?php if($totalRows>$pageSize):?>
                            <tr>
                            	<td colspan="4"><?php echo showPage($page, $totalPage);?></td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
</body>
<script type="text/javascript">

	function addAdmin(){
		window.location="addAdmin.php";	
	}
	function editAdmin(id){
			window.location="editAdmin.php?id="+id;
	}
	function delAdmin(id){
			if(window.confirm("Are you sure that you want to delete it?")){
				window.location="doAdminAction.php?act=delAdmin&id="+id;
			}
	}
</script>
</html>