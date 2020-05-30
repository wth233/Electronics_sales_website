<?php 
require_once 'include.php';
$cates=getAllcate();
header("content-type:text/html;charset=utf-8");
//checkLogined();
$order=$_REQUEST['order']?$_REQUEST['order']:null;
$orderBy=$order?"order by p.".$order:null;
$keywords=$_REQUEST['keywords']?$_REQUEST['keywords']:null;
$where=$keywords?"where p.name like '%{$keywords}%'":null;
if ($_GET['status']==null&&$_GET['search_name']==null) {
    //得到数据库中所有商品
    $sql="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight,p.date,p.description,c.categories,i.count from product as p join category as c on p.categories=c.id join inventory as i on p.id=i.id {$where}  ";
    $totalRows=getResultNum($sql);
    $pageSize=100;
    $totalPage=ceil($totalRows/$pageSize);
    $page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
    if($page<1||$page==null||!is_numeric($page))$page=1;
    if($page>$totalPage)$page=$totalPage;
    $offset=($page-1)*$pageSize;
    $sql="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight,p.date,p.description,c.categories,i.count from product as p join category as c on p.categories=c.id join inventory as i on p.id=i.id {$where} {$orderBy} limit {$offset},{$pageSize}";
    $rows=fetchAll($sql);
    
    
}else if ($_GET['search_name']==null){
    $sql="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight,p.date,p.description,c.categories,i.count from product as p join category as c on p.categories=c.id join inventory as i on p.id=i.id where c.id={$_GET['tmp_id']}";
    $totalRows=getResultNum($sql);
    $pageSize=30;
    $totalPage=ceil($totalRows/$pageSize);
    $page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
    if($page<1||$page==null||!is_numeric($page))$page=1;
    if($page>$totalPage)$page=$totalPage;
    $offset=($page-1)*$pageSize;
    $sql="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight,p.date,p.description,c.categories,i.count from product as p join category as c on p.categories=c.id join inventory as i on c.id={$_GET['tmp_id']} {$orderBy} limit {$offset},{$pageSize}";
    $rows=fetchAll($sql);

}else {
    $sql="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight,p.date,p.description,c.categories,i.count from product as p join category as c on p.categories=c.id join inventory as i on p.id=i.id where p.name like '%{$_GET['search_name']}%'";
    $totalRows=getResultNum($sql);
    $pageSize=30;
    $totalPage=ceil($totalRows/$pageSize);
    $page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
    if($page<1||$page==null||!is_numeric($page))$page=1;
    if($page>$totalPage)$page=$totalPage;
    $offset=($page-1)*$pageSize;
    $sql="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight,p.date,p.description,c.categories,i.count from product as p join category as c on p.categories=c.id join inventory as i on p.name like '%{$_GET['search_name']}%' {$orderBy} limit {$offset},{$pageSize}";
    $rows=fetchAll($sql);
}

if($_GET['product_id']!=null&&$_SESSION['loginFlag']!=null){
    $proId=$_GET['product_id'];
    $sql1="select cart_id from cart where customer_id={$_GET['id']}";
    $cart_id1=fetchOne($sql1);
    $cart_id=$cart_id1['cart_id'];
    //echo $cart_id;
    $sql2="select count from product_cart where cart_id ={$cart_id} and product_id={$proId}";
    $count1=fetchAll($sql2);
    echo $count1[0]['count'];
    if($count1[0]['count']){
        $sql4="update product_cart set count=({$count1[0]['count']}+1) where cart_id={$cart_id} and product_id={$proId}";
        execute($sql4);
    }else{
        $sql3="INSERT INTO product_cart(product_id,cart_id,count) values ({$proId}, {$cart_id}, 1)";
        execute($sql3);
    }
}

function showPage1($page,$totalPage,$where=null,$sep="&nbsp;")
{

    $qs = $_SERVER['QUERY_STRING'];
    $p=null;
    if ($qs==null){
        $where = ($where == null) ? null : "&" . $where;
        $url = $_SERVER ['PHP_SELF'];
        $index = ($page == 1) ? "Home Page" : "<a href='{$url}?page=1{$where}'>Home Page</a>";
        $last = ($page == $totalPage) ? "Last Page" : "<a href='{$url}?page={$totalPage}{$where}'>Last Page</a>";
        $prevPage = ($page >= 1) ? $page - 1 : 1;
        $nextPage = ($page >= $totalPage) ? $totalPage : $page + 1;
        $prev = ($page == 1) ? "Previous" : "<a href='{$url}?page={$prevPage}{$where}'>Previous</a>";
        $next = ($page == $totalPage) ? "Next" : "<a href='{$url}?page={$nextPage}{$where}'>Next</a>";
        $str = "Total {$totalPage} Page/No.{$page} Page";
        for ($i = 1; $i <= $totalPage; $i++) {
            //当前页无连接
            if ($page == $i) {
                $p .= "[{$i}]";
            } else {
                $p .= "<a href='{$url}?page={$i}{$where}'>[{$i}]</a>";
            }
        }
        $pageStr = $str . $sep . $index . $sep . $prev . $sep . $p . $sep . $next . $sep . $last;

    }else{

        $where = ($where == null) ? null : "&" . $where;

        $url = $_SERVER ['PHP_SELF']."?".$qs;
        $index = ($page == 1) ? "Home Page" : "<a href='{$url}&page=1{$where}'>Home Page</a>";
        $last = ($page == $totalPage) ? "Last Page" : "<a href='{$url}&page={$totalPage}{$where}'>Last Page</a>";
        $prevPage = ($page >= 1) ? $page - 1 : 1;
        $nextPage = ($page >= $totalPage) ? $totalPage : $page + 1;
        $prev = ($page == 1) ? "Previous" : "<a href='{$url}&page={$prevPage}{$where}'>Previous</a>";
        $next = ($page == $totalPage) ? "Next" : "<a href='{$url}&page={$nextPage}{$where}'>Next</a>";
        $str = "Total {$totalPage} Page/No.{$page} Page";
        for ($i = 1; $i <= $totalPage; $i++) {
            //当前页无连接
            if ($page == $i) {
                $p .= "[{$i}]";
            } else {
                $p .= "<a href='{$url}&page={$i}{$where}'>[{$i}]</a>";
            }
        }
        $pageStr = $str . $sep . $index . $sep . $prev . $sep . $p . $sep . $next . $sep . $last;


    }

    return $pageStr;
}

if ($_SESSION['loginFlag']==null&&$_GET['product_id']!=null) :?>

   <!doctype html><html><head></head>
    <body>
    <div align="center">
        Please login first!    </div>
                <div align="center"><button type="button" id="back" value="back"  class="btn" onclick="window.location.href='login.php?'" >LOGIN</button>


    </body>
    </html>
<?php else:?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home Page</title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript" src="js/ie6Fixpng.js"></script>
<![endif]-->
</head>
<body>

<div class="headerBar">
	<div class="topBar">
		<div class="comWidth">
			<div class="rightArea">
				Welcome to Electronics Sales Website!
				<?php if($_SESSION['loginFlag']):?>
				<span>Welcome, </span><?php echo $_SESSION['account'];?>
				<a href="doAction.php?act=userOut">[Logout]</a>
				<?php else:?>
				<a href="login.php">[Login]</a><a href="reg.php">[Sign up]</a>
				<?php endif;?>
			</div>
		</div>
	</div>
	<div class="logoBar">
		<div class="comWidth">
			<div class="logo fl">
				
			</div>
			<div class="search_box fl">
				<form action="index.php" method="get">
					<input type="text" name="search_name" class="search_text fl">
					<input type="submit" value="search" class="search_btn fr">
				</form>
			
				
				
			</div>
			<div class="shopCar fr">
				<span class="shopText fl"><button onclick="window.location.href='cart.php?id=<?php echo $_SESSION['loginFlag']?>'">Cart</button></span>
                <span><button onclick="window.location.href='transactions.php?id=<?php echo $_SESSION['loginFlag']?>'">Trans</button></span>

			</div>
		</div>
	</div>

			<div class="shopClass fl">
				<h3 class="blue_color">All categories</h3>
				
    				<div class="shopClass_show">
    					<dl class="shopClass_item">
    					<?php foreach($cates as $cate):?>
    						
    						<a href="index.php?status=1&tmp_id=<?php echo $cate['id'];?>" class="a"><?php echo $cate['categories'];?></a><br>
    						
    					<?php endforeach;?>	
    					</dl>
    					
    				</div>
				
			</div>
			

</div>
<div class="banner comWidth clearfix">
	<div class="banner_bar banner_big">
		<ul class="imgBox">
			<li><a href="#"><img src="images/banner/ElectronicsBanner.jpg" alt="banner"></a></li>
			
		</ul>
		
	</div>
</div>
<div class="details">
<table width="89%" style="position:relative;left:200px" class="table" border="1" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">name</th>
                                <th width="2%">brand</th>
                               <th width="2%">categories</th>
                                <th width="2%">image</th>
                                <th width="2%">more detail</th>
                                <th width="2%">Add cart</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <!--<td><input type="check" id="c<?php echo $row['id'];?>" class="check" value="";?><label for="c1" class="label"></label></td>-->
                                <td align="center"><?php echo $row['name']; ?></td>
                                
                                <td align="center"><?php echo $row['brand'];?></td>
                                <td align="center"><?php echo $row['categories'];?></td> 
                                <td align="center"><a href="<?php echo $row['imageURLs'];?>"><button class="btn btn-default btn-xs">See Image</button></a></td>
                                <td align="center"><a href="Detail.php?id=<?php echo $_SESSION['loginFlag']?>&pid=<?php echo $row['id']?>"><button class="btn">See more detail</button></a></td>
                                
                                <td align="center">

                                                <button type="button" value="Add" class="btn" onclick="window.location.href='index.php?id=<?php echo $_SESSION['loginFlag']?>&product_id=<?php echo $row['id']?>'" >Add</button>
					                            <div id="showDetail<?php echo $row['id'];?>" style="display:none;">
					                        	
					                
					                        </div>
                                
                                </td> 
                            </tr>
                           <?php  endforeach;?>
                           <?php if($totalRows>$pageSize):?>
                            <tr>
                            	<th width="5%"></th><td colspan="7"><?php echo showPage1($page, $totalPage,"keywords={$keywords}&order={$order}");?></td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                    
                    
</div>



<div class="hr_25"></div>

</body>
</html>

<?php endif;?>
