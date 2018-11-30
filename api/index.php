<?php
    include ("db.class.php");
    $db = new db();
    date_default_timezone_set('Asia/Shanghai');
    $str=date("Y-m-d",time())." 0:0:0";
    $startTime = strtotime($str);
    $str=date("Y-m-d",time())." 24:00:00";
    $endTime=strtotime($str);
    $sql = "SELECT count(*),from_unixtime(createtime, '%Y-%m-%d') as time,channel from sdkstatistics GROUP BY channel,from_unixtime(createtime, '%Y-%m-%d')";
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
        <tr><h3>日期：<?php echo Date('y-m-d') ;?></h3></tr>
        <tr>
            <th >渠道号</th>
            <th >数量</th>
        </tr>

        <?php foreach ($result as $key=>$value) {?>
            <tr>
                <td><?php echo $key ;?></td>
                <?php foreach ($value as $a) { ?>
                    <tr>
                        <td><?php echo $a[0];?> </td>
                    </tr>
                <?php }?>
            </tr>

        <?php } ?>

    </table>
</body>
</html>