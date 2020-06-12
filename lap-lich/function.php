<?php
function tachChuoiPage($Arr, &$size)
{
    $arr = explode(" ", $Arr);
    foreach ($arr as $a) {
        # code...
        $a = trim($a);
    }
    $size = sizeof($arr);
    return $arr;
}

function khoiTaoMau(&$mau, &$soMau)
{
    $mau[0]  = "#0000ff";
    $mau[1]  = "#337ab7";
    $mau[2]  = "#5cb85c";
    $mau[3]  = "#5bc0de";
    $mau[4]  = "#f0ad4e";
    $mau[5]  = "#d9534f";
    $mau[6]  = "#fff200";
    $mau[7]  = "#a349a4";
    $mau[8]  = "#b97a57";
    $mau[9]  = "#ffaec9";
    $mau[10] = "#ffc90e";
    $mau[11] = "#efe4b0";
    $mau[12] = "#b5e61d";
    $mau[13] = "#99d9ea";
    $mau[14] = "#7092be";
    $mau[15] = "#971ce1";
    $mau[16] = "#ff0080";
    $mau[17] = "#0fee74";
    $mau[18] = "#82acff";
    $mau[19] = "#ff82da";
    $soMau   = sizeof($mau);
}

function thuatToanFCFS(
    $arrAT,
    $arrBT,
    &$arrKT,
    $soTienTrinh,
    &$thoiGianCho,
    &$tongTgCho,
    &$thoiGianLuu,
    &$tongTgLuu,
    &$thuTu,
    &$canBenPhai,
    &$tongThoiGian
) {
    $tongThoiGian = 0;
    $tongTgCho    = 0;
    $tongTgLuu    = 0;
    $min          = 1;
    for ($i = 1; $i <= $soTienTrinh; $i++) {
        if ($arrAT[$i] < $arrAT[$min]) {
            $min = $i;
        }
    }
    for ($u = 1; $u <= $soTienTrinh; $u++) {
        $select[$u]      = 0;
        $thoiGianLuu[$u] = 0;
        $thoiGianCho[$u] = 0;
    }
    $pre;
    $j = 0;

    $dem = 1;
    for ($i = 1; $i <= $soTienTrinh; $i++) {
        $tongThoiGian += $arrBT[$i];
        $pre          = $j;
        $j            = $min;
        $select[$j]   = 1;
        if ($i == 1) {
            $arrKT[$j] = $arrBT[$j];
        } else {
            $arrKT[$j] = $arrKT[$pre] + $arrBT[$j];
        }
        $thoiGianCho[$j] = $arrKT[$j] - $arrBT[$j] - $arrAT[$j];
        $tongTgCho       += $thoiGianCho[$j];
        $thoiGianLuu[$j] = $arrKT[$j] - $arrAT[$j];
        $tongTgLuu       += $thoiGianLuu[$j];
        for ($u = 1; $u <= $soTienTrinh; $u++) {
            if ($select[$u] == 0) {
                $min = $u;
                break;
            }
        }
        for ($u = 1; $u <= $soTienTrinh; $u++) {
            if ($select[$u] == 0 && $arrAT[$u] < $arrAT[$min]) {
                $min = $u;
            }
        }
        $thuTu[$dem]      = $j;
        $canBenPhai[$dem] = $arrKT[$j];
        $dem++;
    }
}

function thuatToanSJnF(
    $arrAT,
    $arrBT,
    &$arrKT,
    $soTienTrinh,
    &$thoiGianCho,
    &$tongTgCho,
    &$thoiGianLuu,
    &$tongTgLuu,
    &$thuTu,
    &$canBenPhai,
    &$tongThoiGian
) {
    $tongThoiGian = 0;
    $tongTgCho    = 0;
    $tongTgLuu    = 0;
    $min          = 1;
    //tìm ra tiến trình đến tại thời điểm 0 và ngắn nhất
    for ($i = 1; $i <= $soTienTrinh; $i++) { //đánh dấu những tiến trình đến lúc 0
        $select[$i] = 0;
        if ($arrAT[$i] == 0) {
            $select[$i] = 1;
        }
    }
    for ($i = 1; $i <= $soTienTrinh; $i++) { //tìm tiến trình đầu tiên đến lúc 0
        if ($select[$i] == 1) {
            $min = $i;
            break;
        }
    }
    for ($i = 1; $i <= $soTienTrinh; $i++) { //tìm tiến trình đến lúc 0 và ngắn nhất
        if ($select[$i] == 1 && $arrBT[$i] < $arrBT[$min]) {
            $min = $i;
        }
    }
    for ($u = 1; $u <= $soTienTrinh; $u++) {
        $select[$u]      = 0;
        $thoiGianLuu[$u] = 0;
        $thoiGianCho[$u] = 0;
    }

    $pre;
    $j = 1;

    $dem = 1;
    for ($i = 1; $i <= $soTienTrinh; $i++) {
        $tongThoiGian += $arrBT[$i];
        $pre          = $j;
        $j            = $min;
        $select[$j]   = 2;
        if ($i == 1) {
            $arrKT[$j] = $arrBT[$j];
        } else {
            $arrKT[$j] = $arrKT[$pre] + $arrBT[$j];
        }
        $thoiGianCho[$j] = $arrKT[$j] - $arrBT[$j] - $arrAT[$j];
        $tongTgCho       += $thoiGianCho[$j];
        $thoiGianLuu[$j] = $arrKT[$j] - $arrAT[$j];
        $tongTgLuu       += $thoiGianLuu[$j];
        for ($u = 1; $u <= $soTienTrinh; $u++) {

            if ($arrAT[$u] <= $arrKT[$j] && $select[$u] == 0) {
                $select[$u] = 1;
            }
        }
        for ($u = 1; $u <= $soTienTrinh; $u++) {
            if ($select[$u] == 1) {
                $min = $u;
                break;
            }
        }
        for ($u = 1; $u <= $soTienTrinh; $u++) {
            if ($arrBT[$u] < $arrBT[$min] && $select[$u] == 1) {
                $min = $u;
            }
        }
        $thuTu[$dem]      = $j;
        $canBenPhai[$dem] = $arrKT[$j];
        $dem++;
    }
}

function thuatToanSJF(
    $arrAT,
    $arrBT,
    &$arrKT,
    $soTienTrinh,
    &$thoiGianCho,
    &$tongTgCho,
    &$thoiGianLuu,
    &$tongTgLuu,
    &$thuTu,
    &$canBenPhai,
    &$tongThoiGian,
    &$dem
) {
    $tongThoiGian = 0;
    $tongTgCho    = 0;
    $tongTgLuu    = 0;
    $min          = 1;
    //tìm ra tiến trình đến tại thời điểm 0 và ngắn nhất
    for ($i = 1; $i <= $soTienTrinh; $i++) { //đánh dấu những tiến trình đến lúc 0
        $select[$i] = 0;
        if ($arrAT[$i] == 0) {
            $select[$i] = 1;
        }
    }
    for ($i = 1; $i <= $soTienTrinh; $i++) { //tìm tiến trình đầu tiên đến lúc 0
        if ($select[$i] == 1) {
            $min = $i;
            break;
        }
    }
    for ($i = 1; $i <= $soTienTrinh; $i++) { //tìm tiến trình đến lúc 0 và ngắn nhất
        if ($select[$i] == 1 && $arrBT[$i] < $arrBT[$min]) {
            $min = $i;
        }
    }
    //khởi tạo giá trị và copy mảng thời gian chạy
    $arrBTGoc[0] = 0;
    for ($u = 1; $u <= $soTienTrinh; $u++) {
        $arrBTGoc[$u]    = $arrBT[$u];
        $tongThoiGian    += $arrBT[$u];
        $select[$u]      = 0;
        $thoiGianLuu[$u] = 0;
        $thoiGianCho[$u] = 0;
    }

    $j       = 1;
    $curTime = 1;
    $dem     = 1;
    while ($curTime <= $tongThoiGian) {
        $j          = $min;
        $select[$j] = 2; //đánh dấu tiến trình hiện tại
        for ($u = 1; $u <= $soTienTrinh; $u++) {
            if ($arrAT[$u] <= $curTime && $select[$u] == 0) {
                $select[$u] = 1;
            }
        }
        $arrBT[$j]--;
        $arrKT[$j] = $curTime;
        for ($u = 1; $u <= $soTienTrinh; $u++) {
            if ($arrBT[$u] < $arrBT[$min] && $select[$u] == 1) {
                $min = $u;
            }
        }
        if ($arrBT[$j] == 0) {
            $select[$j] = -1;
            for ($u = 1; $u <= $soTienTrinh; $u++) {
                if ($select[$u] == 1) {
                    $min = $u;
                    break;
                }
            }
            for ($u = 1; $u <= $soTienTrinh; $u++) {
                if ($arrBT[$u] < $arrBT[$min] && $select[$u] == 1) {
                    $min = $u;
                }
            }
        }
        if ($min != $j || $curTime == $tongThoiGian) {
            $thuTu[$dem]      = $j;
            $canBenPhai[$dem] = $arrKT[$j];
            $dem++;
            if ($select[$j] != -1) {
                # code...
                $select[$j] = 0;
            }
        }
        $curTime++;

    }
    $dem--;
    for ($j = 1; $j <= $soTienTrinh; $j++) {
        $thoiGianCho[$j] = $arrKT[$j] - $arrBTGoc[$j] - $arrAT[$j];
        $tongTgCho       += $thoiGianCho[$j];
        $thoiGianLuu[$j] = $arrKT[$j] - $arrAT[$j];
        $tongTgLuu       += $thoiGianLuu[$j];
    }
}

function thuatToanRR(
    $arrAT,
    $arrBT,
    &$arrKT,
    $soTienTrinh,
    &$thoiGianCho,
    &$tongTgCho,
    &$thoiGianLuu,
    &$tongTgLuu,
    &$thuTu,
    &$canBenPhai,
    &$tongThoiGian,
    &$dem,
    $tgLuongTu
) {

    $tongThoiGian = 0;
    $tongTgCho    = 0;
    $tongTgLuu    = 0;
    $kt           = 0;
    //khởi tạo giá trị và copy mảng thời gian chạy
    $arrBTGoc[0] = 0;
    for ($u = 1; $u <= $soTienTrinh; $u++) {
        $arrBTGoc[$u]    = $arrBT[$u];
        $tongThoiGian    += $arrBT[$u];
        $select[$u]      = 0;
        $thoiGianLuu[$u] = 0;
        $thoiGianCho[$u] = 0;
    }
    $j = 1;
    for ($i = 1; $i <= $soTienTrinh; $i++) {
        if ($arrAT[$i] < $arrAT[$j]) {
            $j = $i;
        }
    }
    $curTime = 0;
    $dem     = 1;
    while ($curTime <= $tongThoiGian && $kt == 0) {
        if ($arrBT[$j] > $tgLuongTu) {
            $arrKT[$j]        = $curTime + $tgLuongTu;
            $arrBT[$j]        -= $tgLuongTu;
            $thuTu[$dem]      = $j;
            $canBenPhai[$dem] = $arrKT[$j];
            $dem++;
            $curTime    += $tgLuongTu;
            $select[$j] = 1; //dang cho`
        } else { //if (tienTrinh[j].thoiGianChay <= thoiGianLuongTu){
            $arrKT[$j]        = $curTime + $arrBT[$j];
            $thuTu[$dem]      = $j;
            $canBenPhai[$dem] = $arrKT[$j];
            $dem++;
            $curTime    = $arrKT[$j];
            $select[$j] = -1; //da chay xong
        }
        $dem1 = 0;
        for ($i = 1; $i <= $soTienTrinh; $i++) {
            if ($select[$i] == 0 && $arrAT[$i] <= $curTime) {
                $dem1++;
            }
        }
        if ($dem1 == 0) {
            for ($i = 1; $i <= $soTienTrinh; $i++) {
                if ($select[$i] == 1) {
                    $select[$i] = 0;
                    $dem1++;
                }
            }
            if ($dem1 == 0) {
                $kt = 1;
            } else {
                for ($i = 1; $i <= $soTienTrinh; $i++) {
                    if ($select[$i] == 0) {
                        $j = $i;
                        break;
                    }
                }
                for ($i = 1; $i <= $soTienTrinh; $i++) {
                    if ($arrAT[$i] < $arrAT[$j] && $select[$i] == 0) {
                        $j = $i;
                    }
                }
            }
        } else {
            for ($i = 1; $i <= $soTienTrinh; $i++) {
                if ($select[$i] == 0) {
                    $j = $i;
                    break;
                }
            }
            for ($i = 1; $i <= $soTienTrinh; $i++) {
                if ($arrAT[$i] < $arrAT[$j] && $select[$i] == 0) {
                    $j = $i;
                }
            }
        }
    }
    $dem--;
    for ($j = 1; $j <= $soTienTrinh; $j++) {
        $thoiGianCho[$j] = $arrKT[$j] - $arrBTGoc[$j] - $arrAT[$j];
        $tongTgCho       += $thoiGianCho[$j];
        $thoiGianLuu[$j] = $arrKT[$j] - $arrAT[$j];
        $tongTgLuu       += $thoiGianLuu[$j];
    }
}

?>