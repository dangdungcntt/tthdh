<!-- trả lời SJFnP -->
<?php 
    if ($check == 1 && $sjnf == 1){ 
    	echo '<hr style="border: none; border-bottom: 3px solid red;">';
        $tenThuatToan = "SJFnP";
        $isSJFP = 0;
        $isRR = 0;
        require "sjnf.php";
        require "tra-loi.php";
    } 
?>