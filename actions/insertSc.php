<?php

require_once './include/sc.class.php';
if(isset($_GET['sno'],$_GET['cno'])){
    $res = insertSc($_GET['sno'],$_GET['cno'],$_GET['grade']);
    Result::success($res);
}
else
    Result::error('缺少参数');