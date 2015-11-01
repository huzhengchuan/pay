<?php

namespace Home\Model;
use Think\Model;
use Think\Log;

class DrawChargeModel extends Model {

    protected $tablePrefix = 'tbl_';
    protected $tableName = 'drawcharge';
    protected $fields = array('autooperid', 'drawid', 'userid',
			'drawdate', 'currency', 'amount', 'bank',
			'bankcardnum', 'status');
    protected $pk = array('autooperid');



}
