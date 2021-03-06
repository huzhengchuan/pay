<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
  <title>Trader Work</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width">        
  <link rel="stylesheet" href="/pay/Public/css/templatemo_main.css">
  <link rel="stylesheet" type="text/css" href="/pay/Public/css/easyui/themes/easyui.css">
    <link rel="stylesheet" type="text/css" href="/pay/Public/css/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="/pay/Public/css/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="/pay/Public/css/easyui/demo.css">
    <script type="text/javascript" src="/pay/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/pay/Public/js/jquery.easyui.min.js"></script>
</head>


<script type="text/javascript">
        var url;
        function newUser(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','New User');
            $('#fm').form('clear');
            url = 'save_user.php';
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit User');
                $('#fm').form('load',row);
                url = 'update_user.php?id='+row.id;
            }
        }
        function saveUser(){
            $('#fm').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');        // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
                    if (r){
                        $.post('destroy_user.php',{id:row.id},function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
    </script>
	
    <style type="text/css">
        #fm{
            margin:0;
            padding:10px 30px;
        }
        .ftitle{
            font-size:14px;
            font-weight:bold;
            padding:5px 0;
            margin-bottom:10px;
            border-bottom:1px solid #ccc;
        }
        .fitem{
            margin-bottom:5px;
        }
        .fitem label{
            display:inline-block;
            width:80px;
        }
        .fitem input{
            width:160px;
        }
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
          <li><a href="/pay/index.php/Home/Index/index?userid=<?php echo ($userid); ?>"><i class="fa fa-home"></i>个人账户</a></li>
		<li><a href="/pay/index.php/Home/Recharge/index?userid=<?php echo ($userid); ?>"><i class="fa fa-users"></i><span class="badge pull-right">NEW</span>充值</a></li>
          <li class="active"><a href="#"><i class="fa fa-cog"></i>充值记录</a></li>
          <li><a href="javascript:;" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>退出</a></li>
        </ul>
      </div><!--/.navbar-collapse -->

	<form action="redirect.php" METHOD="POST" name="frm1">	
    <div class="templatemo-content-wrapper" style="width:800px;height:800px">
        <div class="templatemo-content" style="width:800px;height:6px">
				  <ol class="breadcrumb">
					<li><a href="index.html">账户管理</a></li>
					<li><a href="#">充值</a></li>
					<li class="active"></li>
				  </ol>
		  
				<table id="dg" title="充值记录" class="easyui-datagrid" style="width:750px;height:500px"
					url="gethistRecharge?userid=1" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
					<thead>
						<tr>
							<th field="rechargeid" width="100">交易流水号</th>
							<th field="rechargedate" width="70">交易时间</th>
							<th field="rechargetype" width="70">支付方式</th>
							<th field="currentcy" width="70">支付币种</th>
							<th field="amount" width="70">支付金额</th>
							<th field="status" width="100">交易状态</th>
						</tr>
					</thead>
				</table>
			
				  
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
        <p>Copyright &copy; 2084 Your Company Name <!-- Credit: www.templatemo.com --></p>
      </div>
    </footer>
  </div>
</div>
  <script src="/pay/Public/js/jquery.min.js"></script>
  <script src="/pay/Public/js/bootstrap.min.js"></script>
  <script src="/pay/Public/js/templatemo_script.js"></script>
  <script type="text/javascript">
    $('#signout').click(function () {
      this.window.opener = null;  
	  window.close();  
	});
  </script>
</body>
</html>