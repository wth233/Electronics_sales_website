<?php 
require_once '../include.php';
checkLogined();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>website_admin</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
    <div class="head">
            <div class="logo fl"><a href="#"></a></div>
            <h3 class="head_text fr">E-commerce Background Management System</h3>
    </div>
    <div class="operation_user clearfix">
       <!--   <div class="link fl"><a href="#">慕课</a><span>&gt;&gt;</span><a href="#">商品管理</a><span>&gt;&gt;</span>商品修改</div>-->
        <div class="link fr">
            <b>Welcome Administrator,
            <?php 
				if(isset($_SESSION['adminName'])){
					echo $_SESSION['adminName'];
				}elseif(isset($_COOKIE['adminName'])){
					echo $_COOKIE['adminName'];
				}
            ?>
            
            </b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="icon icon_i">Home page</a><span></span><a href="#" class="icon icon_j">Go forward</a><span></span><a href="#" class="icon icon_t">Go back</a><span></span><a href="#" class="icon icon_n">Refresh</a><span></span><a href="doAdminAction.php?act=logout" class="icon icon_e">Log out</a>
        </div>
    </div>
    <div class="content clearfix">
        <div class="main">
            <!--右侧内容-->
            <div class="cont">
                <div class="title">Background Management</div>
      	 		<!-- 嵌套网页开始 -->         
                <iframe src="main.php"  frameborder="0" name="mainFrame" width="100%" height="522"></iframe>
                <!-- 嵌套网页结束 -->   
            </div>
        </div>
        <!--左侧列表-->
        <div class="menu">
            <div class="cont">
                <div class="title">Administrator</div>
                <ul class="mList">
                    <li>
                        <h3><span onclick="show('menu1','change1')" id="change1">+</span>Product Management</h3>
                        <dl id="menu1" style="display:none;">
                        	<dd><a href="addPro.php" target="mainFrame">Add Product</a></dd>
                            <dd><a href="listPro.php" target="mainFrame">Product List</a></dd>
                            
                        </dl>
                    </li>
                    <li>
                        <h3><span onclick="show('menu2','change2')" id="change2">+</span>Category Management</h3>
                        <dl id="menu2" style="display:none;">
                        	<dd><a href="addCate.php" target="mainFrame">Add Category</a></dd>
                            <dd><a href="listCate.php" target="mainFrame">Category List</a></dd>
                        </dl>
                    </li>
                   
                    <li>
                        <h3><span onclick="show('menu4','change4')" id="change4">+</span>User Management</h3>
                        <dl id="menu4" style="display:none;">
                        	<dd><a href="addUser.php" target="mainFrame">Add User</a></dd>
                            <dd><a href="listUser.php" target="mainFrame">User List</a></dd>
                        </dl>
                    </li>
                    <li>
                        <h3><span onclick="show('menu5','change5')" id="change5">+</span>Admin Management</h3>
                        <dl id="menu5" style="display:none;">
                        	<dd><a href="addAdmin.php" target="mainFrame">Add Administrator</a></dd>
                            <dd><a href="listAdmin.php" target="mainFrame">Administrator List</a></dd>
                        </dl>
                    </li>
                    <li>
                        <h3><span onclick="show('menu6','change6')" id="change6">+</span>Transaction Management</h3>
                        <dl id="menu6" style="display:none;">
               
                            <dd><a href="listTran.php" target="mainFrame">Transaction List</a></dd>
                        </dl>
                    </li>
                    <li>
                        <h3><span onclick="show('menu7','change7')" id="change7">+</span>Statistic</h3>
                        <dl id="menu7" style="display:none;">
               
                            <dd><a href="viz.php" target="mainFrame">Statistic</a></dd>
                        </dl>
                    </li>
                    
                </ul>
            </div>
        </div>

    </div>
    <script type="text/javascript">
    	function show(num,change){
	    		var menu=document.getElementById(num);
	    		var change=document.getElementById(change);
	    		if(change.innerHTML=="+"){
	    				change.innerHTML="-";
	        	}else{
						change.innerHTML="+";
	            }
    		   if(menu.style.display=='none'){
    	             menu.style.display='';
    		    }else{
    		         menu.style.display='none';
    		    }
        }
    </script>
</body>
</html>