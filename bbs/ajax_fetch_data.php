<?php
#####################################################################
#
#		파일이름		: 		ajax_fetch_data.php
#		파일설명		:		ajax autocomplete(연관검색어) 데이터 처리 페이지
#
#
#		저작권		    :		저작권은 제작자 있지만 누구나 사용합니다.
#		제작자          :		김영섭
#		최초제작일      :		2021년 07월 06일
#		최종수정일		:		2021년 03월 06일
#
###########################################################################-->


    include_once('./_common.php');

    if(isset($_POST['search'])){
        $search = sql_real_escape_string($_POST['search']);

        //총 게시판 가져 오기
        $tot_board_sql = " select bo_table from {$g5['board_table']} ";
        $tot_board_result = sql_query($tot_board_sql);
        $bbs_name = "";

        while ($tot_board_row = sql_fetch_array($tot_board_result)){
            $bbs_name = $g5['write_prefix'].$tot_board_row['bo_table'];

            $sql = " select * from {$bbs_name} where wr_subject like '%".$search."%' ";
            $result = sql_query($sql);

            while ($row = sql_fetch_array($result)){
                //$response[] = array("wr_subject"=>$row['wr_subject'],"bo_table"=>$bbs_name,"wr_id"=>$row['wr_id']);
                $response[] = array("label"=>$row['wr_subject'],"wr_id"=>$row['wr_id'],"bo_table"=>$tot_board_row['bo_table']);
            }
        }

        echo json_encode($response);
    }

    exit;

?>