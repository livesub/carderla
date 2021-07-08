<?php
#####################################################################
#
#		파일이름		: 		auto_search.php
#		파일설명		:		ajax autocomplete(연관검색어)
#
#
#		저작권		    :		저작권은 제작자 있지만 누구나 사용합니다.
#		제작자          :		김영섭
#		최초제작일      :		2021년 07월 06일
#		최종수정일		:		2021년 03월 06일
#
###########################################################################-->

    include_once('./_common.php');
    include_once('./_head.php');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<table>
        <tr>
            <td>연관검색어</td>
            <td><input type='text' id='autocomplete' ></td>
        </tr>
</table>

<script type='text/javascript' >
    $( function() {
        $( "#autocomplete" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: "ajax_fetch_data.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('#autocomplete').val(ui.item.wr_subject); // display the selected text

                var reportname = ui.item.value
                var thelinks = $('a.large:contains("' + reportname + '")').filter(
                function (i) { return (this.text === reportname) })
                location.href="/bbs/board.php?bo_table="+ui.item.bo_table+"&wr_id="+ui.item.wr_id+"";

                return false;

            },
/*
            focus: function(event, ui){
                $( "#autocomplete" ).val( ui.item.label );
                location.href="/bbs/board.php?bo_table="+ui.item.bo_table+"&wr_id="+ui.item.wr_id+"";
                return false;
            },
*/
        });
    });
</script>


<?php
include_once('./_tail.php');