<?php
$check     = 0;
$Page      = "";
$fifo      = 1;
$opti      = 0;
$lru       = 0;
$faultfifo = "";
$faultopti = "";
$faultlru  = "";
//$thuatToan = 1;
$tongSoLoififo = 0;
$tongSoLoiopti = 0;
$tongSoLoilru  = 0;
$optionsInput  = 1;
if (isset($_POST["optionsInput"])) {
    $optionsInput = $_POST["optionsInput"];
}
if (isset($_FILES['filedata'])) {
    $curMiliTime = $_SERVER['REQUEST_TIME'];
    $errors      = array();
    $file_name   = $_FILES['filedata']['name'];
    $file_size   = $_FILES['filedata']['size'];
    $file_tmp    = $_FILES['filedata']['tmp_name'];
    $file_type   = $_FILES['filedata']['type'];

    //cắt lấy phần mở rộng để kiểm tra định dạng
    $tmp        = explode('.', $_FILES['filedata']['name']);
    $file_ext   = strtolower(end($tmp));
    $expensions = array("txt");
    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "Vui lòng chọn định dạng file là *.txt";
    }
    if ($file_size > 104858) {
        $errors[] = 'Kích thước file quá lớn';
    }
    //--------------------------
    $tenFile = "$curMiliTime.".$file_ext;
    if (empty($errors) == true) {
        $check = 2;
        move_uploaded_file($file_tmp, "upload/".$tenFile);
        $myfile = fopen("upload/$tenFile", "r");
        $Page   = fgets($myfile);
        $Page   = trim($Page);
        //$Page = substr($Page, 0, strlen($Page)-2);
        $soFrames = fgets($myfile);
        $soFrames = trim($soFrames);
        //$soFrames = substr($soFrames, 0, strlen($soFrames)-2);
        fclose($myfile);
        unlink("upload/$tenFile");
    }
}
if (isset($_POST["btnRun"]) && $optionsInput == 2) {
    $check    = 2;
    $Page     = $_POST["txtPage"];
    $soFrames = $_POST["txtFrames"];
    //$thuatToan = $_POST["thuatToan"];
}
if (isset($_POST["FIFO"])) {
    $fifo = $_POST["FIFO"];
}
if (isset($_POST["OPTI"])) {
    $opti = $_POST["OPTI"];
}
if (isset($_POST["LRU"])) {
    $lru = $_POST["LRU"];
}
if ((isset($_POST["LRU"]) || isset($_POST["OPTI"])) && !isset($_POST["FIFO"])) {
    $fifo = 0;
}
if (isset($_POST["btnRun"]) && $check == 2) {
    $arrtemp = tachChuoiPage($Page, $soPage);
    for ($i = 0; $i < $soPage; $i++) {
        $arrPage[$i + 1] = $arrtemp[$i];
    }
    $arrPage[0] = "0";
    // if ($thuatToan == 1){
    // 	$res = thuatToanFIFO($arrPage,$soPage,$soFrames,$fault,$tongSoLoi);
    // }
    // else if ($thuatToan == 2){
    // 	$res = thuatToanToiUu($arrPage,$soPage,$soFrames,$fault,$tongSoLoi);
    // }
    // else if ($thuatToan == 3){
    // 	$res = thuatToanLRU($arrPage,$soPage,$soFrames,$fault,$tongSoLoi);
    // }
    $minFault = -1;
    if ($fifo == 1) {
        $resfifo = thuatToanFIFO($arrPage, $soPage, $soFrames, $faultfifo, $tongSoLoififo);
        if ($minFault == -1) {
            $minFault = $tongSoLoififo;
        } else {
            if ($tongSoLoififo < $minFault) {
                $minFault = $tongSoLoififo;
            }
        }

    }
    if ($opti == 1) {
        $resopti = thuatToanToiUu($arrPage, $soPage, $soFrames, $faultopti, $tongSoLoiopti);
        if ($minFault == -1) {
            $minFault = $tongSoLoiopti;
        } else {
            if ($tongSoLoiopti < $minFault) {
                $minFault = $tongSoLoiopti;
            }
        }
    }
    if ($lru == 1) {
        $reslru = thuatToanLRU($arrPage, $soPage, $soFrames, $faultlru, $tongSoLoilru);
        if ($minFault == -1) {
            $minFault = $tongSoLoilru;
        } else {
            if ($tongSoLoilru < $minFault) {
                $minFault = $tongSoLoilru;
            }
        }
    }
}

?>