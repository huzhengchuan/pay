<?php

namespace Home\Model;
use Think\Model;
use Think\Log;

class UserModel extends Model {

    protected $tablePrefix = 'tbl_';
    protected $tableName = 'company';
    protected $fields = array('autocompanyid', 'companyid', 'certificate',
			'rechargemodel', 'rechargeurl', 'backurl');
    protected $pk = array('autocompanyid');



}
