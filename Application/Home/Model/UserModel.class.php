<?php

namespace Home\Model;
use Think\Model;
use Think\Log;

class UserModel extends Model {

    protected $tablePrefix = 'tbl_';
    protected $tableName = 'user';
    protected $fields = array('autouserid', 'userid', 'username',
			'email', 'petname', 'password', 'sex',
			'birthday', 'country', 'address', 'postcode',
			'phonenum', 'mobilenum', 'identitynum',
			'ischeck', 'levenum', 'balance', 'authnum', 'userAvatar',
            'reemail', 'reemailchecksum', 'rephone', 'rephonechecksum',
            'repasswordchecksum');
    protected $pk = array('autouserid');



}
