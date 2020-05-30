<?php 
require_once '../include.php';
checkLogined();
$order=$_REQUEST['order']?$_REQUEST['order']:null;
$orderBy=$order?"order by p.".$order:null;
$keywords=$_REQUEST['keywords']?$_REQUEST['keywords']:null;
$where=$keywords?"where p.name like '%{$keywords}%'":null;
//得到数据库中所有商品
$sql="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight,p.date,p.description,c.categories,i.count from product as p join category as c on p.categories=c.id join inventory as i on p.id=i.id {$where}  ";
$totalRows=getResultNum($sql);
$pageSize=10;
$totalPage=ceil($totalRows/$pageSize);
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight,p.date,p.description,c.categories,i.count from product as p join category as c on p.categories=c.id join inventory as i on p.id=i.id {$where} {$orderBy} limit {$offset},{$pageSize}";
$rows=fetchAll($sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
<link rel="stylesheet" href="scripts/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<script src="scripts/jquery-ui/js/jquery-1.10.2.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
</head>

<body>
<div id="showDetail"  style="display:none;">

</div>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="Add product" class="add" onclick="addPro()">
                        </div>
                        <div class="fr">
                            <div class="text">
                                <span>Product Price：</span>
                                <div class="bui_select">
                                    <select id="" class="select" onchange="change(this.value)">
                                    	<option>-Choose-</option>
                                        <option value="price asc" >Low to high</option>
                                        <option value="price desc">high to low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>Date：</span>
                                <div class="bui_select">
                                 <select id="" class="select" onchange="change(this.value)">
                                 	<option>-Choose-</option>
                                        <option value="date desc" >New</option>
                                        <option value="date asc">Old</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>Search</span>
                                <input type="text" value="" class="search"  id="search" onkeypress="search()" >
                            </div>
                        </div>
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="2%">ID</th>
                                <th width="10%">name</th>
                                <th width="5%">price</th>
                                <th width="5%">brand</th>
                                <th width="10%">image</th>
                                <th width="5%">weight</th>
                                <th width="5%">date</th>
                                <th width="18%">description</th>
                                <th width="5%">category</th>
                                <th width="5%">count</th>
                                <th width="5%">Operation</th>
                            </tr>
                        </thead>
                        <?php if ($rows):  ?>
                        <tbody>
                        <?php foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><input type="checkbox" id="c<?php echo $row['id'];?>" class="check" value=<?php echo $row['id'];?>><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['price'];?></td>
                                <td><?php echo $row['brand'];?></td>
                                
                                <td><a href="<?php echo $row['imageURLs'];?>"><button class="btn btn-default btn-xs">See Image</button></a></td>
                                
                                <td><?php echo $row['weight'];?></td>
                                <td><?php echo $row['date'];?></td>
                                <td><?php echo $row['description'];?></td> 
                                <td><?php echo $row['categories'];?></td> 
                                <td><?php echo $row['count'];?></td> 
                                <td align="center">
                                				<input type="button" value="Edit" class="btn" onclick="editPro(<?php echo $row['id'];?>)">
                                				<input type="button" value="Delete" class="btn"onclick="delPro(<?php echo $row['id'];?>)">
					                            <div id="showDetail<?php echo $row['id'];?>" style="display:none;">
					                        	
					                
					                        </div>
                                
                                </td> 
                            </tr>
                           <?php  endforeach;?>
                           <?php if($totalRows>$pageSize):?>
                            <tr>
                            	<td colspan="7"><?php echo showPage($page, $totalPage,"keywords={$keywords}&order={$order}");?></td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                         <?php endif;?>
                    </table>
                </div>
<script type="text/javascript">
function showDetail(id,t){
	$("#showDetail"+id).dialog({
		  height:"auto",
	      width: "auto",
	      position: {my: "center", at: "center",  collision:"fit"},
	      modal:false,//是否模式对话框
	      draggable:true,//是否允许拖拽
	      resizable:true,//是否允许拖动
	      title:"商品名称："+t,//对话框标题
	      show:"slide",
	      hide:"explode"
	});
}
	function addPro(){
		window.location='addPro.php';
	}
	function editPro(id){
		window.location='editPro.php?id='+id;
	}
	function delPro(id){
		if(window.confirm("Are you sure?")){
			window.location="doAdminAction.php?act=delPro&id="+id;
		}
	}
	function search(){
		if(event.keyCode==13){
			var val=document.getElementById("search").value;
			window.location="listPro.php?keywords="+val;
		}
	}
	function change(val){
		window.location="listPro.php?order="+val;
	}
</script>
</body>
</html>