<?php
define('G5_IS_ADMIN', true);
include_once ('../../common.php');
include_once(G5_ADMIN_PATH.'/admin.lib.php');
include_once(G5_SMS5_PATH.'/sms5.lib.php');

/**** 추가 분  *******/
include_once G5_ADMIN_PATH."/sms_admin/lib/common/suremcfg.php";
include_once G5_ADMIN_PATH."/sms_admin/lib/common/common.php";

$packettest = new SuremPacket;
$result=$packettest->checkMoney();

$res =substr($result,94,1);
$money = substr($result,304,4);
$price = substr($result,308,4);

//사이버 머니 확인
//※ 사용자 잔액조회 결과 수신시 에러가 발생할 경우 기본값으로 '0'원을 넣지 마시고
//에러코드 값을 출력하여 꼭 사용자들이 화면에서 에러를 확인 할 수 있도록 개발하시기 바랍니다.
$money=$packettest->byte2str($money);
//건당금액
$price=$packettest->byte2str($price);
/**** 추가 분  *******/

if (!strstr($_SERVER['SCRIPT_NAME'], 'install.php')) {
    if(!sql_num_rows(sql_query(" show tables like '{$g5['sms5_config_table']}' ")))
        goto_url('install.php');

    // SMS 설정값 배열변수
    //$sms5 = sql_fetch("select * from ".$g5['sms5_config_table'] );
}

$sv = isset($_REQUEST['sv']) ? get_search_string($_REQUEST['sv']) : '';
$st = (isset($_REQUEST['st']) && $st) ? substr(get_search_string($_REQUEST['st']), 0, 12) : '';

if( isset($token) ){
    $token = @htmlspecialchars(strip_tags($token), ENT_QUOTES);
}

add_stylesheet('<link rel="stylesheet" href="'.G5_SMS5_ADMIN_URL.'/css/sms5.css">', 0);