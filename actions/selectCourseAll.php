<?php

require_once './include/course.class.php';
if(isset($_GET['page'])){
    $res = selectCourseAll($_GET['page']);
    Result::success($res);
}
else
    Result::error('缺少参数');