<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewpoint" content="width=device-width, initial-scale=1">
	<title>RentIt|Admin</title>
	<link rel="stylesheet" type="text/css" href="/RentIt/Public/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/RentIt/Public/css/login.css">
	<link rel="stylesheet" type="text/css" href="/RentIt/Public/css/cover.css">
</head>
<body>
	<div class="container">
		<div class="center">
			<img src="/RentIt/Public/image/whitecar.png" alt="" width="100px">
		</div>
		<form class="form-signin" role="form" action="<?php echo U('Index/index');?>" method="post">
			<h2 align="center">RentIt Admin System</h2>
			<input type="text" name="adminname" class="form-control" placeholder="用户名" required autofocus>
			<input type="password" name="password" class="form-control" placeholder="密码" required autofus>
			<button class="btn btn-default btn-block" type="submit" name="submit">登录</button>
		</form>
		<div class="center">
			<p>Click <a href="/RentIt/index.php/Home/Index/index">here</a> go to RentIt,by <a href="">@blade6</a></p>
		</div>
	</div>
</body>
</html>