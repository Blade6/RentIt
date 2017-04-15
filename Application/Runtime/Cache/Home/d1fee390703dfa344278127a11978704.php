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
						switch("/RentIt/index.php/Rent/rent.html"){
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
<div class="container">
	<div class="notice notice-danger">
		<p class="">请及时到本公司办理押金支付以及合同的签订,并取车！</p>
		<p class="">租金等条款将在合同中说明。</p>
	</div>
	<div class="Rent-info">
		<form action="<?php echo U('Rent/rentCar');?>" method="post" class="form-horizontal" role="form">
			<div class="form-group">
				<label class="col-sm-2 control-label">身份证号</label>
				<div class="col-sm-10">
					<input class="form-control" type="text" value="<?php echo ($info["userID"]); ?>" disabled="true">
					<input type="hidden" name="userID" value="<?php echo ($info["userID"]); ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">姓名</label>
				<div class="col-sm-10">
					<input class="form-control" name="name" type="text" value="<?php echo ($info["name"]); ?>" disabled="true">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">所选车辆</label>
				<div class="col-sm-10">
					<input class="form-control" type="text" value="<?php echo ($info["license_no"]); ?>" disabled="true">
					<input type="hidden" name="license_no" value="<?php echo ($info["license_no"]); ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">取车日期</label>
				<div class="col-sm-10">
					<input class="form-control" name="draw_date" type="text" value="<?php echo ($info["draw_date"]); ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">租期</label>
				<div class="col-sm-10">
					<input class="form-control" name="days" type="text" value="<?php echo ($info["days"]); ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">租金</label>
				<div class="col-sm-10">
					<input class="form-control" type="text" value="¥ <?php echo ($info["rent_fare"]); ?>/day" disabled="true">
					<input type="hidden" name="rent_fare" value="<?php echo ($info["rent_fare"]); ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">押金</label>
				<div class="col-sm-10">
					<input class="form-control" type="text" value="<?php echo ($info["deposit"]); ?>" disabled="true">
					<input type="hidden" name="deposit" value="<?php echo ($info["deposit"]); ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">手机号码</label>
				<div class="col-sm-10">
					<input class="form-control" id="phone" type="text" value="<?php echo ($info["phone"]); ?>" disabled="true">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" name="date" value="<?php echo ($today); ?>">
					<button type="submit" class="btn btn-danger" name="submit">确认订单</button>
				</div>
			</div>
		</form>
	</div>
	<script>
		resizeWindow();
		window.onresize = resizeWindow;
		function resizeWindow(){
			var width = $(window).width();
			if (width < 800) {
				$("div.Rent-info").css("width", "100%");
			} else {
				$("div.Rent-info").css("width", "65%");
			}
		}
	</script>
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