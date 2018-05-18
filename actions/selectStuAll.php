<?php

require_once './include/stu.class.php';
if(isset($_GET['page'])){
    $res = selectStuAll($_GET['page']);
    Result::success($res);
}
else
    Result::error('缺少参数');