<?php
/**
 * @Author: huzhengchuan
 * @Date:   2015-10-31 02:44:30
 * @Last Modified by:   anchen
 * @Last Modified time: 2015-11-10 21:30:48
 */
namespace Home\Controller;
use Think\Controller;

class SysManagerController extends Controller {

    private $toolkitSer;
    private $logerSer;
    private $userSer;
    private $rechargeSer;
    private $drawchargeSer;
    private $orderSer;
    private $sysUserSer;

    public function __construct()
    {
        parent::__construct();
        $this->logerSer = D('Log', 'Service');
        $this->toolkitSer = D('ToolKit', 'Service');
        $this->userSer = D('User', 'Service');
        $this->rechargeSer = D('Recharge', 'Service');
        $this->drawchargeSer = D('Drawcharge', 'Service');
        $this->orderSer = D('Order', 'Service');
        $this->sysUserSer = D('SysUser', 'Service');
    }


    public function splitePage($totalNum, $pageSize, $pageNo)
    {

        $rangFrom = 0;
        $rangEnd = 0;
        $pageNum = (int)($totalNum/$pageSize);
        if(($totalNum - $pageSize*$pageNum) > 0)
        {
            $pageNum = $pageNum + 1;
        }
        $rangFrom = 0;
        $rangEnd = 0;
        if($pageNo != $pageNum)
        {
            $rangFrom = ($pageNo - 1)*$pageSize;
            $rangEnd = $pageNo*$pageSize;
        }else{
            $rangFrom = ($pageNum - 1)*$pageSize;
            $rangEnd = $totalNum;
        }

        return array('rangFrom' => $rangFrom, 'rangEnd' => $rangEnd);
    }

    public function getUserList()
    {

        $pageSize = $_POST['rows'];
        $pageNo = $_POST['page'];
        $this->logerSer->logInfo("rows:$pageSize page:$pageNo");

        $totalNum = $this->userSer->getAllUsersCount();

        $splitePage = $this->splitePage($totalNum, $pageSize, $pageNo);

        $users = $this->userSer->getRangeUsers($splitePage['rangFrom'], $splitePage['rangEnd']);
        if(NULL == $users)
        {
            $this->logerSer->logError("Get users failed.");
            return;
        }

        $count = $totalNum;
        $rows = array();
        foreach($users as $user)
        {
            $obj = new  \stdClass;
            $obj->userid = $user['userid'];
            $obj->username = $user['username'];
            $obj->petname = $user['petname'];
            $obj->phonenum = $user['phonenum'];
            $obj->email = $user['email'];
            $obj->levenum = $user['levenum'];
            $obj->balance = $user['balance'];
            $obj->bindbank = $user['bindbank'];
            $obj->bindcardnum = $user['bindcardnum'];
            $obj->usertype = $user['usertype'];
            $obj->userstatus = $user['userstatus'];
            $rows[] = $obj;
        }
        $output = new \stdClass;
        $output->total = $count;
        $output->rows = $rows;
        $this->ajaxReturn($output , 'JSON');
        return;
    }

    public function sysRecharge()
    {
        $this->display();
        return;
    }

    public function sysGetRechargeList()
    {
        $pageSize = $_POST['rows'];
        $pageNo = $_POST['page'];
        $this->logerSer->logInfo("rows:$pageSize page:$pageNo");

        $totalNum = $this->rechargeSer->getAllRechargeCount();

        $splitePage = $this->splitePage($totalNum, $pageSize, $pageNo);

        $recharges = $this->rechargeSer->getRangeRecharge($splitePage['rangFrom'], $splitePage['rangEnd']);
        if(NULL == $recharges)
        {
            $this->logerSer->logError("Get users failed.");
            return;
        }

        $count = $totalNum;
        $rows = array();
        foreach($recharges as $recharge)
        {
            $obj = new  \stdClass;
            $obj->rechargeid = $recharge['rechargeid'];
            $obj->userid = $recharge['userid'];

            $user = $this->userSer->getUserFromDBByUserId($recharge['userid']);
            if($user != NULL)
            {
                $obj->username = $user['petname'];
            }
            $obj->rechargedate = $recharge['rechargedate'];
            $obj->currency = $recharge['currency'];
            $obj->amount = $recharge['amount'];
            $obj->status = $recharge['status'];
            $rows[] = $obj;
        }
        $output = new \stdClass;
        $output->total = $count;
        $output->rows = $rows;
        $this->ajaxReturn($output , 'JSON');
        return;
    }

    public function sysDrawcharge()
    {
        $this->display();
        return;
    }

    public function sysGetDrawchargeList()
    {
        $pageSize = $_POST['rows'];
        $pageNo = $_POST['page'];
        $this->logerSer->logInfo("rows:$pageSize page:$pageNo");

        $totalNum = $this->drawchargeSer->getAllDrawchargeCount();

        $splitePage = $this->splitePage($totalNum, $pageSize, $pageNo);

        $drawcharges = $this->drawchargeSer->getRangeDrawcharge($splitePage['rangFrom'], $splitePage['rangEnd']);
        if(NULL == $drawcharges)
        {
            $this->logerSer->logError("Get users failed.");
            return;
        }

        $count = $totalNum;
        $rows = array();
        foreach($drawcharges as $drawcharge)
        {
            $obj = new  \stdClass;
            $obj->drawid = $drawcharge['drawid'];
            $obj->userid = $drawcharge['userid'];

            $user = $this->userSer->getUserFromDBByUserId($drawcharge['userid']);
            if($user != NULL)
            {
                $obj->username = $user['petname'];
            }
            $obj->drawdate = $drawcharge['drawdate'];
            $obj->currency = $drawcharge['currency'];
            $obj->amount = $drawcharge['amount'];
            $obj->bank = $drawcharge['bank'];
            $obj->bankcardnum = $drawcharge['bankcardnum'];
            $obj->status = $drawcharge['status'];
            $rows[] = $obj;
        }
        $output = new \stdClass;
        $output->total = $count;
        $output->rows = $rows;
        $this->ajaxReturn($output , 'JSON');
        return;
    }

    public function sysPendingTrader()
    {
        $this->display();
        return;
    }

    public function sysGetPendingTradeList()
    {
        $pageSize = $_POST['rows'];
        $pageNo = $_POST['page'];
        $this->logerSer->logInfo("rows:$pageSize page:$pageNo");

        $totalNum = $this->orderSer->getAllPendingOrderCount();

        $splitePage = $this->splitePage($totalNum, $pageSize, $pageNo);

        $orders = $this->orderSer->getRangePendingOrders($splitePage['rangFrom'], $splitePage['rangEnd']);
        if(NULL == $orders)
        {
            $this->logerSer->logError("Get orders failed.");
            return;
        }

        $count = $totalNum;
        $rows = array();
        foreach($orders as $order)
        {
            $obj = new  \stdClass;
            $obj->tradeid = $order['tradeid'];
            $obj->userid = $order['userid'];

            $user = $this->userSer->getUserFromDBByUserId($order['userid']);
            if($user != NULL)
            {
                $obj->username = $user['petname'];
            }
            $obj->goodname = $order['goodname'];
            $obj->tradetype = $this->orderSer->tradeTypeSwitchName($order['tradetype']);
            $obj->tradenum = $order['tradenum'];
            $obj->operstarttime = $order['operstarttime'];
            $obj->operstartprice = $order['operstartprice'];
            $obj->stopgainprice = $order['stopgainprice'];
            $obj->stoplossprice = $order['stoplossprice'];
            $rows[] = $obj;
        }
        $output = new \stdClass;
        $output->total = $count;
        $output->rows = $rows;
        $this->ajaxReturn($output , 'JSON');
        return;
    }


    public function sysTrader()
    {
        $this->display();
        return;
    }

    public function sysGetTradeList()
    {
        $pageSize = $_POST['rows'];
        $pageNo = $_POST['page'];
        $this->logerSer->logInfo("rows:$pageSize page:$pageNo");

        $totalNum = $this->orderSer->getAllOnlineOrderCount();

        $splitePage = $this->splitePage($totalNum, $pageSize, $pageNo);

        $orders = $this->orderSer->getRangeOnlineOrders($splitePage['rangFrom'], $splitePage['rangEnd']);
        if(NULL == $orders)
        {
            $this->logerSer->logError("Get orders failed.");
            return;
        }

        $count = $totalNum;
        $rows = array();
        foreach($orders as $order)
        {
            $obj = new  \stdClass;
            $obj->tradeid = $order['tradeid'];
            $obj->userid = $order['userid'];

            $user = $this->userSer->getUserFromDBByUserId($order['userid']);
            if($user != NULL)
            {
                $obj->username = $user['petname'];
            }
            $obj->goodname = $order['goodname'];
            $obj->tradetype = $this->orderSer->tradeTypeSwitchName($order['tradetype']);
            $obj->tradenum = $order['tradenum'];
            $obj->operstarttime = $order['operstarttime'];
            $obj->operstartprice = $order['operstartprice'];
            $obj->stopgainprice = $order['stopgainprice'];
            $obj->stoplossprice = $order['stoplossprice'];
            $rows[] = $obj;
        }
        $output = new \stdClass;
        $output->total = $count;
        $output->rows = $rows;
        $this->ajaxReturn($output , 'JSON');
        return;
    }

    public function sysHistTrader()
    {
        $this->display();
        return;
    }

    public function sysGetHistTradeList()
    {
        $pageSize = $_POST['rows'];
        $pageNo = $_POST['page'];
        $this->logerSer->logInfo("rows:$pageSize page:$pageNo");

        $totalNum = $this->orderSer->getAllHistOrderCount();

        $splitePage = $this->splitePage($totalNum, $pageSize, $pageNo);

        $orders = $this->orderSer->getRangeHistOrders($splitePage['rangFrom'], $splitePage['rangEnd']);
        if(NULL == $orders)
        {
            $this->logerSer->logError("Get orders failed.");
            return;
        }

        $count = $totalNum;
        $rows = array();
        foreach($orders as $order)
        {
            $obj = new  \stdClass;
            $obj->tradeid = $order['tradeid'];
            $obj->userid = $order['userid'];

            $user = $this->userSer->getUserFromDBByUserId($order['userid']);
            if($user != NULL)
            {
                $obj->username = $user['petname'];
            }
            $obj->goodname = $order['goodname'];
            $obj->tradetype = $this->orderSer->tradeTypeSwitchName($order['tradetype']);
            $obj->tradenum = $order['tradenum'];
            $obj->operstarttime = $order['operstarttime'];
            $obj->operstartprice = $order['operstartprice'];
            $obj->stopgainprice = $order['stopgainprice'];
            $obj->stoplossprice = $order['stoplossprice'];
            $obj->gainedmoney = $order['gainedmoney'];
            $rows[] = $obj;
        }
        $output = new \stdClass;
        $output->total = $count;
        $output->rows = $rows;
        $this->ajaxReturn($output , 'JSON');
        return;
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
        $this->display('SysManager:mainpage');
        return;

    }

}
