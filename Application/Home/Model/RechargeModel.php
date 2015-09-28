<?php

namespace Home\Model;
use Think\Model;
use Think\Log;

class RechargeModel extends Model {

    protected $tablePrefix = 'tbl_';
    protected $tableName = 'recharge';
    protected $fields = array('autoperid', 'rechargeid', 'userid',
			'rechargedate', 'rechargetype', 'currency', 'amount',
			'statue');
    protected $pk = array('autoperid');



}
