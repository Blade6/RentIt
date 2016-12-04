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
          switch("/RentIt/index.php/Admin/Message/index.html"){
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
          	<h2 class="sub-header">留言管理</h2>
	<div class="BeInCenter">
		<form action="<?php echo U('Message/search');?>" method="post" class="form-horizontal" role="form">
			<div class="form-group">
				<label>UserID:</label>
				<input type="text" name="userID">
				<button class="btn btn-primary" type="submit" name="search_1">查询</button>
				<label>Date:</label>
				<input type="date" name="date" placeholder="<?php echo ($date); ?>">
				<button class="btn btn-primary" type="submit" name="search_2">查询</button>
				<label>Content:</label>
				<input type="text" name="content">
				<button class="btn btn-primary" type="submit" name="search_3">查询</button>
				<button class="btn btn-success" type="submit" name="order">按时间排序</button>
			</div>
		</form>
	</div>
	<div class="table-reposive">
		<table class="table table-striped">
			<thead>
				<th>id</th>
				<th>UserID</th>
				<th>Date</th>
				<th>Time</th>
				<th>Content</th>
				<th>Action</th>
				<th>DELETE!</th>
			</thead>
			<tbody>
				<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><form action="<?php echo U('Message/delete');?>" method="post">
						<tr>
							<td><?php echo ($data["id"]); ?><input type="hidden" value="<?php echo ($data["id"]); ?>" name="id"></td>
							<td><?php echo ($data["userid"]); ?></td>
							<td><?php echo ($data["date"]); ?></td>
							<td><?php echo ($data["time"]); ?></td>
							<td><?php echo ($data["content"]); ?></td>
							<?php if($data["flag"]==2) echo "<td><button class=\"btn btn-primary\" type=\"submit\" name=\"back\">恢复</button></td>"; else if($data["flag"]==3) echo "<td><button class=\"btn btn-info\" type=\"submit\" name=\"back\">恢复</button></td>"; else echo "<td><button class=\"btn btn-warning\" type=\"submit\" name=\"delete\">删除</button></td>"; ?>
							<td><button class="btn btn-danger" type="submit" name="serious">永久删除</button></td>
						</tr>
					</form><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
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