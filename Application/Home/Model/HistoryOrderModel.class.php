<?php

namespace Home\Model;
use Think\Model;
use Think\Log;

class HistoryOrderModel extends Model {

    protected $tablePrefix = 'tbl_';
    protected $tableName = 'historytrade';
    protected $fields = array('autotradeid', 'tradeid', 'userid',
			'goodname', 'tradetype', 'tradenum', 'operstarttime','operstartprice',
            'operendtime', 'operendprice', 'gainedmoney', 'commission',
			'stoplossprice', 'stopgainprice', 'interest', 'istrade');
    protected $pk = array('autotradeid');



}
