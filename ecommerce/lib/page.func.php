<?php 
//require_once '../include.php';
//$sql="select * from imooc_admin";
//$totalRows=getResultNum($sql);
////echo $totalRows;
//$pageSize=2;
////得到总页码数
//$totalPage=ceil($totalRows/$pageSize);
//$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
//if($page<1||$page==null||!is_numeric($page)){
//	$page=1;
//}
//if($page>=$totalPage)$page=$totalPage;
//$offset=($page-1)*$pageSize;
//$sql="select * from imooc_admin limit {$offset},{$pageSize}";
////echo $sql;
//$rows=fetchAll($sql);
////print_r($rows);
//foreach($rows as $row){
//	echo "编号：".$row['id'],"<br/>";
//	echo "管理员的名称:".$row['username'],"<hr/>";
//}
//echo showPage($page,$totalPage);
//echo "<hr/>";
//echo showPage($page,$totalPage,"cid=5&pid=6");
function showPage($page,$totalPage,$where=null,$sep="&nbsp;"){
	$where=($where==null)?null:"&".$where;
	$url = $_SERVER ['PHP_SELF'];
	$index = ($page == 1) ? "Home Page" : "<a href='{$url}?page=1{$where}'>Home Page</a>";
	$last = ($page == $totalPage) ? "Last Page" : "<a href='{$url}?page={$totalPage}{$where}'>Last Page</a>";
	$prevPage=($page>=1)?$page-1:1;
	$nextPage=($page>=$totalPage)?$totalPage:$page+1;
	$prev = ($page == 1) ? "Previous" : "<a href='{$url}?page={$prevPage}{$where}'>Previous</a>";
	$next = ($page == $totalPage) ? "Next" : "<a href='{$url}?page={$nextPage}{$where}'>Next</a>";
	$str = "Total {$totalPage} Page/No.{$page} Page";
	for($i = 1; $i <= $totalPage; $i ++) {
		//当前页无连接
		if ($page == $i) {
			$p .= "[{$i}]";
		} else {
			$p .= "<a href='{$url}?page={$i}{$where}'>[{$i}]</a>";
		}
	}
 	$pageStr=$str.$sep . $index .$sep. $prev.$sep . $p.$sep . $next.$sep . $last;
 	return $pageStr;
}


