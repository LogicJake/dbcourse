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