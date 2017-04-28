<!-- trả lời FCFS -->
<?php 
    if ($check == 1 && $fcfs == 1){ 
        echo '<hr style="border: none; border-bottom: 3px solid red;">';
        $tenThuatToan = "FCFS";
        $isSJFP = 0;
        $isRR = 0;
        require "fcfs.php";
        require "tra-loi.php";
    } 
?>