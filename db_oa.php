<?php
require 'myPDO.class.php';
$db_oa = myPDO::getInstance('127.0.0.1:3306', 'root', '','isp_oa', 'utf8');
$re_oa = $db_oa->query("SELECT `name`,`coordinate` FROM `ioa_school` WHERE `coordinate` <> 0 ");
foreach ($re_oa as $key => $value) {
    $coordinate = explode(',',$value['coordinate']);
    $res[$value['name']][0] = $coordinate[0];
    $res[$value['name']][1] = $coordinate[1];    
    $res_val[$key]['name'] = $value['name'];
    $res_val[$key]['value'] = rand(99,999);
}unset($db_oa);unset($re_oa);
?>