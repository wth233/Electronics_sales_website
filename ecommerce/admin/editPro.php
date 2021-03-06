<?php 
require_once '../include.php';
checkLogined();
$rows=getAllCate();
if(!$rows){
	alertMes("No category, please add category first!!", "addCate.php");
}
$id=$_REQUEST['id'];
$proInfo=getProById($id);
//print_r($proInfo);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/kindeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./scripts/jquery-1.6.4.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
        $(document).ready(function(){
        	$("#selectFileBtn").click(function(){
        		$fileField = $('<input type="file" name="thumbs[]"/>');
        		$fileField.hide();
        		$("#attachList").append($fileField);
        		$fileField.trigger("click");
        		$fileField.change(function(){
        		$path = $(this).val();
        		$filename = $path.substring($path.lastIndexOf("\\")+1);
        		$attachItem = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="#" title="删除附件">删除</a></div></div>');
        		$attachItem.find(".left").html($filename);
        		$("#attachList").append($attachItem);		
        		});
        	});
        	$("#attachList>.attachItem").find('a').live('click',function(obj,i){
        		$(this).parents('.attachItem').prev('input').remove();
        		$(this).parents('.attachItem').remove();
        	});
        });
</script>
</head>
<body>
<h3>Edit Product</h3>
<form action="doAdminAction.php?act=editPro&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">Product Name</td>
		<td><input type="text" name="name"  value="<?php echo $proInfo['name'];?>"/></td>
	</tr>
	<tr>
		<td align="right">Product Category</td>
		<td>
		<select name="categories">
			<?php foreach($rows as $row){
			    if ($row['categories']==$proInfo['categories']){
                    echo "<option selected=\"selected\" value=\"{$row['id']}\">{$row['categories']}</option>";
                }else{
                    echo "<option value=\"{$row['id']}\">{$row['categories']}</option>";
                }


			}


            ?>
		</select>
		</td>
	</tr>
	<tr>
		<td align="right">price</td>
		<td><input type="text" name="price"  value="<?php echo $proInfo['price'];?>"/></td>
	</tr>
	<tr>
		<td align="right">brand</td>
		<td><input type="text" name="brand"  value="<?php echo $proInfo['brand'];?>"/></td>
	</tr>
	<tr>
		<td align="right">Image</td>
		<td><input type="text" name="imageURLs"  value="<?php echo $proInfo['imageURLs'];?>"/></td>
	</tr>
	<tr>
		<td align="right">weight</td>
		<td><input type="text" name="weight"  value="<?php echo $proInfo['weight'];?>"/></td>
	</tr>
	<tr>
		<td align="right">date</td>
		<td><input type="text" name="date"  value="<?php echo $proInfo['date'];?>"/></td>
	</tr>
	
	<tr>
		<td align="right">description</td>
		<td>
			<textarea name="description" id="editor_id" style="width:100%;height:150px;"><?php echo $proInfo['description'];?></textarea>
		</td>
	</tr>
	<tr>
		<td align="count">inventory</td>
		<td><input type="text" name="count"  value="<?php echo $proInfo['count'];?>"/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="submit"/></td>
	</tr>
</table>
</form>
</body>
</html>