<?php

namespace Home\Service;
use Think\Model;
use Think\Log;

/*类名：LogService
  类描述：打印本地日志记录在log文件中
*/
class LogService extends Model {

    Protected $autoCheckFields = false;

    public function logError($message)
    {
        Log::write($message, 'ERR');
        Log::save();
    }

    public function logWarn($message)
    {
        Log::write($message, 'WARN');
        Log::save();
    }

    public function logNotice($message)
    {
        Log::write($message, 'NOTICE ');
        Log::save();
    }

    public function logInfo($message)
    {
        Log::write($message, 'INFO');
        Log::save();
    }

    public function logDebug($message)
    {
        Log::write($message, 'DEBUG');
        Log::save();
    }



}
