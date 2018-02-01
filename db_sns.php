<?php
$db_sns = myPDO::getInstance('127.0.0.1:3306', 'root','', 'isp_sns', 'utf8');
$res_sns = $db_sns->query("select a.school_id,b.name,count(a.id) as peop_num from isns_user_class a, isns_ioa_school b where  a.school_id = b.school_id group by school_id");
$timestart = mktime(-24,0,0, date('m'), date('d'), date('Y'));        
$timesend  = mktime(0,0,0, date('m'), date('d'), date('Y'));    
foreach ($res_sns as $key => $value) {
    $school_id = $value['school_id'];
    $peop = $value['peop_num'];
    $number =  $db_sns->query("SELECT `user_id` FROM `isns_action_log` WHERE isns_action_log.create_time BETWEEN $timestart AND $timesend AND isns_action_log.action_id = 3 AND isns_action_log.school_id = $school_id GROUP BY isns_action_log.user_id");  
    $number = count($number);
    $res_sns[$key]['number'] = $number;
    $res_sns[$key]['number_is'] = (number_format($number/$peop,2))*100;
}
$newArr=array();
$newArr_p=array();
for($j=0;$j<count($res_sns);$j++){
    $newArr[]=$res_sns[$j]['number_is'];
    $newArr_p[]=$res_sns[$j]['peop_num'];
}
array_multisort($newArr,SORT_DESC,$newArr_p,SORT_DESC, $res_sns);
$res_json = json_encode($res_sns);
unset($db_sns);unset($newArr);unset($newArr_p);unset($res_sns);
?>