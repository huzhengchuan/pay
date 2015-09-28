<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
  <title>Dashboard, Free HTML5 Admin Template</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width">        
  <link rel="stylesheet" href="/pay/Public/css/templatemo_main.css">
</head>
<body>
  <div class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <div class="logo"><h1>个人账户管理</h1></div>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button> 
      </div>   
    </div>
    <div class="template-page-wrapper">
      <div class="navbar-collapse collapse templatemo-sidebar">
        <ul class="templatemo-sidebar-menu">
          <li>
            <form class="navbar-form">
              <input type="text" class="form-control" id="templatemo_search_box" placeholder="Search...">
              <span class="btn btn-default">Go</span>
            </form>
          </li>
          <li class="active"><a href="#"><i class="fa fa-home"></i>个人账户</a></li>
		  <li><a href="/pay/index.php/Home/Recharge/index?userid=<?php echo ($userid); ?>"><i class="fa fa-users"></i><span class="badge pull-right">NEW</span>充值</a></li>
          <li><a href="/pay/index.php/Home/Recharge/HistRecharge?userid=<?php echo ($userid); ?>"><i class="fa fa-cog"></i>充值记录</a></li>
          <li><a href="javascript:;" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>退出</a></li>
        </ul>
      </div><!--/.navbar-collapse -->

      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
          <ol class="breadcrumb">
            <li><a href="index.html">账户管理</a></li>
            <li><a href="#">个人信息</a></li>
          </ol>
               
    

          <div class="row">
           
            <div class="col-md-6">
              <div class="templatemo-progress">
                <div class="list-group">
                  <a href="#" class="list-group-item active">
                    <h4 class="list-group-item-heading">提示</h4>
                    <p class="list-group-item-text">账户交易请确保该网站为指定合法网站。</p>
                  </a>

                </div>
               
              
              </div> 
            </div>
          </div>
          <div class="templatemo-panels">
            <div class="row">
              
              <div class="col-md-6 col-sm-6 margin-bottom-30">
                <div class="panel panel-primary">
                  <div class="panel-heading">用户信息</div>
                  <div class="panel-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>属性</th>
                          <th>内容</th>
                        </tr>
                      </thead>
                      <tbody>
						<tr>
                          <td>用户ID</td>
                          <td><?php echo ($userid); ?></td>
                        </tr>
                        <tr>
                          <td>用户名</td>
                          <td><?php echo ($username); ?></td>
                        </tr>
                        <tr>
                          <td>邮箱</td>
                          <td><?php echo ($email); ?></td>
                        </tr>
                        <tr>
                          <td>杠杆比例</td>
                          <td><?php echo ($levenum); ?></td>
                        </tr>
						<tr>
                          <td>余额</td>
                          <td><?php echo ($balance); ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                
              </div>       
            </div>
			
          </div>    
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">是否需要退出系统</h4>
            </div>
            <div class="modal-footer">
              <button type="button" id="signout" class="btn btn-default">是</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">否</button>
            </div>
          </div>
        </div>
      </div>
	  
      <footer class="templatemo-footer">
        <div class="templatemo-copyright">
          <p>Copyright &copy; 2084 Your Company Name</p>
        </div>
      </footer>
    </div>

    <script src="/pay/Public/js/jquery.min.js"></script>
    <script src="/pay/Public/js/bootstrap.min.js"></script>
    <script src="/pay/Public/js/Chart.min.js"></script>
    <script src="/pay/Public/js/templatemo_script.js"></script>
    <script type="text/javascript">
    $('#signout').click(function () {
      this.window.opener = null;  
	  window.close();  
	});
  </script>
</body>
</html>