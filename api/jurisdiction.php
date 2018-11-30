<?php
/**
 * Created by PhpStorm.
 * User: wanghaiyang
 * Date: 2018/11/29
 * Time: 18:02
 */
include ("db.class.php");
$db = new db();
date_default_timezone_set('Asia/Shanghai');

if($_POST['uuid'] && $_POST['imei'] && $_POST['channel']){
    $uuid = !empty($_POST['uuid']) ? $_POST['uuid']:  0;
    $imei = !empty($_POST['imei']) ? $_POST['imei']: "NULL";
    $isSuspend = !empty($_POST['is_suspend']) ? $_POST['is_suspend']: 0;
    $channel = !empty($_POST['channel']) ? $_POST['channel']: "NULL";
    $packname = !empty($_POST['packname']) ? $_POST['packname']: "NULL";
    $sdkversion = !empty($_POST['sdkversion']) ? $_POST['sdkversion']: "NULL";
    $createtime = time();
    $str=date("Y-m-d",time())." 0:0:0";
    $startTime = strtotime($str);
    $str=date("Y-m-d",time())." 24:00:00";
    $endTime=strtotime($str);

    $sql = "SELECT count(*) FROM jurisdiction WHERE imei = '".$_POST['imei']."' AND uuid = '".$_POST['uuid']."' AND channel = '".$_POST['channel']."' AND createtime BETWEEN ".$startTime." AND ".$endTime;
    @$countResult = $db->Query($sql,2);
    if($countResult[0] > 0){//当天已经存在的不添加修
        $updateSql = "update jurisdiction set packname = '".$packname."', uuid= '".$uuid."',imei='".$imei."',sdkversion='".$sdkversion."',is_suspend='".$isSuspend."',createtime=$createtime where imei='".$imei."' AND uuid='".$uuid."' AND channel='".$channel."' AND createtime BETWEEN ".$startTime." AND ".$endTime;
        $insertResult = $db->Query($updateSql,3);
    }else{
        $insertSql = "insert into jurisdiction(packname,uuid,imei,is_suspend,channel,sdkversion,createtime) values('".$packname."','".$uuid."','".$imei."','".$isSuspend."','".$channel."','".$sdkversion."',$createtime)";
        $insertResult = $db->Query($insertSql,3);
    }

}