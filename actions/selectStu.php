<?php

require_once './include/stu.class.php';
if(isset($_GET['key'])){
    $res = selectStu($_GET['key']);
    Result::success($res);
}
else
    Result::error('缺少参数');