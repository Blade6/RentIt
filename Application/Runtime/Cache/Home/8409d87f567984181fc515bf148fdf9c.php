<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo ($title); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/RentIt/Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- 自定义CSS -->
    <link href="/RentIt/Public/css/MyCSS.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/RentIt/Public/js/ie-emulation-modes-warning.js"></script>

    <!-- JQuery文件 -->
    <script src="/RentIt/Public/js/jquery-3.1.1.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container"> 
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-control="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo U('Index/index');?>">RentIt</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="" id="Index"><a href="<?php echo U('Index/index');?>">首页</a></li>
					<li class="" id="Rent"><a href="<?php echo U('Rent/index');?>">短期租赁</a></li>
					<li class="" id="Advice"><a href="<?php echo U('Advice/index');?>">意见反馈</a></li>
					<li class="dropdown" id="Help">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">帮助中心<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li class="" id="principle"><a href="<?php echo U('Help/principle');?>">租车条例</a></li>
							<li class="" id="QA"><a href="<?php echo U('Help/QA');?>">常见问题解答</a></li>
						</ul>
					</li>
					<script type="text/javascript">
						switch("/RentIt/index.php/Me/order.html"){
							case "<?php echo U('Index/index');?>":
								document.getElementById("Index").className="active";
								break;
							case "<?php echo U('Rent/index');?>":
								document.getElementById("Rent").className="active";
								break;
							case "<?php echo U('Advice/index');?>":
								document.getElementById("Advice").className="active";
								break;
							case "<?php echo U('Help/principle');?>":
								$("li#Help").addClass("active");
								document.getElementById("principle").className="active";
								break;
							case "<?php echo U('Help/QA');?>":
								$("li#Help").addClass("active");
								document.getElementById("QA").className="active";
								break;
							default:
								break;
						}
					</script>
				</ul>
				<div class="navbar-right">
					<div class="btn-top">
						<?php session('[start]'); $time=10*60; setcookie(session_name(),session_id(),time()+$time,"/"); if(!empty($_SESSION["user"])){ echo "<a class=\"btn btn-primary btn-right\" href=\"/RentIt/index.php/Home/Me/index\">"; echo $_SESSION["username"]."</a>"; echo "<a class=\"btn btn-default\" href=\"/RentIt/index.php/Home/Index/logout\">登出</a>"; } else{ echo "<a class=\"btn btn-default btn-right\" href=\"/RentIt/index.php/Home/Index/login\">登录</a>"; echo "<a class=\"btn btn-success\" href=\"/RentIt/index.php/Home/Index/register\">注册</a>"; } ?>
					</div>
				</div>				
			</div><!--/.nav-collapse -->
		</div>	
	</nav>
<br>
<div class="container Min-height">
		<?php @session_start(); $time=10*60; @setcookie(session_name(),session_id(),time()+$time,"/"); if(empty($_SESSION["user"])){ echo "<script>alert('非法操作!');</script>"; echo "<script>window.location='/RentIt/index.php/Home/Index/index';</script>"; } ?>
	<div class="MyMenu">
		<div class="MyTitle">
			<h3 class="MyRentit">My RentIt</h3>
		</div>
		<div class="MyItem">
			<ul class="Item-nav list-unstyled">
				<li class="li">
					<a class="nav-a" href="<?php echo U('Me/index');?>" id="index">
						<span class="glyphicon glyphicon-home"> 欢迎页</span>
					</a>
				</li>
				<li class="li">
					<a class="nav-a" href="<?php echo U('Me/order');?>" id="order">
						<span class="glyphicon glyphicon-th"> 我的订单</span>
					</a>
				</li>
				<li class="li">
					<a class="nav-a" href="<?php echo U('Me/info');?>" id="info">
						<span class="glyphicon glyphicon-user"> 我的资料</span>
					</a>
				</li>
				<li class="li">
					<a class="nav-a" href="<?php echo U('Me/accident');?>" id="accident">
						<span class="glyphicon glyphicon-exclamation-sign"> 违章记录</span>
					</a>
				</li>
				<li class="li">
					<a class="nav-a" href="<?php echo U('Me/blog');?>" id="blog">
						<span class="glyphicon glyphicon-edit"> 我的帖子</span>
					</a>
				</li>
				<li class="li">
					<a class="nav-a" href="<?php echo U('Me/post');?>" id="post">
						<span class="glyphicon glyphicon-edit"> 我的回复</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<p class="txt"></p>
	<script>
		window.onresize = resizeWindow;
		function resizeWindow(){
			var width = $(window).width();
			$("p.txt").html(width);
			if (width < 980) {
				$("span").html("");
				$("div.MyMenu").css("width", "50px");
			}
		}
	</script>
	<script>
		$(document).ready(
			function(){
				switch("/RentIt/index.php/Me/order.html"){
					case "<?php echo U('Me/index');?>":
						$("#index").addClass("nav-active");
						break;
					case "<?php echo U('Me/order');?>":
						$("#order").addClass("nav-active");
						break;
					case "<?php echo U('Me/info');?>":
						$("#info").addClass("nav-active");
						break;
					case "<?php echo U('Me/accident');?>":
						$("#accident").addClass("nav-active");
						break;
					case "<?php echo U('Me/blog');?>":
						$("#blog").addClass("nav-active");
						break;
					case "<?php echo U('Me/post');?>":
						$("#post").addClass("nav-active");
						break;
					default:
						break;
				}
			}
		);
	</script>
	<div class="MyContent">
		<div class="MyContainer">
			<h3>我的订单</h3>
			<table class="table table-striped">
				<thead>
					<th>车牌号码</th>
					<th>租车时间</th>
					<th>取车时间</th>
					<th>还车时间</th>
					<th>押金</th>
					<th>租金</th>
					<th>订单状态</th>
				</thead>
				<tbody>
					<?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
							<td><?php echo ($data["license_no"]); ?></td>
							<td><?php echo ($data["date"]); ?></td>
							<td><?php echo ($data["draw_date"]); ?></td>
							<td><?php echo ($data["return_date"]); ?></td>
							<td><?php echo ($data["deposit"]); ?></td>
							<td><?php echo ($data["fare"]); ?></td>
							<td>
								<?php if(!$data["flag"]) echo "处理中"; else if(empty($data["return_date"])) echo "租车中"; else echo "已完成"; ?>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="/RentIt/Public/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/RentIt/Public/js/ie10-viewport-bug-workaround.js"></script>
	

	<footer>
		<hr>
		<div class="container footer">
			<p class="center footer-p">©2016 HJH&&ZBJ</p>	
		</div>
	</footer>
	
</body>
</html>