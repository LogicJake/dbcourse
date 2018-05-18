<?php
function insertCourse($cno,$cname,$ccredit){
    global $db,$course;

    $sql = "INSERT INTO ".$course." (Cno,Cname,Ccredit) VALUES ('".$cno."','".$cname."',".$ccredit.")";
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['msg'] = "插入成功";
    else
        $res['msg'] = "插入失败：".$db -> error ;
    return $res;
}

function deletetCourse($cno){
    global $db,$course;

    $sql = "DELETE FROM ".$course." WHERE Cno = '".$cno."'";
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['msg'] = "删除成功";
    else
        $res['msg'] = "删除失败：".$db -> error ;
    return $res;
}