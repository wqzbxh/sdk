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
    $timekey = (string)$startTime+1;
    $solekey = $uuid.$imei.$channel.$timekey;
    $insertSql = "replace into jurisdiction_u(packname,uuid,imei,is_suspend,channel,sdkversion,createtime,timekey,solekey) values('".$packname."','".$uuid."','".$imei."','".$isSuspend."','".$channel."','".$sdkversion."',$createtime,'".$timekey."','".$solekey."')";
    $insertResult = $db->Query($insertSql,3);

}