<?php
return array(
	//'配置项'=>'配置值'
	URL_PARAMS_BIND_TYPE => 1 ,
    // 添加数据库配置信息
    'DB_TYPE'=>'mysql',// 数据库类型
    'DB_HOST'=>'127.0.0.1',// 服务器地址
    'DB_NAME'=>'db_trader',// 数据库名
    'DB_USER'=>'root',// 用户名
    'DB_PWD'=>'Wxt130506',// 密码
    'DB_PORT'=>3306,// 端口
    'DB_PREFIX'=>'tbl_',// 数据库表前缀
    'DB_CHARSET'=>'utf8',// 数据库字符
    
    //应用日志打印设置
    'LOG_RECORD' => true,
    'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR,INFO,DEBUG,SQL',
    'LOG_TYPE'              =>  'File',
	
	// 配置邮件发送服务器
    'MAIL_SMTP'                     =>TRUE,
    'MAIL_HOST'                     =>'smtp.qq.com',
    'MAIL_SMTPAUTH'                 =>TRUE,
    'MAIL_USERNAME'                 =>'875161027@qq.com',
    'MAIL_PASSWORD'                 =>'HzcloveWxt130506',
    'MAIL_SECURE'                   =>'tls',
    'MAIL_CHARSET'                  =>'utf-8',
    'MAIL_ISHTML'                   =>TRUE,
	'MAIL_FROMNAME'					=>'trader外汇贸易',
	
);