<?php

namespace Home\Service;
use Think\Model;
use Think\Log;

/*类名：CompanyService
  类描述：打印本地日志记录在log文件中
*/
class CompanyService extends Model {

    Protected $autoCheckFields = false;

    private $logerSer;

    public function __construct()
    {
        parent::__construct();
        $this->logerSer = D('Log', 'Service');
    }

    /*********************************************************************
    function:JudgeAccountType 判读account的类型
    intput: account
    output: phone/email/other
    *********************************************************************/
    public  function getCompanyConf()
    {
        $Model = M('Company');
        if(NULL == $Model){
            $this->logerSer->logError("Create company Model fail.");
            return NULL;
        }
        $data = $Model->fetchSql(false)->find();
        return $data;
    }


}
