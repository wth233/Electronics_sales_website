<?php 
require_once '../include.php';
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
$sql="select * from category";
$totalRows=getResultNum($sql);
$pageSize=15;
$totalPage=ceil($totalRows/$pageSize);
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>=$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select id,categories from category  order by id asc limit {$offset},{$pageSize}";
$rows=fetchAll($sql);
if(!$rows){
	alertMes("Sorry, no category, please add!","addCate.php");
	exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>
<body>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="Add Category" class="add"  onclick="addCate()">
                        </div>
                            
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="15%">ID</th>
                                <th width="25%">Category</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                                <td><?php echo $row['categories'];?></td>
                                <td align="center"><input type="button" value="Edit" class="btn" onclick="editCate(<?php echo $row['id'];?>)"><input type="button" value="Delete" class="btn"  onclick="delCate(<?php echo $row['id'];?>)"></td>
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
<script type="text/javascript">
	function editCate(id){
		window.location="editCate.php?id="+id;
	}
	function delCate(id){
		if(window.confirm("Are you sure you want to delete it?")){
			window.location="doAdminAction.php?act=delCate&id="+id;
		}
	}
	function addCate(){
		window.location="addCate.php";
	}
</script>
</body>
</html>