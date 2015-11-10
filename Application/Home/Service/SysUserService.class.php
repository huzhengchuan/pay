<?php

namespace Home\Service;
use Think\Model;
use Think\Log;

/*类名：LogService
  类描述：打印本地日志记录在log文件中
*/
class SysUserService extends Model {

    Protected $autoCheckFields = false;

    private $logerSer;

    public function __construct()
    {
        parent::__construct();
        $this->logerSer = D('Log', 'Service');
    }

    public function getUserByEmail($email)
    {
        $Model = D('SysUser');
        if(NULL == $Model){
            $this->logerSer->logError("Create User Model fail.");
            return NULL;
        }

        $data = $Model->fetchSql(false)->where('email="'.$email.'"')->find();
        return $data;
    }



}
