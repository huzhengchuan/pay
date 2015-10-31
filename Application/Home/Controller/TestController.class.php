<?php
namespace Home\Controller;
use Think\Controller;
use \Think\Log ;

class TestController extends Controller {

    public function Index()
    {
        Log::record($account."".$pwd) ;
        $this->display();
    }
	 public function checkLogin()
     {
        $verify = new \Think\Verify();
        if($verify->check(I('post.code'))){
            if(I('post.user')==C('admin') && I('post.pwd') == C('123456')){
                session('admin','com.vix.test'); 
                $this->success('登陆成功',U('Home/Admin/index'),2);
            }else{
                $this->error('用户名或密码错误',U('Home/Index/login'),3);
            }
        }else{
            $this->error('验证码错误',U('Home/Index/login'),3);
        }
        return;
    }

    public function verify()
    {
        $config = array(
            'fontSize' => 16, // 验证码字体大小
            'length' => 4, // 验证码位数
            'imageH' => 40,
            'imageW' => 210,
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
}
