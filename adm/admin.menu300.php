<?php
$menu['menu300'] = array (
    array('300000', '게시판관리', ''.G5_ADMIN_URL.'/board_list.php', 'board'),
    array('300100', '게시판관리', ''.G5_ADMIN_URL.'/board_list.php', 'bbs_board'),
    array('300200', '게시판그룹관리', ''.G5_ADMIN_URL.'/boardgroup_list.php', 'bbs_group'),
    array('300300', '인기검색어관리', ''.G5_ADMIN_URL.'/popular_list.php', 'bbs_poplist', 1),
    array('300400', '인기검색어순위', ''.G5_ADMIN_URL.'/popular_rank.php', 'bbs_poprank', 1),
    array('300500', '1:1문의설정', ''.G5_ADMIN_URL.'/qa_config.php', 'qa_conf'),
    array('300600', '내용관리', G5_ADMIN_URL.'/contentlist.php', 'scf_contents', 1),
    array('300700', 'FAQ관리', G5_ADMIN_URL.'/faqmasterlist.php', 'scf_faq', 1),
    array('300820', '글,댓글 현황', G5_ADMIN_URL.'/write_count.php', 'scf_write_count'),
    array('300821', '&nbsp', ''),
    array('300901', '=== 게시판현황 ===', ''),
);

$result = sql_query(" select bo_table,bo_subject from {$g5['board_table']} ");
$array_num = "300910";
$arr_cnt = count($menu['menu300']);

while ($row = sql_fetch_array($result)){
    $array_num = $array_num + 1;
    $menu['menu300'][$arr_cnt] = array($array_num, $row['bo_subject']." 현황", G5_ADMIN_URL.'/bbs/board.php?bo_table='.$row['bo_table'], $row['bo_table']);
    $arr_cnt++;
}
