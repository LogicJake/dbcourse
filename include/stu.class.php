<?php
function insertStu($sno,$sname,$ssex,$sage,$sdept){
    global $db,$stu;

    $sql = "INSERT INTO ".$stu." (Sno,Sname,Ssex,Sage,Sdept) VALUES (".$sno.",'".$sname."','".$ssex."',".$sage.",'".$sdept."')";
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['data'] = "插入成功";
    else
        $res['data'] = "插入失败：".$db -> error ;
    return $res;
}

function deletetStu($sno){
    global $db,$stu;

    $sql = "DELETE FROM ".$stu." WHERE Sno = ".$sno;
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['data'] = "删除成功";
    else
        $res['data'] = "删除失败：".$db -> error ;
    return $res;
}