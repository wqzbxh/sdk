<?php
include ("db.class.php");
$db = new db();
date_default_timezone_set('Asia/Shanghai');
$str=date("Y-m-d",time())." 0:0:0";
$startTime = strtotime($str);
$str=date("Y-m-d",time())." 24:00:00";
$endTime=strtotime($str);
$sql = "SELECT count(*),from_unixtime(createtime, '%Y-%m-%d') as time,channel from sdkstatistics_u GROUP BY channel,from_unixtime(createtime, '%Y-%m-%d') ORDER BY createtime DESC";
$countResult = $db->Query($sql);
$result= array();
foreach ($countResult as $key => $info) {
    $result[$info[1]][] = $info;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<table>
    <tr>
        <th ></th>
        <th ></th>
    </tr>

    <?php foreach ($result as $key=>$value) {?>

        <th><?php echo $key ;?></th>

        <tr>
        <?php foreach ($value as $a) { ?>
            <tr>
                <td>渠道号:<?php echo $a[2];?> </td>
                <td>数量:<?php echo $a[0];?> </td>
            </tr>
        <?php }?>
        </tr>

    <?php } ?>

</table>
</body>
</html>