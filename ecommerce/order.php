<?php 
require_once 'include.php';
$cates=getAllcate();
header("content-type:text/html;charset=utf-8");
//checkLogined();
$order=$_REQUEST['order']?$_REQUEST['order']:null;
$orderBy=$order?"order by p.".$order:null;
$keywords=$_REQUEST['keywords']?$_REQUEST['keywords']:null;
$where=$keywords?"where p.name like '%{$keywords}%'":null;
if ($_GET['id']==null):?>
    echo "<!doctype html><html><head></head>
    <body>
    <div>
        Bad URL, please return to the last page. 
        <!---路径错误（人为因素输入url）--->
    </div>
    </body>
    </html>";

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
<?php if(($_GET['id']!=null)){
        $productId=$_GET['id'];
        $userId=$_SESSION['id'];
        $sql="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight,pc.cart_id, p.date, pc.count,p.description from product p, product_cart pc, cart c where p.id=pc.product_id and pc.cart_id=c.cart_id and c.customer_id = {$_SESSION['loginFlag']}";
        $rows=fetchAll($sql);
        //$sql1="pc.product_id,pc.cart_id from product p, product_cart pc, cart ca where p.id=pc.product_id and pc.cart_id=c.cart_id and c.user_id = {$_SESSION['loginFlag']}";   
        //$carts=fetchAll($sql2);
        //$sql2="select p.id,p.name,p.price,p.brand,p.imageURLs,p.weight, pc.count,p.date,p.description from product p, product_cart pc, cart ca where p.id=pc.product_id and pc.cart_id=c.cart_id and c.user_id = {$_SESSION['loginFlag']}";
        //$transaction=fetchAll($sql2);
    }
?>

<div class="details">
    <?php if ($_POST['product_id']):?>

        <?php
            $product_id = $_POST['product_id'];
            $flag2=true;

            $sql_cart="select cart_id from cart where customer_id={$_GET['id']}";

            $cart_id=fetchOne($sql_cart);


            foreach($product_id as $id){

                $sql_count="select count from product_cart where product_id={$id} and cart_id ={$cart_id['cart_id']}";
                $count=fetchOne($sql_count);
                $sql_inventory = "select count from inventory where id={$id}";
                $inventory = fetchOne($sql_inventory);
                if ($inventory['count']<$count['count']){
                    $flag2=false;
                }



            }

            if ($flag2){
                echo "<div align=\"center\">Your order has been created!</div>";
                echo "<div align=\"center\"><button type=\"button\" id=\"back\" value=\"back\" class=\"btn\" onclick=\"window.location.href='cart.php?id={$_SESSION['loginFlag']}'\" >BACK</button></div>";

                $sql_addr="select address_id from customer_address where customer_id={$_GET['id']}";

            $addr = fetchOne($sql_addr);
            $sql_vip="select is_vip from customer where id={$_GET['id']}";

            $is_vip=fetchOne($sql_vip);
            $total=0;
            foreach($product_id as $id){
                $sql_price="select price from product where id={$id}";
                $price=fetchOne($sql_price);
                $sql_count="select count from product_cart where product_id={$id} and cart_id ={$cart_id['cart_id']}";

                $count=fetchOne($sql_count);
                $total = $total + $price['price']*$count['count'];
            }

            if($is_vip['is_vip']==1){
                $sql_insert_trans = "INSERT INTO `transaction`(`customer_id`, `address_id`, `total_price`, `time`) VALUES ({$_GET['id']},{$addr['address_id']},{$total}*0.8,now())";

                execute($sql_insert_trans);
            }else{
                $sql_insert_trans = "INSERT INTO `transaction`(`customer_id`, `address_id`, `total_price`, `time`) VALUES ({$_GET['id']},{$addr['address_id']}, {$total},now())";
                //echo $sql_insert_trans;
                execute($sql_insert_trans);

            }
            foreach($product_id as $id){
                $sql_transId="select max(id) as id from transaction where customer_id={$_GET['id']}";
                //echo $sql_transId;
                $trans_id = fetchOne($sql_transId);
                //echo $trans_id['id'].".....";
                $sql_count="select count from product_cart where product_id={$id} and cart_id ={$cart_id['cart_id']}";
                $count=fetchOne($sql_count);
                //echo $count['count']."count";
                //echo $count['count'];
                $sqltrans="INSERT INTO `product_transaction`(`transaction_id`, `product_id`, `count`) VALUES ({$trans_id['id']},{$id},{$count['count']})";
                execute($sqltrans);
                $sql_inventory = "select count from inventory where id={$id}";
                $inventory = fetchOne($sql_inventory);
                $tmp_inven = $inventory['count'] - $count['count'];
                $sql_inven_insert = "UPDATE inventory SET count= {$tmp_inven} WHERE id={$id}";
                execute($sql_inven_insert);
            }
            foreach($product_id as $id){
                $sql1="select cart_id from cart where customer_id={$_GET['id']}";
                $cart_id1=fetchOne($sql1);
                $cart_id=$cart_id1['cart_id'];
                $sqldel="delete from product_cart where product_id={$id} and cart_id={$cart_id}";
                execute($sqldel);
            }
            }else{

                echo "<div align=\"center\">The products are sold out!!</div>";
                echo "<div align=\"center\"><button type=\"button\" id=\"back\" value=\"back\" class=\"btn\" onclick=\"window.location.href='cart.php?id={$_SESSION['loginFlag']}'\" >BACK</button></div>";

            }


        ?>
    <?php else :?>
                <div align="center">Please select what you want to buy!</div>
                <div align="center"><button type="button" id="back1" value="back1"  class="bt111" onclick="window.location.href='cart.php?id=<?php echo $_SESSION['loginFlag']?>'" >BACK</button></div>
    <?php endif;?>
</div>

</div>

</body>
</html>
<?php endif;
?>