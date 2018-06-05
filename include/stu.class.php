<?php
function insertStu($sno,$sname,$ssex,$sage,$sdept){
    global $db,$stu;

    $sql = "INSERT INTO ".$stu." (Sno,Sname,Ssex,Sage,Sdept) VALUES (".$sno.",'".$sname."','".$ssex."',".$sage.",'".$sdept."')";
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['status'] = 1;    
    else{
        $res['status'] = 0;
        $res['error'] = "插入失败：".$db -> error ;
    }
    return $res;
}

function deletetStu($sno){
    global $db,$stu;

    $sql = "DELETE FROM ".$stu." WHERE Sno = ".$sno;
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['status'] = 1;    
    else{
        $res['status'] = 0;
        $res['error'] = "删除失败：".$db -> error ;
    }
    return $res;
}

function selectStuAll($page){
    global $db,$stu;
    $page_num = 5;  //每页查看5条
    $start = ($page-1)*$page_num;

    $sql = "SELECT COUNT(*) FROM ".$stu;
    if($re = mysqli_query($db,$sql)){
        $count = mysqli_fetch_row($re)[0];
        $max_page = $count/$page_num;
        if($page < $max_page)
            $res['finished'] = FALSE;
        else
            $res['finished'] = TRUE;
    }

    $sql = "SELECT * FROM ".$stu." ORDER BY Sno LIMIT ".$start.",".$page_num;
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

function getStu($sno){
    global $db,$stu;
    $sql = "SELECT * FROM ".$stu." WHERE Sno = ".$sno;
    $res['sql'] = $sql;
    if($re = mysqli_query($db,$sql)){
        $row = mysqli_fetch_row($re);
        if(count($row)!=0){
            $tmp['no'] = $row[0];
            $tmp['name'] = $row[1];
            $tmp['sex'] = $row[2];
            $tmp['age'] = $row[3];
            $tmp['dept'] = $row[4];
            $res['data'] = $tmp;
            $res['status'] = 1;
        }
        else
            $res['status'] = 0;
    }
    else{
        $res['status'] = -1;
        $res['msg'] = "查询失败：".$db -> error ;
    }
    return $res;
}

function updateStu($sno,$sname,$ssex,$sage,$sdept){
    global $db,$stu;
    $sql = "UPDATE ".$stu." SET Sno = '".$sno."',Sname = '".$sname."',Ssex = '".$ssex."',Sage = ".$sage.",Sdept = '".$sdept."' WHERE Sno = '".$sno."'";
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['status'] = 1;    
    else{
        $res['status'] = 0;
        $res['error'] = "更新失败：".$db -> error ;
    }
    return $res;
}

function selectStu($key){
    global $db,$stu;
<<<<<<< HEAD
    $sql = "SELECT * FROM ".$stu." WHERE Sno = ".$key."";
    $res['sql'] = $sql;
    $res['status'] = 0;
=======
    $sql = "SELECT * FROM ".$stu." WHERE Sno = ".$key;
    $res['sql'] = $sql;
>>>>>>> dcd1e73287e61513fef2c7490a826be7c3581fcb
    if($re = mysqli_query($db,$sql)){
        $row = mysqli_fetch_row($re);
        if(count($row)!=0){
            $tmp['no'] = $row[0];
            $tmp['name'] = $row[1];
            $tmp['sex'] = $row[2];
            $tmp['age'] = $row[3];
            $tmp['dept'] = $row[4];
            $res['data'] = $tmp;
            $res['status'] = 1;
        }
    }
<<<<<<< HEAD

    $sql = "SELECT * FROM ".$stu." WHERE Sname like '%".$key."%'";
=======
    else{
        $res['status'] = -1;
        $res['msg'] = "查询失败：".$db -> error ;
    }

    $sql = "SELECT * FROM ".$stu." WHERE Sname = ".$key;
>>>>>>> dcd1e73287e61513fef2c7490a826be7c3581fcb
    $res['sql2'] = $sql;
    if($re = mysqli_query($db,$sql)){
        $row = mysqli_fetch_row($re);
        if(count($row)!=0){
            $tmp['no'] = $row[0];
            $tmp['name'] = $row[1];
            $tmp['sex'] = $row[2];
            $tmp['age'] = $row[3];
            $tmp['dept'] = $row[4];
            $res['data'] = $tmp;
            $res['status'] = 1;
        }
        else
            $status = 0;
    }
<<<<<<< HEAD

=======
    else{
        $res['status'] = -1;
        $res['msg'] = "查询失败：".$db -> error ;
    }
>>>>>>> dcd1e73287e61513fef2c7490a826be7c3581fcb
    return $res;
}