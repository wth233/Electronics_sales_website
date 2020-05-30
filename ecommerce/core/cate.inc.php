<?php 
/**
 * 添加分类的操作
 * @return string
 */
function addCate(){
	$arr=$_POST;
	if(insert("category",$arr)){
		$mes="Add Sucessfully!<br/><a href='addCate.php'>Continue to add</a>|<a href='listCate.php'>Check</a>";
	}else{
		$mes="Add Failed！<br/><a href='addCate.php'>Add again</a>|<a href='listCate.php'>Check</a>";
	}
	return $mes;
}

/**
 * 根据ID得到指定分类信息
 * @param int $id
 * @return array
 */
function getCateById($id){
	$sql="select id,categories from category where id={$id}";
	return fetchOne($sql);
}

/**
 * 修改分类的操作
 * @param string $where
 * @return string
 */
function editCate($where){
	$arr=$_POST;
	if(update("category", $arr,$where)){
		$mes="Edit Sucessfully!<br/><a href='listCate.php'>Check</a>";
	}else{
		$mes="No change<br/><a href='listCate.php'>Edit again</a>";
	}
	return $mes;
}

/**
 *删除分类
 * @param string $where
 * @return string
 */
function delCate($id){
	$res=checkProExist($id);
	if(!$res){
		$where="id=".$id;
		if(delete("category",$where)){
			$mes="Delete Sucessfully!<br/><a href='listCate.php'>Check</a>|<a href='addCate.php'>Add Category</a>";
		}else{
			$mes="Delete Failed！<br/><a href='listCate.php'>Delete again</a>";
		}
		return $mes;
	}else{
		alertMes("Cannot delete category, please delete the item under this category first", "listPro.php");
	}
}

/**
 * 得到所有分类
 * @return array
 */
function getAllCate(){
	$sql="select id,categories from category";
	$rows=fetchAll($sql);
	return $rows;
}



