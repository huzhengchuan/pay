<?php

namespace Home\Model;
use Think\Model;
use Think\Log;

class OrderModel extends Model {

    protected $tablePrefix = 'tbl_';
    protected $tableName = 'trade';
    protected $fields = array('autotradeid', 'tradeid', 'userid',
			'goodname', 'tradetype', 'tradenum', 'operstarttime',
            'operstartprice', 'operendtime', 'operendprice',
			'stoplossprice', 'stopgainprice', 'gainedmoney','commission',
            'interest', 'limitpricetype', 'limitprice', 'deadline', 'comments');
    protected $pk = array('autotradeid');


}
