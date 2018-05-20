<?php

require_once './include/stu.class.php';
if(isset($_GET['sno'])){
    $res = getStu($_GET['sno']);
    Result::success($res);
}
else
    Result::error('缺少参数');