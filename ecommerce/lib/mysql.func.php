<?php 
/**
 * 连接数据库
 * @return resource
 */
function connect(){
    
    $link=mysqli_connect("localhost","root","mysql") or die("数据库连接失败Error:".mysqli_errno().":".mysqli_error());
    //mysqli_set_charset("utf8");
    mysqli_select_db($link,"ecommerce") or die("指定数据库打开失败");
	return $link;
   /* $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_DBNAME);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    return $conn;*/
}
//connect();
/**
 * 完成记录插入的操作
 * @param string $table
 * @param array $array
 * @return number
 */
function insert($table,$array){
    $link=mysqli_connect("localhost","root","mysql");
    mysqli_select_db($link,"ecommerce");
    $keys=join(",",array_keys($array));
    $vals="'".join("','",array_values($array))."'";
    $sql="insert {$table}($keys) values({$vals})";
    //echo $sql;
    $result=mysqli_query($link,$sql);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    return mysqli_insert_id($link);
}
//update imooc_admin set username='king' where id=1
/**
 * 记录的更新操作
 * @param string $table
 * @param array $array
 * @param string $where
 * @return number
 */
function update($table,$array,$where=null){
    $link=mysqli_connect("localhost","root","mysql");
    mysqli_select_db($link,"ecommerce");
    $str='';
    //echo $array;
//     foreach($array as $k => $v){
//         echo $v;
//         echo ' ';
//     }
	foreach($array as $key=>$val){
	    
		if($str==null){
			$sep="";
		}else{
			$sep=",";
		}
		$str.=$sep.$key."='".$val."'";
	}
		$sql="update {$table} set {$str} ".($where==null?null:" where ".$where);
		//echo $sql;
		$result=mysqli_query($link,$sql);
		//var_dump($result);
		//var_dump(mysql_affected_rows());exit;
		if($result){
		    return mysqli_affected_rows($link);
		}else{
			return false;
		}
}

/**
 *	删除记录
 * @param string $table
 * @param string $where
 * @return number
 */
function delete($table,$where=null){
    $link=mysqli_connect("localhost","root","mysql");
    mysqli_select_db($link,"ecommerce");
	$where=$where==null?null:" where ".$where;
    $sql="delete from {$table} {$where}";
	mysqli_query($link,$sql);
	return mysqli_affected_rows($link);
}

/**
 *得到指定一条记录
 * @param string $sql
 * @param string $result_type
 * @return multitype:
 */
function fetchOne($sql){
    $link=mysqli_connect("localhost","root","mysql");
    mysqli_select_db($link,"ecommerce");
	$result=mysqli_query($link,$sql);
	if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        printf("!!!!!!");
	    exit();
	}
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	return $row;
}


/**
 * 得到结果集中所有记录 ...
 * @param string $sql
 * @param string $result_type
 * @return multitype:
 */
function fetchAll($sql,$result_type=MYSQLI_ASSOC){
    $link=mysqli_connect("localhost","root","mysql");
    mysqli_select_db($link,"ecommerce");
    $result=mysqli_query($link,$sql);
	while(@$row=mysqli_fetch_array($result,$result_type)){
		$rows[]=$row;
	}
	return $rows;
}

/**
 * 得到结果集中的记录条数
 * @param unknown_type $sql
 * @return number
 */
function getResultNum($sql){
    $link=mysqli_connect("localhost","root","mysql");
    mysqli_select_db($link,"ecommerce");
    $result=mysqli_query($link,$sql);
	return mysqli_num_rows($result);
}

/**
 * 得到上一步插入记录的ID号
 * @return number
 */
function getInsertId(){
    $link=mysqli_connect("localhost","root","mysql");
    mysqli_select_db($link,"ecommerce");
    //$result=mysqli_query($link,$sql);
    return mysqli_insert_id($link);
}
function execute($sql){
    $link=mysqli_connect("localhost","root","mysql");
    mysqli_select_db($link,"ecommerce");
    $result=mysqli_query($link,$sql);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        printf("????????");
        exit();
    }
}




