<!-- trả lời SJFP -->
<?php 
    if ($check == 1 && $sjf == 1){ 
        echo '<hr style="border: none; border-bottom: 3px solid red;">';
        $tenThuatToan = "SJFP";
        $isSJFP = 1;
        $isRR = 0;
        require "sjf.php";
        require "tra-loi.php";
    } 
?>