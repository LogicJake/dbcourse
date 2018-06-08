<?php

require_once './include/course.class.php';
if(isset($_GET['key'],$_GET['page'],$_GET['sno'])){
    $res = selectCourseStatus($_GET['key'],$_GET['page'],$_GET['sno']);
    Result::success($res);
}
else
    Result::error('缺少参数');