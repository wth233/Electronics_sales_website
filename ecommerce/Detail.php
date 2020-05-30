<?php 
require_once 'include.php';
$cates=getAllcate();
header("content-type:text/html;charset=utf-8");
//checkLogined();
$order=$_REQUEST['order']?$_REQUEST['order']:null;
$orderBy=$order?"order by p.".$order:null;
$keywords=$_REQUEST['keywords']?$_REQUEST['keywords']:null;
$where=$keywords?"where p.name like '%{$keywords}%'":null;
?>

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
<?php
        $productId=$_GET['pid'];
        $sql="select a.id, a.name,a.price,a.brand,a.categories,a.imageURLs,a.weight,a.date,a.description,b.count from product a, inventory b where a.id=b.id and a.id= {$productId}";
        $row=fetchOne($sql);

?>

<div class="details">
<table class="table" border="1" cellspacing="0">
                        <thead>
                            <tr>
                                <th align="center" width="10%">name</th>
                                <th align="center" width="2%">brand</th>
                                <th align="center" width="2%">price</th>
                                <th align="center" width="2%">inventory</th>
                                <th align="center" width="5%">image</th>
                                <th align="center" width="5%">weight</th>
                                <th align="center" width="10%">description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               <td><?php echo $row['name'] ?></td>
                                <td align="center"><?php echo $row['brand'];?></td>
                                <td align="center"><?php echo $row['price'];?></td>
                                <td align="center"><?php echo $row['count'];?></td>
                                <td align="center"><img width="200" height="200" src="<?php echo $row['imageURLs'];?>" /></td>
                                <td align="center"><?php echo $row['weight']?></td>
                                <td align="center" style="word-break : break-all; "><?php echo $row['description']?></td>

                            </tr>
                        </tbody>
                    </table>
                    <div align="center"><button type="button" id="back" value="back"  class="btn" onclick="window.location.href='index.php?id=<?php echo $_SESSION['loginFlag']?>'" >BACK</button></div>
</div>

</div>

</body>
</html>
