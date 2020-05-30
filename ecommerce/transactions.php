<?php
require_once 'include.php';
$cates=getAllcate();

header("content-type:text/html;charset=utf-8");
//checkLogined();
$order=$_REQUEST['order']?$_REQUEST['order']:null;
$orderBy=$order?"order by p.".$order:null;
$keywords=$_REQUEST['keywords']?$_REQUEST['keywords']:null;
$where=$keywords?"where p.name like '%{$keywords}%'":null;
if ($_SESSION['loginFlag']==null):?>

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
        <?php if(($_SESSION['loginFlag']!=null)){
            //$productId=$_GET['id'];
            //$userId=$_SESSION['id'];
            $sql="select t.id as t_id,a.address,p.id as p_id,p.name,p.price,pt.count,p.imageURLs from product p, product_transaction pt, transaction t, address a where p.id=pt.product_id and pt.transaction_id=t.id and t.address_id = a.id and t.customer_id = {$_SESSION['loginFlag']}";
            $rows=fetchAll($sql);

            //$sqltrans="select pc.cart_id, pc.count,p.description from product p, product_cart pc, cart c where p.id=pc.product_id and pc.cart_id=c.cart_id and c.customer_id = {$_SESSION['loginFlag']}";
            //$trans=fetchAll($sqltrans);
        }
        ?>

        <div class="details">

            <table class="table" border="1" cellspacing="0" cellspacing="0" cellpadding="0">
                <thead>
                <tr>

                    <th width="2%">Transaction_id</th>
                    <th width="2%">Product_id</th>
                    <th width="2%">Address</th>
                    <th width="2%">Product_name</th>
                    <th width="2%">Unit Price</th>
                    <th width="2%">Count</th>
                    <th width="5%">image</th>
                </tr>
                </thead>
                <tbody>
                <form name="form" method="post" action="order.php?id=<?php echo $_SESSION['loginFlag']?>">
                    <?php if($rows){
                        foreach($rows as $row):?>
                            <tr>

                                <td align="center"><?php echo $row['t_id'] ?></td>
                                <td align="center"><?php echo $row['p_id'];?></td>
                                <td align="center"><?php echo $row['address'];?></td>
                                <td align="center"><?php echo $row['name'];?></td>
                                <td align="center"><?php echo $row['price'];?></td>
                                <td align="center"><?php echo $row['count'];?></td>
                                <td align="center"><img width="200" height="200" src="<?php echo $row['imageURLs'];?>" /></td>

                            </tr>
                        <?php  endforeach;}?>
                </tbody>
            </table>

            </form>


        </div>

    </div>

    </body>
    </html>
<?php endif;
?>
