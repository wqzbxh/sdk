<?php
/**
 * Created by PhpStorm.
 * User: k
 * Date: 2018/11/12
 * Time: 11:29
 */
class db
{
    public $host = "localhost";//定义默认连接方式
    public $zhang = "root";//定义默认用户名
    public $mi = "root";//定义默认的密码
    public $dbname = "sdkstatistics";//定义默认的数据库名

    public function Query($sql,$type=1)
//两个参数：sql语句，判断返回1查询或是增删改的返回
    {
        $db = mysqli_connect($this->host,$this->zhang,$this->mi,$this->dbname,3306);
        $r = $db->query($sql);
        if($type == "1")
        {
            $return = $r->fetch_all();//查询语句，返回数组.执行sql的返回方式是all，也可以换成row
        }
        else if($type == "2")
        {
            $return = $r->fetch_row();//查询语句
        }else{
            $return  =  $r;
        }

        mysqli_close($db);
        return $return;

    }


}



?>