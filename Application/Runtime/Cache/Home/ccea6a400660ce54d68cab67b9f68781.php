<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewpoint" content="width=device-width, initial-scale=1">
	<title>登录</title>
	<link rel="stylesheet" type="text/css" href="/RCW_MVC/Public/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/RCW_MVC/Public/css/login.css">
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
						switch("/RCW_MVC/index.php/Home/Index/login"){
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
						<?php @session_start(); $time=5*60; @setcookie(session_name(),session_id(),time()+$time,"/"); if(!empty($_SESSION["user"])){ echo "<a class=\"btn btn-primary btn-right\" href=\"/RCW_MVC/index.php/Home/Me/index\">"; echo $_SESSION["username"]."</a>"; echo "<a class=\"btn btn-default\" href=\"/RCW_MVC/index.php/Home/Index/logout\">登出</a>"; } else{ echo "<a class=\"btn btn-default btn-right\" href=\"/RCW_MVC/index.php/Home/Index/login\">登录</a>"; echo "<a class=\"btn btn-success\" href=\"/RCW_MVC/index.php/Home/Index/register\">注册</a>"; } ?>
					</div>
				</div>				
			</div><!--/.nav-collapse -->
		</div>	
	</nav>
	<div class="container">
		<div class="center">
			<img src="/RCW_MVC/Public/image/car.png" alt="" width="100px">
		</div>
		<form class="form-signin" role="form" action="<?php echo U('Index/login');?>" method="post">
			<h2 align="center">登录租车网</h2>
			<input type="text" name="ID" class="form-control" placeholder="身份证号" maxlength="18" required autofocus>
			<input type="password" name="password" class="form-control" placeholder="密码" maxlength="16" required autofus>
			<button class="btn btn-success btn-block" type="submit" name="submit">登录</button>
		</form>
		<p class="here-to-begin">没有账户?<a href="<?php echo U('Index/register');?>"> 快速创建</a></p>
	</div>
		<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="/RCW_MVC/Public/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/RCW_MVC/Public/js/ie10-viewport-bug-workaround.js"></script>
	

	<footer>
		<hr>
		<div class="container footer">
			<p class="center footer-p">©2016 HJH&&ZBJ</p>	
		</div>
	</footer>
	
</body>
</html>