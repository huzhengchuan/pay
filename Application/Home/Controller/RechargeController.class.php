<?php
namespace Home\Controller;
use Think\Controller;
class RechargeController extends Controller {

    private $toolkitSer;
    private $logerSer;
    private $userSer;
    private $companySer;
    private $rechargeSer;

    public function __construct()
    {
        parent::__construct();
        $this->logerSer = D('Log', 'Service');
        $this->toolkitSer = D('ToolKit', 'Service');
        $this->userSer = D('User', 'Service');
        $this->companySer = D('Company', 'Service');
        $this->rechargeSer = D('Recharge', 'Service');
    }

    public function index()
    {

        $userId = $_GET['userid'];
        if(NULL == $userId)
        {
            $this->logerSer->logError("The userid in https is not right");
            echo "System Inner Error.";
            return;
        }

        $user = $this->userSer->getUserFromDBByUserId($userId);
        if($user == NULL)
        {
            $this->logerSer->logError("The user is not exist.");
            echo "The user is not exist.";
            return;
        }

        $company = $this->companySer->getCompanyConf();
        if($company == NULL)
        {
            $this->logerSer->logError("The company is not right in db.");
            echo "The company is not right in db.";
            return;
        }

        $this->assign('Mer_code',$company['companyid']);
        $this->assign('Mer_Key', $company['certificate']);
        $this->assign('form_url', $company['rechargeurl']);
        $this->assign('username', $user['petname']);
        $this->assign('email', $user['email']);
        $this->assign('userid', $user['userid']);
        $this->display();
    }

    public function redirect()
    {
        $company = $this->companySer->getCompanyConf();
        if($company == NULL)
        {
            $this->logerSer->logError("The company is not right in db.");
            print("The company is not right in db.");
            return;
        }

        $userId = $_GET['userid'];
        $password = $_GET['password'];
        $repassword = $_GET['repassword'];
        if($password != $repassword)
        {
            $this->logerSer->logError("The password is not same.");
            print("The password is not same.".$password.$repassword);
            return;
        }
        $user = $this->userSer->getUserFromDBByUserId($userId);
        if(NULL == $user || $user['password'] != $password)
        {
            $this->logerSer->logError("The user is not exist.");
            print("The user is not exist!");
            return;
        }
        $billNo = date('YmdHis') . mt_rand(100000,999999);
        $amount = $_GET['amount'];
        $billDate = date('Ymd');
        $currencytype = $_GET['currenttype'];
        $gateway_Type = $_GET['gatewaytype'];
        $lang = "GB";
        $dispAmount = "0.01";
        $encodeType = "5";
        $retEncodeType = 17;

        $orge = 'billno'.$billNo.'currencytype'.$currencytype.'amount'.$amount.'date'.$billDate.'orderencodetype'.$encodeType.$company['certificate'];
        $signMD5 = md5($orge);

        /* 将贸易写入到db中 */
        $recharge['rechargeid'] = $billNo;
        $recharge['userid'] = $userId;
        $recharge['rechargedate'] = $billDate;
        $recharge['rechargetype'] = $gateway_Type;
        $recharge['currency'] = $currencytype;
        $recharge['amount'] = $amount;
        $recharge['status'] = "recharging";
        $ret = $this->rechargeSer->createRecharge($recharge);
        if(false == $ret)
        {
            $this->logerSer->logError("Create recharge to db failed.");
            print("The Recharge to db failed.");
            return;
        }

        //将贸易信息写入到db中
        $this->assign("form_url", $company['rechargeurl']);
        $this->assign('Mer_code',$company['companyid']);
        $this->assign('Mer_Key', $company['certificate']);
        $this->assign('Billno', $billNo);
        $this->assign('Amount', $amount);
        $this->assign('Date', $billDate);
        $this->assign('Currency_Type', $currencytype);
        $this->assign('Gateway_Type', $gateway_Type);
        $this->assign('Lang', $lang);
        $this->assign('Merchanturl', $company['backurl']);
        $this->assign('FailUrl', $company['backurl']);
        $this->assign('ErrorUrl', $company['backurl']);
        $this->assign('Attach', "");
        $this->assign('DispAmount', $dispAmount);
        $this->assign('OrderEncodeType', $encodeType);
        $this->assign('RetEncodeType', $retEncodeType);
        $this->assign('Rettype', "0");
        $this->assign('ServerUrl', "");
        $this->assign('SignMD5', $signMD5);

        $this->display();
    }

	public function redirect_callback()
	{
		//环迅交易完成处理接口
        $billno = $_GET['billno'];
        $amount = $_GET['amount'];
        $mydate = $_GET['date'];
        $succ = $_GET['succ'];
        $msg = $_GET['msg'];
        $attach = $_GET['attach'];
        $ipsbillno = $_GET['ipsbillno'];
        $retEncodeType = $_GET['retencodetype'];
        $currency_type = $_GET['Currency_type'];
        $signature = $_GET['signature'];

        $company = $this->companySer->getCompanyConf();
        if($company == NULL)
        {
            $errorMsg = "The company is not right in db.";
            $this->logerSer->logError($errorMsg);
            $this->assign('billno', $billno);
            $this->assign('ErrorMsg', $errorMsg);
            $this->display();
            return;
        }
        $content = 'billno'.$billno.'currencytype'.$currency_type.'amount'.$amount.'date'.$mydate.'succ'.$succ.'ipsbillno'.$ipsbillno.'retencodetype'.$retEncodeType;

        $cert = $company['certificate'];
        $signature_1ocal = md5($content . $cert);

        $recharge = $this->rechargeSer->getRechargeById($billno);
        if($recharge == NULL)
        {
            $errorMsg = "The recharge is not exist.";
            $this->logerSer->logError($errorMsg);
            $this->assign('billno', $billno);
            $this->assign('ErrorMsg', $errorMsg);
            $this->display();

            return;
        }

        if ($signature_1ocal == $signature)
        {

            if ($succ == 'Y')
            {
                if($amount != $recharge['amount'])
                {
                    $this->rechargeSer->updateRechargeStatusById($recharge['rechargeid'], 'failed');
                    $errorMsg = "The amount is not right.";
                }
                else
                {
                    $ret = $this->userSer->addBalance($recharge['userid'], $recharge['amount']);
                    if(false == $ret)
                    {
                        $this->rechargeSer->updateRechargeStatusById($recharge['rechargeid'], 'failed');
                        $errorMsg = "The recharge failed.";
                    }
                    else
                    {
                        $this->rechargeSer->updateRechargeStatusById($recharge['rechargeid'], 'succeed');
                        $errorMsg = "The recharge succeed.";
                    }
                }
            }
            else
            {
                $this->rechargeSer->updateRechargeStatusById($recharge['rechargeid'], 'failed');
                $errorMsg = "The recharge is failed.";
            }
        }
        else
        {
            $this->rechargeSer->updateRechargeStatusById($recharge['rechargeid'], 'failed');
            $errorMsg = "The recharge is not failed, because the signature is not right.";
        }

        $this->logerSer->logError($errorMsg);
        $this->assign('billno', $billno);
        $this->assign('ErrorMsg', $errorMsg);
        $this->display();
	}

    public function HistRecharge()
    {
        $this->assign("userid", $_GET['userid']);
        $this->display();
    }

    public function getHistRecharge()
    {

        $pageSize = $_POST['rows'];
        $pageNo = $_POST['page'];
        $userid = $_GET['userid'];
        $this->logerSer->logInfo("rows:$pageSize page:$pageNo userid=$userid");

        $totalNum = $this->rechargeSer->getRechargeNumByUserId($userid);

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

        $hists = $this->rechargeSer->getRangeRechargeInfoByUserId($userid, $rangFrom, $rangEnd);
        if(NULL == $hists)
        {
            $this->logerSer->logError("Get hist recharges failed.");
            return;
        }

        $count = $totalNum;
        $rows = array();
        foreach($hists as $hist)
        {
            $obj = new  \stdClass;
            $obj->rechargeid = $hist['rechargeid'];
            $obj->userid = $hist['userid'];
            $obj->rechargedate = $hist['rechargedate'];
            $obj->rechargetype= $hist['rechargetype'];
            $obj->currentcy = $hist['currency'];
            $obj->amount = $hist['amount'];
            $obj->status = $hist['status'];
            $rows[] = $obj;
        }
        $output = new \stdClass;
        $output->total = $count;
        $output->rows = $rows;
        $this->ajaxReturn($output , 'JSON');
        return;
    }


}
