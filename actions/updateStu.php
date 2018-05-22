<?php

require_once './include/stu.class.php';
if(isset($_GET['sno'],$_GET['sname'],$_GET['ssex'],$_GET['sage'],$_GET['sdept'])){
    $res = updateStu($_GET['sno'],$_GET['sname'],$_GET['ssex'],$_GET['sage'],$_GET['sdept']);
    Result::success($res);
}
else
    Result::error('缺少参数');