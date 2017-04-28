<?php
	$check=0;
	$ATime = "";
	$BTime = "";
	$mau = "";
	$tgLuongTu = 0;
	$fcfs = 1;
	$sjnf = 0;
	$sjf = 0;
	$rr = 0;
	$optionsInput = 1;
	if(isset($_POST["optionsInput"])){
		$optionsInput = $_POST["optionsInput"];
	}
	if(isset($_FILES['filedata'])){
	   	$curMiliTime = $_SERVER['REQUEST_TIME'];
	    $errors= array();
	    $file_name = $_FILES['filedata']['name'];
	    $file_size =$_FILES['filedata']['size'];
	    $file_tmp =$_FILES['filedata']['tmp_name'];
	    $file_type=$_FILES['filedata']['type'];

	    //cắt lấy phần mở rộng để kiểm tra định dạng
	    $tmp = explode('.',$_FILES['filedata']['name']);
	    $file_ext=strtolower(end($tmp));
	    $expensions= array("txt");
	    if(in_array($file_ext,$expensions) === false){
	      $errors[]="Vui lòng chọn định dạng file là *.txt";
	    }
	    if($file_size > 104858){
	      $errors[]='Kích thước file quá lớn';
	    }
	    //--------------------------
	    $tenFile = "$curMiliTime.".$file_ext;
	    if(empty($errors)==true){
	    	$check = 2;
	      move_uploaded_file($file_tmp,"upload/".$tenFile);
	    	$myfile = fopen("upload/$tenFile", "r");
	    	$ATime = fgets($myfile);
	    	//echo "-$ATime-";
	    	$ATime = trim($ATime);
	    	//echo "-$ATime-";
	    	//$ATime = substr($ATime, 0, strlen($ATime)-2);
	    	$BTime = fgets($myfile);
	    	$BTime = trim($BTime);
	    	//$BTime = substr($BTime, 0, strlen($BTime)-2);
	    	if (!feof($myfile)){
	    		$tgLuongTu = fgets($myfile);
	    		$tgLuongTu = trim($tgLuongTu);
	    	}
	    	fclose($myfile);
	    	unlink("upload/$tenFile");
		}
	}
	if (isset($_POST["btnRun"]) && $optionsInput == 2){
		$check = 2;
		$ATime = $_POST["txtAT"];
		$BTime = $_POST["txtBT"];
	}
	if (isset($_POST["fcfs"])){
		$fcfs = $_POST["fcfs"];
	}
	if (isset($_POST["sjnf"])){
		$sjnf = $_POST["sjnf"];
	}
	if (isset($_POST["sjf"])){
		$sjf = $_POST["sjf"];
	}
	if (isset($_POST["txtQT"]) && $optionsInput == 2){
		$tgLuongTu = $_POST["txtQT"];
	}
	if (isset($_POST["rr"])){
		$rr = $_POST["rr"];
	}
	else{
		if (isset($_POST["txtQT"])){
			unset($_POST["txtQT"]);
		}
	}
	if ((isset($_POST["sjnf"]) || isset($_POST["sjf"]) || isset($_POST["rr"])) && !isset($_POST["fcfs"])){
		$fcfs = 0;
	}
	if (isset($_POST["btnRun"]) && $check == 2){
		$check = 1;
		khoiTaoMau($mau,$soMau);
		$arrATtemp = tachChuoiPage($ATime,$soTienTrinh);
		$arrBTtemp = tachChuoiPage($BTime,$soTienTrinh);
		for ($i=0; $i < $soTienTrinh; $i++) { 
			$arrAT[$i+1] =$arrATtemp[$i];
			$arrBT[$i+1] =$arrBTtemp[$i];
		}
		$arrAT[0]="0";
		$arrBT[0]="0";
		$minTgCho = -1;
		if ($fcfs == 1){
			require "fcfs.php";
			if ($minTgCho == -1){
				$minTgCho = $tongTgCho;
			}
			else{
				if ($tongTgCho < $minTgCho){
					$minTgCho = $tongTgCho;
				}
			}

		}
		if ($sjnf == 1){
			require "sjnf.php";
			if ($minTgCho == -1){
				$minTgCho = $tongTgCho;
			}
			else{
				if ($tongTgCho < $minTgCho){
					$minTgCho = $tongTgCho;
				}
			}
		}
		if ($sjf == 1){
			require "sjf.php";
			if ($minTgCho == -1){
				$minTgCho = $tongTgCho;
			}
			else{
				if ($tongTgCho < $minTgCho){
					$minTgCho = $tongTgCho;
				}
			}
		}
		if ($rr == 1){
			require "rr.php";
			if ($minTgCho == -1){
				$minTgCho = $tongTgCho;
			}
			else{
				if ($tongTgCho < $minTgCho){
					$minTgCho = $tongTgCho;
				}
			}
		}
	}
	
?>