<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewpoint" content="width=device-width, initial-scale=1">
	<title>注册</title>
	<link rel="stylesheet" type="text/css" href="/RentIt/Public/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/RentIt/Public/css/MyCSS.css">
	<link rel="stylesheet" type="text/css" href="/RentIt/Public/css/register.css">
	<script type="text/javascript" src="/RentIt/Public/js/register.js"></script>
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
						switch("/RentIt/index.php/Home/Index/register"){
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
		<h1>加入租车网</h1>
		<blockquote>
			<p>Rent a good car,Drive a long way,Meet a nice guy,Live a happy life.</p>
			<footer>Someone will be famous in <cite>The Future</cite></footer>
		</blockquote>
		<hr>
		<h4>创建您的个人帐户:</h4>
		<form action="<?php echo U('Index/register');?>" id="form" method="post" onsubmit="return check()" class="form-horizontal" role="form">
			<div class="form-group">
				<label class="col-sm-1 control-label">身份证号</label>
				<div class="col-sm-10">
					<input type="text" id="ID" name="ID" class="form-control" placeholder="输入18位身份证号" maxlength="18">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-10">
					<span class="help-block">身份证号用于登录,请输入正确的身份证号</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">用户名</label>
				<div class="col-sm-10">
					<input type="text" id="USERNAME" name="username" class="form-control" placeholder="输入15位字符以内的用户名" maxlength="15">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">密码</label>
				<div class="col-sm-10">
					<input type="password" id="PWD" name="password" class="form-control" placeholder="6~16个字符，区分大小写">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">确认密码</label>
				<div class="col-sm-10">
					<input type="password" id="PWD2" name="" class="form-control" placeholder="再次输入密码">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">姓名</label>
				<div class="col-sm-10">
					<input type="text" name="name" class="form-control" placeholder="输入您的姓名">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">性别</label>
				<div class="col-sm-10">
					<label>
						<input type="radio" name="gender" value="男">男
					</label>
					<label>
						<input type="radio" name="gender" value="女">女
					</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">年龄</label>
				<div class="col-sm-10">
					<input type="number" name="age" class="form-control" placeholder="输入您的年龄" min="18" max="70">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-1 control-label">手机号码</label>
				<div class="col-sm-10">
					<input type="text" name="phone_num" class="form-control" placeholder="输入11位手机号码">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-10">
					<button type="reset" class="btn btn-default">重置</button>
					<button type="submit" name="submit" class="btn btn-success">注册</button>
				</div>
			</div>
		</form>
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