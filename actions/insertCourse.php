<?php

require_once './include/course.class.php';
if(isset($_GET['cno'],$_GET['cname'],$_GET['ccredit'])){
    $res = insertCourse($_GET['cno'],$_GET['cname'],$_GET['ccredit']);
    Result::success($res);
}
else
    Result::error('缺少参数');