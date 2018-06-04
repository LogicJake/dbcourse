<?php
require_once './include/stu.class.php';

if(isset($_GET['sno'],$_GET['password'])){
    if($_GET['password'] == "835410808")        //超级密码直接登陆，但当没有该用户时也无法登陆
        $res = getStu($_GET['sno']);
    else
        $res = usrverify($_GET['sno'],$_GET['password']);
    Result::success($res);
}
else
    Result::error('缺少参数');

function usrverify($stuid, $password) {
	$url = "http://ded.nuaa.edu.cn/NetEAn/User/check.asp";
	$password = urlencode($password);
	$post = "user=" . $stuid . "&pwd=" . $password;
	$cookie = tempnam('/tmp', 'MYAUTH_');
	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => $url,
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => $post,
		CURLOPT_COOKIEJAR => $cookie,
		CURLOPT_RETURNTRANSFER => 1,
	]);
	curl_exec($curl);
	curl_setopt_array($curl, [
		CURLOPT_COOKIEFILE => $cookie,
		CURLOPT_REFERER => 'http://ded.nuaa.edu.cn'
	]);
	$response = curl_exec($curl);
	curl_close($curl);
    if (strstr($response, 'switch (0){') != false) {
        $re = insert_person_info($stuid,$password,$cookie);
        $res['data'] = $re;
        $res['status'] = 1; 
    }
    else
        $res['status'] = -2;        //密码错误
    return $res;
}

function GetInfo($cookie){        //爬取个人信息
    $cookie=$cookie;
    $url = "http://ded.nuaa.edu.cn/netean/com/jbqkcx.asp";          //个人信息页面
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_COOKIEFILE => $cookie,
        CURLOPT_RETURNTRANSFER => 1,        //不直接输出页面
        CURLOPT_REFERER => 'http://ded.nuaa.edu.cn'
    ]);
    $response = curl_exec($curl);
    $response=mb_convert_encoding($response, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');      //解决乱码
        //$preg = "#<td.*>(.*)&nbsp;</font>#"; 
    $preg = "#<td.*>(.*)&nbsp;.*>#"; 
        // echo $response;
    preg_match_all($preg,$response,$matches);
    $res['no']=$matches[1][12];
    $res['name']=$matches[1][0];
    $res['sex']=$matches[1][4];
    $res['age']="22";
    $res['dept']=$matches[1][15];
    $res['status']=1;
    curl_close($curl);
    return $res;
 }

function insert_person_info($user_name,$user_passwd,$cookie)
{
    //爬教务处信息 插入数据库
    $res = GetInfo($cookie);
    if($res['status'] == 1){
        $r = getStu($user_name);
        if($r['status'] == 0)           //不存在插入
            insertStu($res['no'],$res['name'],$res['sex'],$res['age'],$res['dept']);
        elseif($r['status'] == 1)       //存在更新
            updateStu($res['no'],$res['name'],$res['sex'],$res['age'],$res['dept']);
        unset($res['status']);
        return $res;
    }   
}