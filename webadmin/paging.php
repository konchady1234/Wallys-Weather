<?
if($_REQUEST['page']==""){ $_REQUEST['page']=1; }
if($_REQUEST['page'] || $_REQUEST['no_of_paginations'])
{	
$page = $_REQUEST['page'];
$cur_page = $page;
$page -= 1;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

/* --------------------------------------------- */
if($domiansort!="") {
$query_pag_num = "SELECT COUNT(*) AS count, $domiansort FROM $table";
}else
{
$query_pag_num = "SELECT COUNT(*) AS count FROM $table";	
}
$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count = $row['count'];
$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<div class='pagination'><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<a href='?page=$pre'><li p='1' class='active'>First</li></a>";
} else if ($first_btn) {
    $msg .= "<a href='?page=1'><li p='1' class='inactive'>First</li></a>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<a href='?page=$pre'><li p='$pre' class='active'>Previous</li></a>";
} else if ($previous_btn) {
    $msg .= "<li class='inactive'>Previous</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {
    if ($cur_page == $i)
        $msg .= "<a href='?page=$i'><li p='$i' class='crnt'>{$i}</li><a>";
    else
        $msg .= "<a href='?page=$i'><li p='$i' class='active'>{$i}</li></a>";		
		
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<a href='?page=$nex'><li p='$nex' class='active'>Next</li></a>";
} else if ($next_btn) {
    $msg .= "<li class='inactive'>Next</li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<a href='?page=$no_of_paginations'><li p='$no_of_paginations' class='active'>Last</li></a>";
} else if ($last_btn) {
    $msg .= "<a href='?page=$no_of_paginations'><li p='$no_of_paginations' class='inactive'>Last</li></a>";
}
//$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
//$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
}
		
?>