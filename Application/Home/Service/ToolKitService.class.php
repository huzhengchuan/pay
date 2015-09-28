<?php

namespace Home\Service;
use Think\Model;
use Think\Log;

/*类名：ToolKitService
  类描述：处理与UI与内部数据结构不一致性
*/
class ToolKitService extends Model {

    Protected $autoCheckFields = false;

    private $logerSer;

    public function __construct()
    {
        parent::__construct();
        $this->logerSer = D('Log', 'Service');
    }

    public function sendMessageByPhone($phone, $passcode)
    {
        //发送消息到手机
        return  true;
    }

    public function sendMessageByEmail($email, $passcode)
    {
        //发送消息给到邮箱
        $content="尊敬的用户，您正在申请对外汇平台账号进行操作，操作验证码为:".$passcode;
        $subject = "外汇交易平台校验码测试";
        $this->logerSer->logInfo("email=".$email);
        return sendMail($email, $subject, $content);
    }

    public function SendAuthNumToUser($authtype, $account, $authnum)
    {
        if($authtype == "phone")
        {
            return $this->sendMessageByPhone($account, $authnum);
        }else if ($authtype  == "email")
        {
            return $this->sendMessageByEmail($account, $authnum);
        }

    }


    public function makeRandomPasscode()
    {
        //生成一个随机码作为校验码
        $pattern='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        $key = "";
        $length = 4;
        for($i=0;$i<$length;$i++){
             $key .=$pattern{mt_rand(0,35)};
        }
        return $key;
    }

    public function getSysTime()
    {
        date_default_timezone_set('Asia/Chongqing'); //系统时间差8小时问题
        $date = date("Y/m/d H:i:s");
        return $date;
    }

    public function formatTime($time)
    {
        date_default_timezone_set('Asia/Chongqing'); //系统时间差8小时问题
        $format_time = date("Y/m/d H:i:s", strtotime($time));
        return $format_time;
    }

    public function getClientIP()
    {
        /*
        $ip = $_server['remote_addr'];
        if (!empty($_server['http_client_ip'])) {
            $ip = $_server['http_client_ip'];
        } elseif (!empty($_server['http_x_forwarded_for']))
        {
            $ip = $_server['http_x_forwarded_for'];
        }
        */
       $ip = "127.0.0.1";
        return $ip;
    }



}
