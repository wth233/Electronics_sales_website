<?php
require_once '../include.php';
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
$sql="select * from transaction";
$totalRows=getResultNum($sql);
$pageSize=15;
$totalPage=ceil($totalRows/$pageSize);
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>=$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
//$sql="select t.id,c.name,a.address,t.total_price from transcation as t join customer as c on t.customer_id =c.id join address as a on t.address_id=a.id  order by t.id asc ";//limit {$offset},{$pageSize}
$sql = "select b.id,a.name,c.address,b.total_price from customer a, transaction b, address c where a.id=b.customer_id and b.address_id = c.id order by b.id asc limit {$offset},{$pageSize}";
//echo $sql;
$rows=fetchAll($sql);
// if(!$rows){
//     alertMes("Sorry, no transaction, please add!");
//     exit;
// }

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
                        
                            
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="15%">ID</th>
                                <th width="10%">Name</th>
                                <th width="10%">Address</th>
                                <th width="10%">Total Price</th>
                          
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['address'];?></td>
                                <td><?php echo $row['total_price'];?></td>
                                <td align="center"><input type="button" value="Cancel" class="btn" onclick="delTran(<?php echo $row['id'];?>)"></td>
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
// 	function editCate(id){
// 		window.location="editCate.php?id="+id;
// 	}
	function delTran(id){
		if(window.confirm("Are you sure you want to delete it?")){
			window.location="doAdminAction.php?act=delTran&id="+id;
		}
	}
// 	function addCate(){
// 		window.location="addCate.php";
// 	}
</script>
</body>
</html>