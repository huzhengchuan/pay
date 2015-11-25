<?php

namespace Home\Service;
use Think\Model;
use Think\Log;

/*类名：LogService
  类描述：打印本地日志记录在log文件中
*/
class RechargeService extends Model {

    Protected $autoCheckFields = false;

    private $logerSer;

    public function __construct()
    {
        parent::__construct();
        $this->logerSer = D('Log', 'Service');
    }


    public function createRecharge($data)
    {

        $Model = D('Recharge');
        if(NULL == $Model){
            $this->logerSer->logError("Create Recharge Model fail.");
            return false;
        }

        $result = $Model->add($data);
        if($result)
        {
            return true;
        }else{
            $this->logerSer->logError("create recharge info failed.");
            return false;
        }
    }

    public function updateRechargeStatusById($rechargeid, $status)
    {

        $Model = D('Recharge');
        if(NULL == $Model)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }

        $data['status'] = $status;

        $iret =$Model->where('rechargeid='.$rechargeid)->save($data);
        if(false == $iret)
        {
            $this->logerSer->logError("update recharge info failed.");
            return false;
        }
        return true;
    }

    public function getRechargeById($rechargeid)
    {
        if($rechargeid == NULL)
        {
            return NULL;
        }

        $Model = D('Recharge');
        if(NULL == $Model)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }

        $recharge =$Model->where('rechargeid='.$rechargeid)->find();
        if(NULL == $recharge)
        {
            $this->logerSer->logError("find recharge info failed.");
            return NULL;
        }
        return $recharge;

    }

    public function getRechargeByUserId($userid)
    {
        $Model = D('Recharge');
        if(NULL == $Model)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }

        $list =$Model->where('userid='.$userid)->select();
        if(NULL == $list)
        {
            $this->logerSer->logError("find recharge info failed.");
            return NULL;
        }
        return $list;
    }

    public function getRechargeNumByUserId($userid)
    {
        $Model = D('Recharge');
        if(NULL == $Model)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }

        $num =$Model->where('userid='.$userid)->count();
        return $num;
    }

    public function getRangeRechargeInfoByUserId($userid, $from, $to)
    {
        $Model = D('Recharge');
        if(NULL == $Model)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }

        $list =$Model->where('userid='.$userid)->limit($from,$to)->select();
        if(NULL == $list)
        {
            $this->logerSer->logError("find recharge info failed.");
            return NULL;
        }
        return $list;
    }

    public function getAllRechargeCount()
    {
        $Model = D('Recharge');
        if(NULL == $Model)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }

        $num =$Model->count();
        return $num;
    }

    public function getRangeRecharge()
    {
        $Model = D('Recharge');
        if(NULL == $Model)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }

        $list =$Model->limit($from,$to)->select();
        if(NULL == $list)
        {
            $this->logerSer->logError("find recharge info failed.");
            return NULL;
        }
        return $list;
    }



}
