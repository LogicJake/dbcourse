<?php
function insertSc($sno,$cno){
    global $db,$sc;

    $sql = "INSERT INTO ".$sc." (Sno,Cno) VALUES (".$sno.",'".$cno."')";
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['status'] = 1;
    else{        
        $res['status'] = 0;
        $res['error'] = "插入失败：".$db -> error ;
    }
    return $res;
}


function deletetSc($sno,$cno){
    global $db,$sc;

    $sql = "DELETE FROM ".$sc." WHERE Cno = '".$cno."' AND Sno = ".$sno;
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['status'] = 1;
    else{        
        $res['status'] = 0;
        $res['error'] = "删除失败：".$db -> error ;
    }
    return $res;
}

function selectScByCno($page,$cno,$key){
    global $db,$sc,$stu,$course;
    $page_num = 10;  //每页查看5条
    $start = ($page-1)*$page_num;

    $sql = "SELECT COUNT(*) FROM sc,c,s where s.sno = sc.sno and c.cno = sc.cno and sc.Cno = '" . $cno ."' ".$key;
    if($re = mysqli_query($db,$sql)){
        $count = mysqli_fetch_row($re)[0];
        $max_page = $count/$page_num;
        $res['num'] = $count;
        if($page < $max_page)
            $res['finished'] = FALSE;
        else
            $res['finished'] = TRUE;
    }

    //$sql = "select ".$stu.".Sno,".$stu.".Sname,".$course.".Cname,".$course.".Ccredit,".$sc.".Grade from sc,c,s where s.sno = sc.sno and c.cno = sc.cno and sc.Cno = '".$cno."' ORDER BY s.Sno LIMIT ".$start.",".$page_num;
    $key = '"'.$key.'"';
    $cno = '"'.$cno.'"';
    $sql = "call selectScByCno($cno,$start,$page_num,$key)";     //存储过程
    $res['sql'] = $sql;
    $data = array();
    if($re = mysqli_query($db,$sql)){
        $rows = array();
        while($row = mysqli_fetch_array($re)) {
            $rows[] = $row;
        }
        foreach($rows as $row){
            $tmp['sno'] = $row[0];
            $tmp['sname'] = $row[1];
            $tmp['cno'] = $row[2];
            $tmp['cname'] = $row[3];
            $tmp['credit'] = $row[4];
            $tmp['grade'] = $row[5]==null?"未录入":$row[5];
            array_push($data,$tmp);
        }
        $res['msg'] = "查询成功";
        $res['data'] = $data;
    }
    else
        $res['msg'] = "查询失败：".$db -> error ;
    return $res;
}

function selectScBySno($page,$sno,$key){
    global $db,$sc,$stu,$course;
    $page_num = 10;  //每页查看5条
    $start = ($page-1)*$page_num;

    $sql = "SELECT COUNT(*) FROM sc,c,s where s.sno = sc.sno and c.cno = sc.cno and sc.sno = ".$sno." ".$key;
    if($re = mysqli_query($db,$sql)){
        $count = mysqli_fetch_row($re)[0];
        $max_page = $count/$page_num;
        $res['num'] = $count;
        if($page < $max_page)
            $res['finished'] = FALSE;
        else
            $res['finished'] = TRUE;
    }

    // $sql = "select ".$stu.".Sno,".$stu.".Sname,".$course.".Cname,".$course.".Ccredit,".$course.".Cno,".$sc.".Grade from sc,c,s where s.sno = sc.sno and c.cno = sc.cno and sc.sno = ".$sno." ORDER BY c.Cno LIMIT ".$start.",".$page_num;
    $key = '"'.$key.'"';
    $sql = "call selectScBySno($sno, $start, $page_num,$key)";       //存储过程
    $res['sql'] = $sql;
    $data = array();
    if($re = mysqli_query($db,$sql)){
        $rows = array();
        while($row = mysqli_fetch_array($re)) {
            $rows[] = $row;
        }
        foreach($rows as $row){
            $tmp['sno'] = $row[0];
            $tmp['sname'] = $row[1];
            $tmp['cno'] = $row[4];
            $tmp['cname'] = $row[2];
            $tmp['credit'] = $row[3];
            $tmp['grade'] = $row[5]==null?"未录入":$row[5];
            array_push($data,$tmp);
        }
        $res['msg'] = "查询成功";
        $res['data'] = $data;
    }
    else
        $res['msg'] = "查询失败：".$db -> error ;
    return $res;
}

function updateGrade($sno,$cno,$grade){
    global $db,$sc;
    $sql = "UPDATE ".$sc." SET Grade = ".$grade." WHERE Cno = '".$cno."' AND Sno = ".$sno;
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['status'] = 1;    
    else{
        $res['status'] = 0;
        $res['error'] = "更新失败：".$db -> error ;
    }
    return $res;
}