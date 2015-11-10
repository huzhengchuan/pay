<?php
namespace Home\Controller;
use Think\Controller;
use \Think\Log ;

class LoginController extends Controller {

    private $sysUserSer;

    public function __construct()
    {
        parent::__construct();
        $this->sysUserSer = D('SysUser', 'Service');
    }

    public function Index()
    {
        $this->display();
    }

    public function loginIn()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->sysUserSer->getUserByEmail($email);
        if($user == NULL || $user['password'] != $password)
        {
            $this->display('index');
            return;
        }
        $this->display('SysManager:index');
        return;

    }


}
