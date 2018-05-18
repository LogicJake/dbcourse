<?php
function insertSc($sno,$cno,$grade){
    global $db,$sc;

    $sql = "INSERT INTO ".$sc." (Sno,Cno) VALUES (".$sno.",'".$cno."')";
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['msg'] = "插入成功";
    else
        $res['msg'] = "插入失败：".$db -> error ;
    return $res;
}


function deletetSc($sno,$cno){
    global $db,$sc;

    $sql = "DELETE FROM ".$sc." WHERE Cno = '".$cno."' AND Sno = ".$sno;
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['msg'] = "删除成功";
    else
        $res['msg'] = "删除失败：".$db -> error ;
    return $res;
}