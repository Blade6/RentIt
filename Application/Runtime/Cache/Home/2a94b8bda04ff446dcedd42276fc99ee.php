<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Rent It</title>

    <!-- Bootstrap core CSS -->
    <link href="/RentIt/Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/RentIt/Public/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="/RentIt/Public/css/index.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
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
						switch("/RentIt/index.php/Index/index.html"){
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
    <!-- Carousel
    ================================================== -->
    <!-- 兼容手机浏览器，只有屏幕宽度大于500像素才显示幻灯片 -->
    <script>
      if (screen && screen.width > 500) {
        document.write('<div id=\"myCarousel\" class=\"carousel slide\" data-ride=\"carousel\"><!-- Indicators --><ol class=\"carousel-indicators\">  <li data-target=\"#myCarousel\" data-slide-to=\"0\" class=\"active\"></li> <li data-target=\"#myCarousel\" data-slide-to=\"1\"></li> <li data-target=\"#myCarousel\" data-slide-to=\"2\"></li> </ol> <div class=\"carousel-inner\" role=\"listbox\"> <div class=\"item active\"> <img src=\"data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==\" alt=\"First slide\"> <div class=\"container\"> <div class=\"carousel-caption\"> <h1>WHY CHOOSE RENTIT?</h1> <p>Because it\'s where your dream starts.<br> Because it\'s a place to find yourself.<br> Because it\'s future.</p> <p><a class=\"btn btn-lg btn-primary\" href=\"<?php echo U('Index/register');?>\" role=\"button\">Sign Up Today</a></p> </div> </div> </div> <div class=\"item\"> <img src=\"data:image/gif;base64,R0lGODlhAQABAIAAAGZmZgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==\" alt=\"Second slide\"> <div class=\"container\"> <div class=\"carousel-caption\"> <h1>RENT NOW</h1> <p>Just three steps to rent a car.You can enjoy driving whenever and wherever.<br> If you have any problems, call us any time!</p> <p><a class=\"btn btn-lg btn-primary\" href=\"<?php echo U('Rent/index');?>\" role=\"button\">Rent A Car Now</a></p> </div> </div> </div> <div class=\"item\"> <img src=\"data:image/gif;base64,R0lGODlhAQABAIAAAFVVVQAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==\" alt=\"Third slide\"> <div class=\"container\"> <div class=\"carousel-caption\"> <h1>OUR OBJECTIVE</h1> <p>Your satifsfaction,Our acceleration.<br>Your suggestion,Our direction.</p> <p><a class=\"btn btn-lg btn-primary\" href=\"<?php echo U('Advice/index');?>\" role=\"button\">Share Your Advice</a></p> </div> </div> </div> </div> <a class=\"left carousel-control\" href=\"#myCarousel\" role=\"button\" data-slide=\"prev\"> <span class=\"glyphicon glyphicon-chevron-left\"></span> <span class=\"sr-only\">Previous</span> </a> <a class=\"right carousel-control\" href=\"#myCarousel\" role=\"button\" data-slide=\"next\"> <span class=\"glyphicon glyphicon-chevron-right\"></span> <span class=\"sr-only\">Next</span> </a> </div><!-- /.carousel -->');
      }
    </script>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    <div class="container marketing">
      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading"><span class="text-muted">第一步:</span>登录您的帐户</h2>
        </div>
        <div class="col-md-5">
          <img src="/RentIt/Public/image/login.png" class="featurette-image img-responsive" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-9">
          <img src="/RentIt/Public/image/rent.png" class="featurette-image img-responsive" alt="Generic placeholder image">
        </div>
        <div class="col-md-3">
          <h2 class="featurette-heading"><span class="text-muted">第二步:</span>选择时间和车辆</h2>
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-4">
          <h2 class="featurette-heading"><span class="text-muted">第三步:</span>确认订单</h2>
          <p class="lead">确认订单后，请尽快前往本公司支付押金。</p>
        </div>
        <div class="col-md-8">
          <img src="/RentIt/Public/image/done.png" class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->

    <!-- FOOTER -->
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
	


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/RentIt/Public/js/jquery-3.1.1.min.js"></script>
    <script src="/RentIt/Public/js/bootstrap.min.js"></script>
    <script src="/RentIt/Public/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/RentIt/Public/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>