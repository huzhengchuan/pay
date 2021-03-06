<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
  <title>Dashboard Tables, Free Admin Template</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width">        
  <link rel="stylesheet" href="/pay/Public/css/templatemo_main.css">
</head>


<script type="text/javascript" src="/pay/Public/js/jquery.min"></script>

<script type="text/javascript">

function redirect()
{
	$("#BgDiv").css({ display:"block",height:$(document).height()});
    var yscroll=document.documentElement.scrollTop;
    $("#DialogDiv").css("top","300px");
    $("#DialogDiv").css("display","block");
    document.documentElement.scrollTop=0;	
	
	userid=$("#userid").attr('value');
	password=$("#password").val();
	repassword=$("#repassword").val();
	amount=$("#Amount").val(); 
	currenttype=$("#Currency_Type").val();
	gatewaytype=$("#Gateway_Type").val();
	comments=$("#comments").val();
	
	redirect_url = "redirect?userid="+userid+"&password="+password+"&repassword="+
		repassword+"&currenttype="+currenttype+"&gatewaytype="+gatewaytype+"&comments="+
		comments+"&amount="+amount;
	
	window.open(redirect_url,'target');
	
}

function close_dig()
{
	$("#BgDiv").css("display","none");
    $("#DialogDiv").css("display","none");
	$("#password").val("");
	$("#repassword").val("");
	$("#Amount").val("");
	$("#comments").val("");
	
}
</script>
    <script type="text/javascript">
	
	$("#btnClose").click(function()
        {
            $("#BgDiv").css("display","none");
            $("#DialogDiv").css("display","none");
        });
		

    </script>

    <style type="text/css">
        body,h2{margin:0 ; padding:0;}
        #BgDiv{background-color:#e3e3e3; position:absolute; z-index:99; left:0; top:0; display:none; width:100%; height:1000px;opacity:0.5;filter: alpha(opacity=50);-moz-opacity: 0.5;}
        #DialogDiv{position:absolute;width:400px; left:50%; top:50%; margin-left:-200px; height:auto; z-index:100;background-color:#fff; border:1px #8FA4F5 solid; padding:1px;}
        #DialogDiv h2{ height:25px; font-size:14px; background-color:#8FA4F5; position:relative; padding-left:10px; line-height:25px;}
        #DialogDiv h2 a{position:absolute; right:5px; font-size:12px; color:#000000}
        #DialogDiv .form{padding:10px;}
    </style>


<body>
  <div id="main-wrapper">
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
          <li><a href="../Index?userid=<?php echo ($userid); ?>"><i class="fa fa-home"></i>个人账户</a></li>
          <li class="active"><a href="#"><i class="fa fa-users"></i><span class="badge pull-right">NEW</span>充值</a></li>
          <li><a href="HistRecharge?userid=<?php echo ($userid); ?>"><i class="fa fa-cog"></i>充值记录</a></li>
          <li><a href="javascript:;" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>退出</a></li>
        </ul>
      </div><!--/.navbar-collapse -->
	<form action="redirect.php" METHOD="POST" name="frm1">	
      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
          <ol class="breadcrumb">
            <li><a href="index.html">账户管理</a></li>
            <li><a href="#">充值</a></li>
            <li class="active"></li>
          </ol>

		  <p class="margin-bottom-15">请确保账户信息填写无误.</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="templatemo-preferences-form">
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">商户号</label>
                     <p class="form-control-static" id="username"><?php echo ($Mer_code); ?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label>用户账号</label>
                    <p class="form-control-static" id="username"><?php echo ($username); ?></p>
                  </div>
                  <div class="col-md-6 margin-bottom-15">
                    <label>用户邮箱</label>
                    <p class="form-control-static" id="email"><?php echo ($email); ?></p>
                  </div>
                </div>
    
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="password_1">用户密码</label>
                    <input type="password" class="form-control" id="password" placeholder="用户密码" />  
                  </div>
                  <div class="col-md-6 margin-bottom-15">
                    <label for="password_2">确认密码</label>
                    <input type="password" class="form-control" id="repassword" placeholder="确认密码" />  
                  </div>
                </div>
                
				<div class="row">
                   <div class="col-md-6 margin-bottom-15">
                    <label class="control-label" for="inputSuccess">充值金额</label>
					<input type="text" class="form-control" id="Amount" /> 
                  </div> 
                </div>
				
				<div class="row">
                <div class="col-md-6 margin-bottom-15">
                  <label for="singleSelect">支付币种</label>
                  <select class="form-control margin-bottom-15" id="Currency_Type">
                    <option value="RMB" selected="selected">人民币</option>
                  </select>
                </div>
				</div>
				
				<div class="row">
                <div class="col-md-6 margin-bottom-15">
                  <label for="multipleSelect">支付方式</label>
                  <select  class="form-control margin-bottom-15" id="Gateway_Type">
                    <option value="01" selected="selected">借记卡</option>
                  </select>  
                </div>
				</div>
				
				
              <div class="row">
                <div class="col-md-12 margin-bottom-15">
                  <label for="notes">说明</label>
                  <textarea class="form-control" rows="3" id="comments"></textarea>
                </div>
              </div>
			  
			  <div class="row">
				<div class="col-md-6 margin-bottom-15">
					<input type="hidden" id="userid" name="userid" value="<?php echo ($userid); ?>">
				</div>
			  </div>
			  
              <div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <button type="button" class="btn btn-primary" onclick="redirect()">提交</button>
                  <button type="reset" class="btn btn-default">重置</button>    
                </div>
              </div>
            </form>
          </div>
        </div>
        </div>
      </div>
	  
	  </form>

	  	<div id="BgDiv"></div>
		<div id="DialogDiv" style="display:none">
			<h2><a href="#" id="btnClose"></a></h2>
			请您在新打开的页面上完成付款。<br/>
			付款完成前请不要关闭此窗口。<br/>
			完成付款后请根据您的情况点击下面的按钮：<br>
			<input value="已完成付款" class="but" type="button" id="xxx" onclick="close_dig()"/>
			<input value="付款遇见问题" class="but" type="button" id="yyyy" onclick="close_dig()"/>
		</div>	
		
      <!-- Modal -->
      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Are you sure you want to sign out?</h4>
            </div>
            <div class="modal-footer">
              <a href="sign-in.html" class="btn btn-primary">Yes</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>
		

		
      <footer class="templatemo-footer">
        <div class="templatemo-copyright">
          <p>Copyright &copy; 2084 Your Company Name <!-- Credit: www.templatemo.com --></p>
        </div>
      </footer>
    </div>
</div>
    <script src="/pay/Public/js/jquery.min.js"></script>
    <script src="/pay/Public/js/bootstrap.min.js"></script>
    <script src="/pay/Public/js/templatemo_script.js"></script>
  </body>
</html>