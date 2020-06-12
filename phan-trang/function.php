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

function thuatToanFIFO($page, $soPage, $soFrames, &$fault, &$tongSoLoi)
{
    $vtTonTaiLauNhat = 0;
    for ($i = 0; $i <= $soFrames; $i++) {
        for ($j = 0; $j <= $soPage; $j++) {
            $res[$i][$j] = 0;
        }
    }
    for ($i = 1; $i <= $soPage; $i++) {
        $fault[$i] = ' ';
        $dem[$i]   = 0;
    }
    for ($j = 1; $j <= $soPage; $j++) {
        $dem[0]     = 9999;
        $checkFault = 1;
        for ($i = 1; $i <= $soFrames; $i++) {
            $res[$i][$j] = $res[$i][$j - 1];
            $dem[$res[$i][$j - 1]]++;
        }
        for ($i = 1; $i <= $soFrames; $i++) {
            if ($res[$i][$j - 1] == $page[$j]) {
                $checkFault = 0;
            }
        }

        if ($checkFault == 0) {
            //$fault[$j]= ' ';
            continue;
        } else // checkFault == 1
        {
            $tongSoLoi++;
            $fault[$j] = 'x';
            $vtTonTaiLauNhat++;
            if ($vtTonTaiLauNhat > $soFrames) {
                $vtTonTaiLauNhat = 1;
            }
            $dem[$res[$vtTonTaiLauNhat][$j]] = 0;
            $res[$vtTonTaiLauNhat][$j]       = $page[$j];
            $dem[$page[$j]]++;
        }
    }
    return $res;
}

function thuatToanToiUu($page, $soPage, $soFrames, &$fault, &$tongSoLoi)
{
    $vtCanThayThe = 0;
    for ($i = 0; $i <= $soFrames; $i++) {
        for ($j = 0; $j <= $soPage; $j++) {
            $res[$i][$j] = 0;
        }
    }
    for ($i = 1; $i <= $soPage; $i++) {
        $fault[$i] = ' ';
        $dem[$i]   = 0;
    }
    for ($j = 1; $j <= $soPage; $j++) {
        $dem[0]     = 9999;
        $checkFault = 1;
        for ($i = 1; $i <= $soFrames; $i++) {
            $res[$i][$j] = $res[$i][$j - 1];
        }
        for ($i = 1; $i <= $soFrames; $i++) {
            if ($res[$i][$j - 1] == $page[$j]) {
                $checkFault = 0;
            }
        }
        if ($checkFault == 0) {
            continue;
        } else // checkFault == 1
        {
            $tongSoLoi++;
            $fault[$j] = 'x';
            for ($i = 1; $i <= $soFrames; $i++) {
                $dem[$res[$i][$j]] = 9999;
                for ($k = $j + 1; $k <= $soPage; $k++) {
                    if ($page[$k] == $res[$i][$j]) {
                        $dem[$res[$i][$j]] = $k - $j;
                        break;
                    }
                }
            }
            $vtCanThayThe = -1;
            $maxXa        = -1;
            for ($i = 1; $i <= $soFrames; $i++) {
                if ($dem[$res[$i][$j]] > $maxXa) {
                    $maxXa        = $dem[$res[$i][$j]];
                    $vtCanThayThe = $i;
                }
            }
            if ($maxXa == 9999) {
                $min;
                for ($i = 1; $i <= $soFrames; $i++) {
                    if ($dem[$res[$i][$j]] == $maxXa) {
                        $min = $res[$i][$j];
                        break;
                    }
                }
                for ($i = 1; $i <= $soFrames; $i++) {
                    if ($dem[$res[$i][$j]] == $maxXa && $res[$i][$j] < $min) {
                        $min          = $res[$i][$j];
                        $vtCanThayThe = $i;
                    }
                }

            }
            $res[$vtCanThayThe][$j] = $page[$j];
        }
    }
    return $res;
}

function thuatToanLRU($page, $soPage, $soFrames, &$fault, &$tongSoLoi)
{
    $vtCanThayThe = 0;
    for ($i = 0; $i <= $soFrames; $i++) {
        for ($j = 0; $j <= $soPage; $j++) {
            $res[$i][$j] = 0;
        }
    }
    for ($i = 1; $i <= $soPage; $i++) {
        $fault[$i] = ' ';
        $dem[$i]   = 0;
    }
    for ($j = 1; $j <= $soPage; $j++) {
        $dem[0]     = 9999;
        $checkFault = 1;
        for ($i = 1; $i <= $soFrames; $i++) {
            $res[$i][$j] = $res[$i][$j - 1];
        }
        for ($i = 1; $i <= $soFrames; $i++) {
            if ($res[$i][$j - 1] == $page[$j]) {
                $checkFault = 0;
            }
        }
        if ($checkFault == 0) {
            continue;
        } else // checkFault == 1
        {
            $tongSoLoi++;
            $fault[$j] = 'x';
            for ($i = 1; $i <= $soFrames; $i++) {
                $dem[$res[$i][$j]] = 9999;
                for ($k = $j - 1; $k >= 1; $k--) {
                    if ($page[$k] == $res[$i][$j]) {
                        $dem[$res[$i][$j]] = $j - $k;
                        break;
                    }
                }
            }
            $vtCanThayThe = -1;
            $maxXa        = -1;
            for ($i = 1; $i <= $soFrames; $i++) {
                if ($dem[$res[$i][$j]] > $maxXa) {
                    $maxXa        = $dem[$res[$i][$j]];
                    $vtCanThayThe = $i;
                }
            }
            if ($maxXa == 9999) {
                $min;
                for ($i = 1; $i <= $soFrames; $i++) {
                    if ($dem[$res[$i][$j]] == $maxXa) {
                        $min = $res[$i][$j];
                        break;
                    }
                }
                for ($i = 1; $i <= $soFrames; $i++) {
                    if ($dem[$res[$i][$j]] == $maxXa && $res[$i][$j] < $min) {
                        $min          = $res[$i][$j];
                        $vtCanThayThe = $i;
                    }
                }

            }
            $res[$vtCanThayThe][$j] = $page[$j];
        }
    }
    return $res;
}

?>