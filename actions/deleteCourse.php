<?php

require_once './include/course.class.php';
if(isset($_GET['cno'])){
    $res = deletetCourse($_GET['cno']);
    Result::success($res);
}
else
    Result::error('缺少参数');