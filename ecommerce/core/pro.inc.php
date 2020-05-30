<?php 
/**
 * 添加商品
 * @return string
 */
function addPro(){
	$arr=$_POST;
	//$arr['pubTime']=time();
// 	$path="./uploads";
// 	$uploadFiles=uploadFile($path);
// 	if(is_array($uploadFiles)&&$uploadFiles){
// 		foreach($uploadFiles as $key=>$uploadFile){
// 			thumb($path."/".$uploadFile['name'],"../image_50/".$uploadFile['name'],50,50);
// 			thumb($path."/".$uploadFile['name'],"../image_220/".$uploadFile['name'],220,220);
// 			thumb($path."/".$uploadFile['name'],"../image_350/".$uploadFile['name'],350,350);
// 			thumb($path."/".$uploadFile['name'],"../image_800/".$uploadFile['name'],800,800);
// 		}
// 	}
	$a=array_slice($arr,0,8,ture);
	$b=array_slice($arr,8,1,ture);
	//print_r($a);
	//print_r($b);
	
	
	$res=insert("product",$a);
	$res1=insert("inventory",$b);
	if($res&$res1)
	{
	    $mes="<p>Add Sucessfully!</p><a href='addPro.php' target='mainFrame'>Continue to add</a>|<a href='listPro.php' target='mainFrame'>Check List</a>";
	}
	else{
	    $mes="<p>Add Failed!</p><a href='addPro.php' target='mainFrame'>Add again</a>";
	}
	$pid=getInsertId();
// 	if($res&&$pid){
// 		foreach($uploadFiles as $uploadFile){
// 			$arr1['pid']=$pid;
// 			$arr1['albumPath']=$uploadFile['name'];
// 			addAlbum($arr1);
// 		}
// 		$mes="<p>添加成功!</p><a href='addPro.php' target='mainFrame'>继续添加</a>|<a href='listPro.php' target='mainFrame'>查看商品列表</a>";
// 	}else{
// 		foreach($uploadFiles as $uploadFile){
// 			if(file_exists("../image_800/".$uploadFile['name'])){
// 				unlink("../image_800/".$uploadFile['name']);
// 			}
// 			if(file_exists("../image_50/".$uploadFile['name'])){
// 				unlink("../image_50/".$uploadFile['name']);
// 			}
// 			if(file_exists("../image_220/".$uploadFile['name'])){
// 				unlink("../image_220/".$uploadFile['name']);
// 			}
// 			if(file_exists("../image_350/".$uploadFile['name'])){
// 				unlink("../image_350/".$uploadFile['name']);
// 			}
// 		}
// 		$mes="<p>添加失败!</p><a href='addPro.php' target='mainFrame'>重新添加</a>";
		
// 	}
 	return $mes;
}
/**
 *编辑商品
 * @param int $id
 * @return string
 */
function editPro($id){
	$arr=$_POST;
// 	$path="./uploads";
// 	$uploadFiles=uploadFile($path);
// 	if(is_array($uploadFiles)&&$uploadFiles){
// 		foreach($uploadFiles as $key=>$uploadFile){
// 			thumb($path."/".$uploadFile['name'],"../image_50/".$uploadFile['name'],50,50);
// 			thumb($path."/".$uploadFile['name'],"../image_220/".$uploadFile['name'],220,220);
// 			thumb($path."/".$uploadFile['name'],"../image_350/".$uploadFile['name'],350,350);
// 			thumb($path."/".$uploadFile['name'],"../image_800/".$uploadFile['name'],800,800);
// 		}
// 	}
	$where="id={$id}";
	foreach($arr as $key => $v){
	    //echo $v;
	    //echo ' ';
	    $x=$v;
	}
	//print_r($arr);
// 	foreach($arr as $key => $v){
// 	    //echo $v;
// 	    //echo ' ';
// 	    $x=$v;
// 	}
	$a=array_slice($arr,0,8,ture);
	$b=array_slice($arr,8,1,ture);
	//print_r($a);
	//print_r($b);

	$res=update("product",$a,$where);
	$res1=update("inventory",$b,$where);
	//$pid=$id;
	if($res||$res1){
// 		if($uploadFiles &&is_array($uploadFiles)){
// 			foreach($uploadFiles as $uploadFile){
// 				$arr1['pid']=$pid;
// 				$arr1['albumPath']=$uploadFile['name'];
// 				addAlbum($arr1);
// 			}
// 		}
		$mes="<p>Edit Sucessfully!</p><a href='listPro.php' target='mainFrame'>Check</a>";
	}else{
// 	if(is_array($uploadFiles)&&$uploadFiles){
// 		foreach($uploadFiles as $uploadFile){
// 			if(file_exists("../image_800/".$uploadFile['name'])){
// 				unlink("../image_800/".$uploadFile['name']);
// 			}
// 			if(file_exists("../image_50/".$uploadFile['name'])){
// 				unlink("../image_50/".$uploadFile['name']);
// 			}
// 			if(file_exists("../image_220/".$uploadFile['name'])){
// 				unlink("../image_220/".$uploadFile['name']);
// 			}
// 			if(file_exists("../image_350/".$uploadFile['name'])){
// 				unlink("../image_350/".$uploadFile['name']);
// 			}
// 		}
// 	}
		$mes="<p>No change</p><a href='listPro.php' target='mainFrame'>Edit again</a>";
		
	}
	return $mes;
}

function delPro($id){
	$where="id=$id";
	$res=delete("product",$where);
// 	$proImgs=getAllImgByProId($id);
// 	if($proImgs&&is_array($proImgs)){
// 		foreach($proImgs as $proImg){
// 			if(file_exists("uploads/".$proImg['albumPath'])){
// 				unlink("uploads/".$proImg['albumPath']);
// 			}
// 			if(file_exists("../image_50/".$proImg['albumPath'])){
// 				unlink("../image_50/".$proImg['albumPath']);
// 			}
// 			if(file_exists("../image_220/".$proImg['albumPath'])){
// 				unlink("../image_220/".$proImg['albumPath']);
// 			}
// 			if(file_exists("../image_350/".$proImg['albumPath'])){
// 				unlink("../image_350/".$proImg['albumPath']);
// 			}
// 			if(file_exists("../image_800/".$proImg['albumPath'])){
// 				unlink("../image_800/".$proImg['albumPath']);
// 			}
			
// 		}
// 	}
	$where1="pid={$id}";
	//$res1=delete("imooc_album",$where1);
	if($res){
		$mes="Delete Sucessfully!<br/><a href='listPro.php' target='mainFrame'>Check</a>";
	}else{
		$mes="Delete Failed!<br/><a href='listPro.php' target='mainFrame'>Delete again</a>";
	}
	return $mes;
}


/**
 * 得到商品的所有信息
 * @return array
 */
function getAllProByAdmin(){
	$sql="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight,p.date,p.description,c.categories,i.count from product as p join category as c on p.categories=c.id join inventory as i on p.id=i.id";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 *根据商品id得到商品图片
 * @param int $id
 * @return array
 */
// function getAllImgByProId($id){
// 	$sql="select a.albumPath from imooc_album a where pid={$id}";
// 	$rows=fetchAll($sql);
// 	return $rows;
// }

/**
 * 根据id得到商品的详细信息
 * @param int $id
 * @return array
 */
function getProById($id){
		$sql="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight,p.date,p.description,c.categories,i.count from product as p join category as c on p.categories=c.id join inventory as i on p.id=i.id where p.id={$id}";
		$row=fetchOne($sql);
		return $row;
}
/**
 * 检查分类下是否有产品
 * @param int $cid
 * @return array
 */
function checkProExist($cid){
	$sql="select * from product where cId={$cid}";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * 得到所有商品
 * @return array
 */
function getAllPros(){
	$sql="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight,p.date,p.description,c.categories,i.count from product as p join category as c on p.categories=c.id join inventory as i on p.id=i.id ";
	$rows=fetchAll($sql);
	return $rows;
}

function getAllProByCateId($id){
    $sql="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight,p.date,p.description,c.categories,i.count from product as p join category as c on p.categories=c.id join inventory as i on p.id=i.id where c.id={$id}";
    echo $sql;
    $row=fetchOne($sql);
    return $row;
}

/**
 *根据cid得到4条产品
 * @param int $cid
 * @return Array
 */
// function getProsByCid($cid){
// 	$sql="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight,p.date,p.description,c.categories,i.count from product as p join category as c on p.categories=c.id join inventory as i on p.id=i.product_id where p.idd={$cid} limit 4";
// 	$rows=fetchAll($sql);
// 	return $rows;
// }

// /**
//  * 得到下4条产品
//  * @param int $cid
//  * @return array
//  */
// function getSmallProsByCid($cid){
// 	$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from imooc_pro as p join imooc_cate c on p.cId=c.id where p.cId={$cid} limit 4,4";
// 	$rows=fetchAll($sql);
// 	return $rows;
// }

// /**
//  *得到商品ID和商品名称
//  * @return array
//  */
// function getProInfo(){
// 	$sql="select id,pName from imooc_pro order by id asc";
// 	$rows=fetchAll($sql);
// 	return $rows;
// }
