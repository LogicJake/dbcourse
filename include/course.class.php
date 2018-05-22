<?php
function insertCourse($cno,$cname,$ccredit){
    global $db,$course;

    $sql = "INSERT INTO ".$course." (Cno,Cname,Ccredit) VALUES ('".$cno."','".$cname."',".$ccredit.")";
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['status'] = 1;    
    else{
        $res['status'] = 0;
        $res['error'] = "插入失败：".$db -> error ;
    }
    return $res;
}

function deletetCourse($cno){
    global $db,$course;

    $sql = "DELETE FROM ".$course." WHERE Cno = '".$cno."'";
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['status'] = 1;    
    else{
        $res['status'] = 0;
        $res['error'] = "删除失败：".$db -> error ;
    }
    return $res;
}

function selectCourseAll($page){
    global $db,$course;
    $page_num = 5;  //每页查看5条
    $start = ($page-1)*$page_num;
    $end = $start+$page_num;

    $sql = "SELECT COUNT(*) FROM ".$course;
    if($re = mysqli_query($db,$sql)){
        $count = mysqli_fetch_row($re)[0];
        $max_page = $count/$page_num;
        if($page < $max_page)
            $res['finished'] = FALSE;
        else
            $res['finished'] = TRUE;
    }

    $sql = "SELECT * FROM ".$course." ORDER BY Cno LIMIT ".$start.",".$end;
    $res['sql'] = $sql;
    $data = array();
    if($re = mysqli_query($db,$sql)){
        $rows = array();
        while($row = mysqli_fetch_array($re)) {
            $rows[] = $row;
        }
        foreach($rows as $row){
            $tmp['no'] = $row[0];
            $tmp['name'] = $row[1];
            $tmp['credit'] = $row[2];
            array_push($data,$tmp);
        }
        $res['msg'] = "查询成功";
        $res['data'] = $data;
    }
    else
        $res['msg'] = "查询失败：".$db -> error ;
    return $res;
}

function selectCourseStatus($page,$sno){
    global $db,$course,$sc;
    $page_num = 5;  //每页查看5条
    $start = ($page-1)*$page_num;
    $end = $start+$page_num;

    $sql = "SELECT COUNT(*) FROM ".$course;
    if($re = mysqli_query($db,$sql)){
        $count = mysqli_fetch_row($re)[0];
        $max_page = $count/$page_num;
        if($page < $max_page)
            $res['finished'] = FALSE;
        else
            $res['finished'] = TRUE;
    }

    $sql = "SELECT * FROM ".$course." ORDER BY Cno LIMIT ".$start.",".$end;
    $res['sql1'] = $sql;
    $data = array();
    if($re = mysqli_query($db,$sql)){
        $rows = array();
        while($row = mysqli_fetch_array($re)) {
            $rows[] = $row;
        }
        foreach($rows as $row){
            $tmp['no'] = $row[0];
            $tmp['name'] = $row[1];
            $tmp['credit'] = $row[2];
            $sql = "SELECT * FROM ".$sc." WHERE Sno = ".$sno." AND Cno = '".$tmp['no']."'";
            $res['sql2'] = $sql;

            if($re = mysqli_query($db,$sql)){
                if(count(mysqli_fetch_array($re))==0)
                    $tmp['status'] = "未选课";
                else
                    $tmp['status'] = "已选课";
            }
            array_push($data,$tmp);
        }
        $res['msg'] = "查询成功";
        $res['data'] = $data;
    }
    else
        $res['msg'] = "查询失败：".$db -> error ;
    return $res;
}