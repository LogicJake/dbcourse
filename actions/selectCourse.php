<?php

require_once './include/course.class.php';
if(isset($_GET['key'],$_GET['page'])){
    $res = selectCourse($_GET['key'],$_GET['page']);
    Result::success($res);
}
else
    Result::error('缺少参数');