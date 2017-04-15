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
						switch("/RentIt/index.php/Rent/index.html"){
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
	<form action="<?php echo U('Rent/index');?>" method="post" role="form">
		<div class="wholeParent btn-top">
			<p class="p-info p-right">取车时间</p>
			<input class="p-info p-bg-right" type="date" value="<?php echo ($today); ?>" min="<?php echo ($today); ?>" max="<?php echo ($twoWeeksLater); ?>" name="draw_date">
			<p class="p-info p-right">租期</p>
			<input class="p-info" type="number" min="1" max="90" value="1" name="days">
			<a class="btn btn-primary renew" href="<?php echo U('Rent/index');?>">刷新库存车辆</a>
		</div>
		<div class="bodyPart">
			<ul class="list-unstyled">
				<?php if(is_array($cars)): $i = 0; $__LIST__ = $cars;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cars): $mod = ($i % 2 );++$i;?><li>
						<div class="carLeft">
							<img class="carImg" src="/RentIt/Public/pictures/<?php echo ($cars["picture"]); ?>">
						</div>
						<div class="carMidLeft">
							<ul class="list-unstyled ul-top center">
								<li class="li-bottom"><span class="carInfo"><?php echo ($cars["type"]); ?></span></li>
								<li class="li-bottom"><span class="carInfo"><?php echo ($cars["brand"]); ?></span></li>
								<li><span class="carInfo"><?php echo ($cars["seat_number"]); ?>人座</span></li>
							</ul>
						</div>
						<div class="carMidRight">
							<div class="ul-top center carPrice">
								<p>¥<?php echo ($cars["rent_fare"]); ?>/天</p>
								<p>押金:¥<?php echo $cars["value"]/10; ?></p>
							</div>
						</div>
						<div class="carRight">
							<button class="btn btn-primary ul-top" type="submit" value="<?php echo ($cars["license_no"]); ?>" name="submit">租车</button>
						</div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
	</form>
	<div class="sidebar">
		<div class="fixed-right">
  <div class="headframe">
        <div class="center head">
          <img src="/RentIt/Public/image/car.png" width="100">
        </div>
        <div>
          <ul class="list-unstyled">
            <li>
              <div class="contentli">
                <div class="leftpart center">
                  <img src="/RentIt/Public/image/money.jpg" class="right-img">
                </div>
                <div class="rightpart">           
                  <p class="keyWord">价格优惠</p>
                  <p>没有附加的费用、不需要押金，价格低廉实惠</p>
                </div>
              </div>
            </li>
            <br>
            <li>
              <div class="contentli">
                <div class="leftpart center">
                  <img src="/RentIt/Public/image/customer.jpg" class="right-img">
                </div>
                <div class="rightpart">
                  <p class="keyWord">顾客第一</p>
                  <p>保证2小时内送达车子，有问题马上为您解决</p>
                </div>
              </div>
            </li>
            <br>
            <li>
              <div class="contentli">
                <div class="leftpart center">
                  <img src="/RentIt/Public/image/rent.jpg" class="right-img">
                </div>
                <div class="rightpart">
                  <p class="keyWord">租借方便</p>
                  <p>随时随地租车，随时随地享受到开车的乐趣</p>
                </div>
              </div>
            </li>
            <br>
            <li>
              <div class="contentli">
                <div class="leftpart center">
                  <img src="/RentIt/Public/image/service.jpg" class="right-img">
                </div>
                <div class="rightpart">
                  <p class="keyWord">服务周到</p>
                  <p>客服24小时在线解疑答惑，解决一切租车难题</p>
                </div>
              </div>
            </li>
          </ul> 
        </div>
  </div>
  <div class="center btn-top">
    <a class="btn btn-success" href="#">返回顶部</a>
  </div>
</div>

	</div>
	<!-- 解决手机浏览器查看时，因为浮动布局导致的重叠bug。 -->
 	<script>
 		resizeWindow();
  		window.onresize = resizeWindow;
  		function resizeWindow(){
        	var width = $(window).width();
        	$("p.txt").html(width);
        	if(width < 700){
        		$("div.sidebar").hide();
          		$("div.bodyPart").css("width", "100%");
        		$("div.carLeft").css({"float":"none","width":"auto","height":"auto"});
        		$("div.carMidLeft").css({"width":"100px","height":"150px"});
        		$("div.carMidRight").css({"width":"auto","height":"150px","margin-left":"50px"});
        		$("div.carRight").css({"width":"auto","height":"150px","margin-left":"50px"});
        	}else if(width < 1185){
          		$("div.sidebar").hide();
          		$("div.bodyPart").css("width", "100%");
          		$("div.carLeft").css({"float":"left","width":"50%","height":"260px"});
        		$("div.carMidLeft").css({"width":"15%","height":"260px"});
        		$("div.carMidRight").css({"width":"20%","height":"260px","margin-left":"0"});
        		$("div.carRight").css({"width":"15%","height":"260px","margin-left":"0"});
        	}else{
        		$("div.bodyPart").css("width", "75%");
        		$("div.carLeft").css({"float":"left","width":"50%","height":"260px"});
        		$("div.carMidLeft").css({"width":"15%","height":"260px"});
        		$("div.carMidRight").css({"width":"20%","height":"260px","margin-left":"0"});
        		$("div.carRight").css({"width":"15%","height":"260px","margin-left":"0"});
          		$("div.sidebar").show();
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