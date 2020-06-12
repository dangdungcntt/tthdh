<!-- trả lời RR -->
<?php
if ($check == 1 && $rr == 1) {
    echo '<hr style="border: none; border-bottom: 3px solid red;">';
    $tenThuatToan = "RR";
    $isSJFP       = 0;
    $isRR         = 1;
    require "rr.php";
    require "tra-loi.php";
}
?>