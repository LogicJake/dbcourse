<?php
function insertSc($sno,$cno,$grade){
    global $db,$sc;

    $sql = "INSERT INTO ".$sc." (Sno,Cno) VALUES (".$sno.",'".$cno."')";
    $res['sql'] = $sql;
    if(mysqli_query($db,$sql))
        $res['data'] = "插入成功";
    else
        $res['data'] = "插入失败：".$db -> error ;
    return $res;
}