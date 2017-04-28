<?php 
	for ($i=0; $i < $soTienTrinh; $i++) { 
		$arrKT[$i+1] = 0;
	}
	$arrKT[0]="0";
	$canBenPhai[0] = 0;
	$dem = 0;
	$resSJF = thuatToanSJF($arrAT,$arrBT,$arrKT,$soTienTrinh,$thoiGianCho,$tongTgCho,$thoiGianLuu,$tongTgLuu,$thuTu,$canBenPhai,$tongThoiGian,$dem);
?>