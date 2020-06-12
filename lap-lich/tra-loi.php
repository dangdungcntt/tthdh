<div class="row">
    <h2>
        <?php echo $tenThuatToan; ?>
        <span class="label label-success"><?php echo "$soTienTrinh tiến trình, thời gian $tongThoiGian"; ?></span>
        <?php if ($tongTgCho == $minTgCho) {
            echo '<span class='.'"label label-warning"'.'>Tốt nhất</span>';
        }
        ?>
    </h2>
    <h3>

        <?php if ($isRR == 1) : ?>
            <span class="label label-info">
                <?= "Thời gian lượng tử: $tgLuongTu" ?>
            </span>
        <?php endif; ?>

        <span class="label label-danger">
            <?php echo "Chờ trung bình: ".number_format($tongTgCho / $soTienTrinh, 2); ?>
        </span>

        <span class="label label-primary">
            <?php echo "Lưu trung bình: ".number_format($tongTgLuu / $soTienTrinh, 2); ?>
        </span>
    </h3>
</div>
<!-- end row -->
<div class="row">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <!-- hàng đầu tiên là tiêu đề (giá trị các pages) -->
                <th><?php echo "$tenThuatToan"; ?></th>
                <?php for ($j = 1; $j <= $soTienTrinh; $j++) : ?>
                    <th><?php echo "P$j"; ?></th>
                <?php endfor; ?>
                <th>Tổng</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <!-- các hàng tiếp theo là kết quả --> <!-- hàng thời gian đến -->
                <th scope="row">TG Đến</th>
                <?php for ($j = 1; $j <= $soTienTrinh; $j++) : ?>
                    <td><?php echo $arrAT[$j]; ?></td>
                <?php endfor; ?>
                <td>X</td>
            </tr>
            <?php if ($isSJFP == 0 && $isRR == 0) : ?>
                <tr>
                    <!-- các hàng tiếp theo là kết quả --> <!-- hàng thời gian bắt đầu chạy -->
                    <th scope="row">BĐ Chạy</th>
                    <?php for ($j = 1; $j <= $soTienTrinh; $j++) : ?>
                        <td><?= $arrKT[$j] - $arrBT[$j] ?></td>
                    <?php endfor; ?>
                    <td>X</td>
                </tr>
            <?php endif; ?>
            <tr>
                <!-- các hàng tiếp theo là kết quả --> <!-- hàng thời gian chạy -->
                <th scope="row">TG Chạy</th>
                <?php for ($j = 1; $j <= $soTienTrinh; $j++) { ?>
                    <td><?php echo $arrBT[$j]; ?></td>
                <?php } ?>
                <td><?php echo $tongThoiGian; ?></td>
            </tr>
            <tr>
                <!-- các hàng tiếp theo là kết quả --> <!-- hàng thời gian kết thúc -->
                <th scope="row">TG Kết thúc</th>
                <?php for ($j = 1; $j <= $soTienTrinh; $j++) { ?>
                    <td><?php echo $arrKT[$j]; ?></td>
                <?php } ?>
                <td>X</td>
            </tr>
            <tr>
                <!-- các hàng tiếp theo là kết quả --> <!-- hàng thời gian chờ -->
                <th scope="row">TG Chờ</th>
                <?php for ($j = 1; $j <= $soTienTrinh; $j++) { ?>
                    <td><?php echo $thoiGianCho[$j]; ?></td>
                <?php } ?>
                <td><?php echo $tongTgCho; ?></td>
            </tr>
            <tr>
                <!-- các hàng tiếp theo là kết quả --> <!-- hàng thời gian lưu -->
                <th scope="row">TG Lưu</th>
                <?php for ($j = 1; $j <= $soTienTrinh; $j++) { ?>
                    <td><?php echo $thoiGianLuu[$j]; ?></td>
                <?php } ?>
                <td><?php echo $tongTgLuu; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- /table-responsive -->
</div>
<!-- /row -->
<div class="row">
    <h3><span class="label label-info">Biểu đồ Grantt <?php echo "$tenThuatToan"; ?></span></h3>
</div>
<?php if ($tongThoiGian > 25) { ?>
    <div class="row">
        <!-- thanh tiến trình dạng bảng responsive-->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <!-- thông tin tiến trình -->
                    <?php $curMau = 1;
                    for ($i = 1; $i <= $dem; $i++) {
                        if ($curMau == 21) {
                            $curMau = 1;
                        }
                        $tgChay = ($canBenPhai[$i] - $canBenPhai[$i - 1]);
                        ?>
                        <th style="text-align: center;font-size: 30px; height: 50px; min-width: <?php echo ($tgChay * 37).'px'.";background-color:$mau[$curMau]";
                        $curMau++; ?>"><?php echo "P$thuTu[$i]"; ?></th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <!-- hàng chỉ số thời gian -->
                    <?php for ($i = 1; $i <= $dem; $i++) { ?>
                        <td style="font-size: 20px;">
                            <div style="float: left;"><?php echo $canBenPhai[$i - 1]; ?></div>
                            <div style="float: right;"><?php echo $canBenPhai[$i]; ?></div>
                        </td>
                    <?php } ?>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- /table-responsive -->
    </div>
    <!-- /row -->
<?php } ?>
<?php if ($tongThoiGian <= 25) { ?>
    <div class="row">
        <!-- thanh tiến trình bình thường -->
        <div class="progress" style="height: 50px">
            <!-- thanh tiến trình -->
            <?php $curMau = 0;
            for ($i = 1; $i <= $dem; $i++) {
                if ($curMau == 20) {
                    $curMau = 0;
                }
                $phanTram = ($canBenPhai[$i] - $canBenPhai[$i - 1]) * 100 / $tongThoiGian;
                ?>
                <div class="progress-bar progress-bar-success"
                     style="width: <?php echo "$phanTram%;background-color:$mau[$curMau];";
                     $curMau++; ?> font-size: 30px; padding-top: 15px;">
                    P<?php echo $thuTu[$i]; ?> <!-- tiến trình thứ i -->
                </div>
            <?php } ?>
        </div>
        <!-- end thanh tiến trình -->
        <div class="progress" style="height: 35px">
            <!-- thanh chỉ số -->
            <?php for ($i = 1; $i <= $dem; $i++) {
                $phanTram = ($canBenPhai[$i] - $canBenPhai[$i - 1]) * 100 / $tongThoiGian;
                if ($i == 1) {
                    $phanTram += 0.85;
                } elseif ($i == $soTienTrinh) {
                    $phanTram -= 0.85;
                }
                ?>
                <div class="progress-bar progress-bar-success"
                     style="width: <?php echo "$phanTram%;"; ?>  padding-top: 3px;background: white; color: black;font-size: 30px;">
                    <?php
                    if ($i == 1) {
                        echo '<div style="float: left;">0</div>';
                    }
                    echo '<div style="float: right;">'."$canBenPhai[$i]</div>";
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>


<?php } ?>