<?php

require_once './include/sc.class.php';
if(isset($_GET['page'],$_GET['cno'],$_GET['key'])){
    $res = selectScByCno($_GET['page'],$_GET['cno'],$_GET['key']);
    Result::success($res);
}
else
    Result::error('缺少参数');