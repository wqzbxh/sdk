<?php
/**
 * Created by PhpStorm.
 * User: wanghaiyang
 * Date: 2018/11/12
 * Time: 11:17
 */
include ("db.class.php");
$db = new db();
date_default_timezone_set('Asia/Shanghai');

if(!empty($_POST['ii']) && $_POST['er'] && $_POST['cl'])
{
    //数据
    $iMei = $_POST['ii'];
    $encipher = $_POST['er'];
    $brand = !empty($_POST['bd']) ? $_POST['bd']:  "NULL";
    $model = !empty($_POST['ml']) ? $_POST['ml']: "NULL";
    $systemVersion = !empty($_POST['sn']) ? $_POST['sn']: "NULL";
    $internetModel = !empty($_POST['ie']) ? $_POST['ie']: "NULL";
    $distinguishability = !empty($_POST['dy']) ? $_POST['dy']: "NULL";
    $androidId = !empty($_POST['ad']) ? $_POST['ad']: "NULL";
    $channel = !empty($_POST['cl']) ? $_POST['cl']: "NULL";
    $version = !empty($_POST['vn']) ? $_POST['vn']: "NULL";
    $createtime = time();
    $str=date("Y-m-d",time())." 0:0:0";
    $startTime = strtotime($str);
    $str=date("Y-m-d",time())." 24:00:00";
    $endTime=strtotime($str);

    $sql = "SELECT count(*) FROM sdkstatistics WHERE imei = '".$_POST['ii']."' AND encipher = '".$_POST['er']."' AND channel = '".$_POST['cl']."' AND createtime BETWEEN ".$startTime." AND ".$endTime;

    @$countResult = $db->Query($sql,2);
    if($countResult[0] > 0){//当天已经存在的不添加修
        $updateSql = "update sdkstatistics set brand= '".$brand."',model='".$model."',version='".$version."',android_id='".$androidId."',systemversion='".$systemVersion."',internetmode='".$internetModel."',distinguishability='".$distinguishability."',createtime=$createtime where imei='".$iMei."' AND encipher='".$encipher."' AND channel='".$channel."' AND createtime BETWEEN ".$startTime." AND ".$endTime;

        $insertResult = $db->Query($updateSql,3);
    }else{
        $insertSql = "insert into sdkstatistics(imei,version,encipher,brand,model,systemversion,internetmode,distinguishability,channel,android_id,createtime) values('".$iMei."','".$version."','".$encipher."','".$brand."','".$model."','".$systemVersion."','".$internetModel."' ,'".$distinguishability."','".$channel."','".$androidId."',$createtime)";
        $insertResult = $db->Query($insertSql,3);
    }

  //  var_dump($insertSql);exit;

    var_dump($insertResult);
//    @mysqli_close($db);
}


?>
