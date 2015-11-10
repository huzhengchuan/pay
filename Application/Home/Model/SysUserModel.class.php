<?php

namespace Home\Model;
use Think\Model;
use Think\Log;

class SysUserModel extends Model {

    protected $tablePrefix = 'tbl_';
    protected $tableName = 'sysuser';
    protected $fields = array('Id', 'username', 'email',
			'password');
    protected $pk = array('Id');



}
