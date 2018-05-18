<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
session_start();

require_once './include/result.class.php';

// white list
$actionList = ['insertStu','insertSc','insertCourse','deleteStu','deleteSc','deleteCourse'];


if (!isset($_GET['_action'])) {
    Result::error('missing _action');
}
if (!in_array($_GET['_action'], $actionList)) {
    Result::error('_action error');
}

$GLOBALS['course'] = "c";               //课程数据表名称
$GLOBALS['stu'] = "s";                  //学生数据表名称
$GLOBALS['sc'] = "sc";                  //选课数据表名称

if (in_array($_GET['_action'], $actionList)){
    $GLOBALS['db'] = mysqli_connect("localhost","root","835410808","elective-course");        //连接数据库
    if (!$db)
        var_dump('Could not connect: ' . mysqli_error());
    mysqli_query($db,'set names utf8');     //设置为utf-8
    require_once "actions/{$_GET['_action']}.php";
    mysqli_close($db);                  //关闭数据库
}

