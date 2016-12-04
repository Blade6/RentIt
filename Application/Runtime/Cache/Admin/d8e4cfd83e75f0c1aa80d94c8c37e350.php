<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>RentIt</title>

    <!-- Bootstrap core CSS -->
    <link href="/RentIt/Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/RentIt/Public/css/dashboard.css" rel="stylesheet">

    <!-- 自定义css -->
    <link href="/RentIt/Public/css/global.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/RentIt/Public/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php session('[start]'); $time=15*60; setcookie(session_name(),session_id(),time()+$time,"/"); if(empty($_SESSION["admin"])){ echo "<script>alert('非法操作!');</script>"; echo "<script>window.location='/RentIt/index.php/Admin/Index/index';</script>"; } ?>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo U('Index/manage');?>">RentIt Administration System</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a class="text-uppercase" href="<?php echo U('Admin/index');?>"><?php echo (session('admin')); ?></a></li>
            <li><a href="<?php echo U('Index/logout');?>">Logout</a></li>
            <li><a href="<?php echo U('Home/Index/index');?>">Go to RentIt</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="Index" id="Index"><a href="<?php echo U('Index/manage');?>">导航页</a></li>
            <li id="User">
              <a href="<?php echo U('User/index');?>">用户管理</a>
              <ul class="sub-menu">
                <li id="userGeneral"><a class="sub-item" href="<?php echo U('User/generalManage');?>">一般管理</a></li>
                <li id="userSuper"><a class="sub-item" href="<?php echo U('User/superManage');?>">高级管理</a></li>
              </ul>
            </li>
            <li id="Car">
              <a href="<?php echo U('Car/index');?>">车辆管理</a>
              <ul class="sub-menu">
                <li id="carSuper"><a class="sub-item" href="<?php echo U('Car/superManage');?>">高级管理</a></li>
              </ul>
            </li>
            <li id="Rent">
              <a href="<?php echo U('Rent/index');?>">租车管理</a>
              <ul class="sub-menu">
                <li id="rentSuper"><a class="sub-item" href="<?php echo U('Rent/superManage');?>">高级管理</a></li>
              </ul>
            </li>
            <li id="Accident"><a href="<?php echo U('Accident/index');?>">事故管理</a></li>
            <li id="Message">
              <a href="<?php echo U('Message/index');?>">留言管理</a>
              <ul class="sub-menu">
                <li id="nospeak"><a class="sub-item" href="<?php echo U('Message/nospeak');?>">用户禁言</a></li>
              </ul>
            </li>           
            <li id="Admin"><a href="<?php echo U('Admin/index');?>">Admin管理</a></li>
          </ul>
        </div>
        <script type="text/javascript">
          switch("/RentIt/index.php/Admin/Rent/edit/id/1.html"){
            case "<?php echo U('Index/manage');?>":
              document.getElementById("Index").className="active";
              break;

            case "<?php echo U('User/generalManage');?>":
            case "<?php echo U('User/edit');?>":
              document.getElementById("User").className="active";
              document.getElementById("userGeneral").className="sub-li";
              break;
            case "<?php echo U('User/superManage');?>":
            case "<?php echo U('User/superEdit');?>":
              document.getElementById("userSuper").className="sub-li";
            case "<?php echo U('User/index');?>":
            case "<?php echo U('User/search');?>":
              document.getElementById("User").className="active";
              break;

            case "<?php echo U('Car/superManage');?>":
            case "<?php echo U('Car/superEdit');?>":
              document.getElementById("carSuper").className="sub-li";
            case "<?php echo U('Car/index');?>":
            case "<?php echo U('Car/add');?>":
            case "<?php echo U('Car/edit');?>":
            case "<?php echo U('Car/search');?>":
              document.getElementById("Car").className="active";
              break;

            case "<?php echo U('Rent/superManage');?>":
            case "<?php echo U('Rent/superEdit');?>":
              document.getElementById("rentSuper").className="sub-li";
            case "<?php echo U('Rent/index');?>":
            case "<?php echo U('Rent/edit');?>":
            case "<?php echo U('Rent/search');?>":
              document.getElementById("Rent").className="active";
              break;

            case "<?php echo U('Accident/index');?>":
            case "<?php echo U('Accident/add');?>":
            case "<?php echo U('Accident/edit');?>":
            case "<?php echo U('Accident/search');?>":
              document.getElementById("Accident").className="active";
              break;

            case "<?php echo U('Message/nospeak');?>":
              document.getElementById("nospeak").className="sub-li";
            case "<?php echo U('Message/index');?>":
            case "<?php echo U('Message/search');?>":
              document.getElementById("Message").className="active";
              break;

            case "<?php echo U('Admin/index');?>":
            case "<?php echo U('Admin/add');?>":
            case "<?php echo U('Admin/edit');?>":
            case "<?php echo U('Admin/search');?>":
              document.getElementById("Admin").className="active";
              break;

            default:
              break;
          }
        </script>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          	<h2 class="sub-header">租车管理</h2>
	<div class="BeInCenter">
		<h3>修改id=<?php echo ($data["id"]); ?>的记录:</h3>
		<div class="content">
			<form action="<?php echo U('Rent/edit');?>" method="post" class="form-horizontal" role="form">
				<div class="form-group">
					<label class="col-sm-2 control-label">车牌号码</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="license_no" value="<?php echo ($data["license_no"]); ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">订单状态</label>
					<div class="col-sm-10">
						<?php if($data["flag"]==0){ echo "<input type=\"radio\" name=\"flag\" value=\"0\" checked=\"true\">处理中"; echo "<input type=\"radio\" name=\"flag\" value=\"1\">成功"; echo "<input type=\"radio\" name=\"flag\" value=\"-1\">失败"; }else if($data["flag"]==1){ echo "<input type=\"radio\" name=\"flag\" value=\"0\">处理中"; echo "<input type=\"radio\" name=\"flag\" value=\"1\" checked=\"true\">成功"; echo "<input type=\"radio\" name=\"flag\" value=\"-1\">失败"; }else{ echo "<input type=\"radio\" name=\"flag\" value=\"0\">处理中"; echo "<input type=\"radio\" name=\"flag\" value=\"1\">成功"; echo "<input type=\"radio\" name=\"flag\" value=\"-1\" checked=\"true\">失败"; } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">押金状态</label>
					<div class="col-sm-10">
						<?php if($data["g_flag"]){ echo "<input type=\"radio\" name=\"g_flag\" value=\"1\" checked=\"true\">已支付"; echo "<input type=\"radio\" name=\"g_flag\" value=\"0\">未支付"; } else{ echo "<input type=\"radio\" name=\"g_flag\" value=\"1\">已支付"; echo "<input type=\"radio\" name=\"g_flag\" value=\"0\" checked=\"true\">未支付"; } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">取车日期</label>
					<div class="col-sm-10">
						<input type="date" name="draw_date" value="<?php echo ($data["draw_date"]); ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
						<button class="btn btn-success" type="submit" name="submit">修改</button>
					</div>
				</div>
			</form>
		</div>
	</div>
        </div>
      </div>
    </div>

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