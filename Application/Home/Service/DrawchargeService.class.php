<?php

namespace Home\Service;
use Think\Model;
use Think\Log;

/**
 *
 */
class DrawchargeService extends Model {

    Protected $autoCheckFields = false;

    private $logerSer;

    public function __construct()
    {
        parent::__construct();
        $this->logerSer = D('Log', 'Service');
    }


    public function createDrawcharge($data)
    {

        $Model = D('Drawcharge');
        if(NULL == $Model){
            $this->logerSer->logError("Create Drawcharge Model fail.");
            return false;
        }

        $result = $Model->add($data);
        if($result)
        {
            return true;
        }else{
            $this->logerSer->logError("create Drawcharge info failed.");
            return false;
        }
    }

    public function updateDrawchargeStatusById($drawid, $status)
    {

        $Model = D('Drawcharge');
        if(NULL == $Model)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }

        $data['status'] = $status;

        $iret =$Model->where('drawid='.$drawid)->save($data);
        if(false == $iret)
        {
            $this->logerSer->logError("update Drawcharge info failed.");
            return false;
        }
        return true;
    }

    public function getDrawchargeById($drawid)
    {
        $Model = D('Drawcharge');
        if(NULL == $Model)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }

        $drawcharge =$Model->where('drawid='.$drawid)->find();
        if(NULL == $drawcharge)
        {
            $this->logerSer->logError("find Drawcharge info failed.");
            return NULL;
        }
        return $drawcharge;

    }

    public function getDrawchargeByUserId($userid)
    {
        $Model = D('Drawcharge');
        if(NULL == $Model)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }

        $list =$Model->where('userid='.$userid)->select();
        if(NULL == $list)
        {
            $this->logerSer->logError("find Drawcharge info failed.");
            return NULL;
        }
        return $list;
    }

    public function getDrawchargeNumByUserId($userid)
    {
        $Model = D('Drawcharge');
        if(NULL == $Model)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }

        $num =$Model->where('userid='.$userid)->count();
        return $num;
    }

    public function getRangeDrawchargeInfoByUserId($userid, $from, $to)
    {
        $Model = D('Drawcharge');
        if(NULL == $Model)
        {
            $this->logerSer->logError("Execute sql failed.");
            return false;
        }

        $list =$Model->where('userid='.$userid)->limit($from,$to)->select();
        if(NULL == $list)
        {
            $this->logerSer->logError("find Drawcharge info failed.");
            return NULL;
        }
        return $list;
    }


}
