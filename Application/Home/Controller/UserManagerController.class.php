<?php
namespace Home\Controller;
use Think\Controller;
class UserManagerController extends Controller {

    private $toolkitSer;
    private $logerSer;
    private $userSer;

    public function __construct()
    {
        parent::__construct();
        $this->logerSer = D('Log', 'Service');
        $this->toolkitSer = D('ToolKit', 'Service');
        $this->userSer = D('User', 'Service');
    }


	public function index()
    {
        $this->display();
        return;
    }

    public function loginIn()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $this->logerSer->logInfo("userId:$userId");

        $user = $this->userSer->getUserByAccount($email, 'email');
        if(NULL == $user || $user['password'] != $password)
        {
            $this->logerSer->logError("user auth failed.");
            $this->assign('ErrorMsg', "The user auth failed.");
            $this->display('index');
            return;
        }

        if(1 != $user['ischeck'])
        {
            $this->logerSer->logError("user is check failed.");
            $this->assign('ErrorMsg', "The user is checking.");
            $this->display('index');
            return;
        }

        $this->assign('userid', $user['userid']);
        $this->assign('username', $user['petname']);
        $this->assign('email', $user['email']);
        $this->assign('userid', $user['userid']);
        $this->assign('levenum', $user['levenum']);
        $this->assign('balance', $user['balance']);
        $this->assign('usertype', $user['usertype']);
        $this->assign('userstatus', $user['userstatus']);
        $this->display('mainpage');
        return;
    }
}
