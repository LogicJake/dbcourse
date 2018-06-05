<?php

require_once './include/stu.class.php';
if(isset($_GET['key'],$_GET['page'])){
    $res = selectStu($_GET['key'],$_GET['page']);
    Result::success($res);
}
else
    Result::error('缺少参数');