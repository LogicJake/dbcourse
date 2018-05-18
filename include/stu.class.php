<?php
function insertStu($sno,$sname,$ssex,$sage,$sdept){
    global $db,$stu;

    $sql = "INSERT INTO ".$stu." (Sno,Sname,Ssex,Sage,Sdept) VALUES (".$sno.",'".$sname."','".$ssex."',".$sage.",'".$sdept."')";
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['msg'] = "插入成功";
    else
        $res['msg'] = "插入失败：".$db -> error ;
    return $res;
}

function deletetStu($sno){
    global $db,$stu;

    $sql = "DELETE FROM ".$stu." WHERE Sno = ".$sno;
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['msg'] = "删除成功";
    else
        $res['msg'] = "删除失败：".$db -> error ;
    return $res;
}

function selectStuAll($page){
    global $db,$stu;
    $page_num = 5;  //每页查看5条
    $start = ($page-1)*$page_num;
    $end = $start+$page_num;

    $sql = "SELECT COUNT(*) FROM ".$stu;
    if($re = mysqli_query($db,$sql)){
        $count = mysqli_fetch_row($re)[0];
        $max_page = $count/$page_num;
        if($page < $max_page)
            $res['finished'] = FALSE;
        else
            $res['finished'] = TRUE;
    }

    $sql = "SELECT * FROM ".$stu." ORDER BY Sno LIMIT ".$start.",".$end;
    $res['sql'] = $sql;
    $data = array();
    if($re = mysqli_query($db,$sql)){
        $rows = mysqli_fetch_all($re);
        foreach($rows as $row){
            $tmp['no'] = $row[0];
            $tmp['name'] = $row[1];
            $tmp['sex'] = $row[2];
            $tmp['age'] = $row[3];
            $tmp['dept'] = $row[4];
            array_push($data,$tmp);
        }
        $res['msg'] = "查询成功";
        $res['data'] = $data;
    }
    else
        $res['msg'] = "查询失败：".$db -> error ;
    return $res;
}