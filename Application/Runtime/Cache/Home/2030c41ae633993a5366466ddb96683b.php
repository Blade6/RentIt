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
						switch("/RentIt/index.php/Advice/post/col/1224abcd/id/1/page/1.html"){
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
	<div class="container" style="min-height: 500px;">
		<div>
  			<h1 style="margin-left: 20px;"><?php echo ($blog["title"]); ?></h1>
		</div>
		<hr>
		<div>
			<dl class="dl-horizontal" style="margin-bottom: 0px;">
				<dt style="text-align: center;">
					<div>
						<img src="/RentIt/Public/user_pics/<?php echo ($author["picture"]); ?>" class="img-thumbnail user-pic">
						<p><?php echo ($author["username"]); ?></p>
					</div>
				</dt>
				<dd>
					<p class="words"><?php echo ($blog["content"]); ?></p>
				</dd>
			</dl>
			<p class="text-right"><small>楼主 <?php echo ($blog["date"]); ?> <?php echo ($blog["time"]); ?></small></p>
			<hr style="margin-top: 10px;margin-bottom: 10px;">
		</div>
		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><!-- 写在内部的css样式是最高级别的，这样能取代bootstrap的设定。 -->
			<dl class="dl-horizontal" style="margin-bottom: 0px;">
				<dt style="text-align: center;">
					<div>
						<img src="/RentIt/Public/user_pics/<?php echo ($data["picture"]); ?>" class="img-thumbnail user-pic">
						<p><?php echo ($data["username"]); ?></p>
					</div>
				</dt>
				<dd>
					<div>
						<?php if($data['refloor']!=0) echo "<p><strong>回复".$data['refloor']."楼:</strong></p>"; ?>
						<p class="words"><?php echo ($data["content"]); ?></p>
					</div>
				</dd>
			</dl>
			<p class="text-right">
				<small><?php echo ($data["floor"]); ?>楼 <?php echo ($data["date"]); ?> <?php echo ($data["time"]); ?> <a href="#say">回应</a></small>
			</p>
			<hr style="margin-top: 10px;margin-bottom: 10px;"><?php endforeach; endif; else: echo "" ;endif; ?>
		<form action="<?php echo U('Advice/repost');?>" method="post" role="form">
			<a name="say" id="say" class="say"><strong>发表回复:</strong></a>
			<input type="hidden" name="col" value="<?php echo ($blog["collection"]); ?>">
			<input type="hidden" name="blogid" value="<?php echo ($id); ?>">
			<textarea class="form-control" rows="3" placeholder="不要超过140个字" name="words"></textarea>
			<button type="submit" class="btn btn-success btn-top" name="submit">发表</button>
			<button type="reset" class="btn btn-default btn-top">重置</button>
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