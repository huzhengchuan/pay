<?php

namespace Home\Model;
use Think\Model;

class FormModel extends Model {

    protected $_validata = array(
	array('title', 'require', '标题必须'),
   );

    protected $_auto = array(
	array('create_time', 'time', 1, 'function'),
    );
}
