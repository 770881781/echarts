<?php
$mysql_conf = array(
    'host'    => '127.0.0.1:3306', 
    'db'      => 'isp_oa', 
    'db_user' => 'root', 
    'db_pwd'  => '', 
    );
$pdo = new PDO("mysql:host=" . $mysql_conf['host'] . ";dbname=" . $mysql_conf['db'], $mysql_conf['db_user'], $mysql_conf['db_pwd']);//创建一个pdo对象
$pdo->exec("set names 'utf8'");
$sql = "SELECT `name`,`coordinate` FROM `ioa_school` WHERE `coordinate` <> 0 ";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, 'joshua', PDO::PARAM_STR);
$rs = $stmt->execute();
if ($rs) {  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $re[] = ($row);
    }
}
foreach ($re as $key => $value) {
    $coordinate = explode(',',$value['coordinate']);
    $res[$value['name']][0] = $coordinate[0];
    $res[$value['name']][1] = $coordinate[1];    
    $res_val[$key]['name'] = $value['name'];
    $res_val[$key]['value'] = rand(99,999);
}
$pdo = null;//关闭连接
?>