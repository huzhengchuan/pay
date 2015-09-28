<?php

namespace Home\Model;
use Think\Model;
use Think\Log;

/*类名：UserModel
  类描述：操作日志类，对应的数据类型为数据库中的tbl_oper表结构
  提供对该表的CUBA操作
*/
class OperLogModel extends Model {

    protected $tablePrefix = 'tbl_';
    protected $tableName = 'oper';
    protected $fields = array('autooperid', 'operid', 'operdate',
			'userid', 'ipaddr', 'opercontent');
    protected $pk = array('autooperid');



}
