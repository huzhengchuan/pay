<?php

namespace Home\Service;
use Think\Model;
use Think\Log;

/****************************************************************
类名：OperLogService
类描述：记录所有操作日志信息
备注:
*****************************************************************/
class OperLogService extends Model {

    Protected $autoCheckFields = false;

    private $logerSer;
    private $userSer;
    private $toolkitSer;


    public function __construct()
    {
        parent::__construct();
        $this->logerSer = D('Log', 'Service');
        $this->userSer = D('User', 'Service');
        $this->toolkitSer = D('ToolKit', 'Service');
    }

    public function getOperLogCountByUser($userid, $ipKey, $rangStart, $rangEnd)
    {
        $Model = D('OperLog');

        if(NULL == $Model)
        {
             $this->logerSer->logError("Execute sql failed.");
            return false;
        }
        $condition['userid'] = $userid;
        if($ipKey != NULL and $ipKey != "")
        {
            $condition['ipaddr'] = $ipKey;
        }
        $result = $Model->where($condition)->limit($rangStart,$rangEnd)->count();
        return $result;
    }

    public function  getOperLogForSearch($userid, $ipKey, $timeStart, $timeEnd, $rangStart, $rangEnd)
    {
        $Model = D('OperLog');

        if(NULL == $Model)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }
        $condition['userid'] = $userid;
        $condition['operdate']  >= $timeStart;
        $condition['_string']  = "operdate >= '$timeStart' and operdate <= '$timeEnd'";
        if($ipKey != NULL and $ipKey != "")
        {
            $condition['ipaddr'] = $ipKey;
        }
        $result =$Model->where($condition)->limit($rangStart,$rangEnd)->select();
        return $result;
    }

    public function getNextOperLogId()
    {
        $Model = D('OperLog');
        if(NULL == $Model){
            $this->logerSer->logError("Execute sql failed.");
            return NULL;
        }
        $max_tradeId = $Model->fetchSql(false)->max('operid');
        return ($max_tradeId + 1);
    }

    public function addOperLog($log)
    {
        $Model = D('OperLog');
        if(NULL == $Model)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }

        $iret =$Model->add($log);
        if(false == $iret)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }
        return true;
    }

    /****************************************************************
    函数名：record save
    功能描述：接口，实现添加订单的
    备注: 接口  order/open
    *****************************************************************/
    public function  recordOperLog($userid, $ipaddr, $context)
    {
        $log['operdate'] = $this->toolkitSer->getSysTime();
        $log['operid'] = $this->getNextOperLogId();
        $log['userid'] = $userid;
        $log['ipaddr'] = $ipaddr;
        $log['opercontent'] = $context;

        return $this->addOperLog($log);
    }


}
