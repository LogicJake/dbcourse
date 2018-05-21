<?php

require_once './include/sc.class.php';
if(isset($_GET['page'],$_GET['sno'])){
    $res = selectScBySno($_GET['page'],$_GET['sno']);
    Result::success($res);
}
else
    Result::error('缺少参数');