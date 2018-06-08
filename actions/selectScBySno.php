<?php

require_once './include/sc.class.php';
if(isset($_GET['key'],$_GET['page'],$_GET['sno'])){
    $res = selectScBySno($_GET['page'],$_GET['sno'],$_GET['key']);
    Result::success($res);
}
else
    Result::error('缺少参数');