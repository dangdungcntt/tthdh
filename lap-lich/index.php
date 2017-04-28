<?php require "function.php";
      require "xuly.php"; 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Thuật toán lập lịch </title>
    <link rel="shortcut icon" type="image/png" href="../favicon.png"/>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css" media="screen">
      body{
        font-size: 18px;
      }  
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <h1><a href="../"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a> Thuật toán lập lịch</h1>
        <h2><span class="label label-info">Nguyễn Đăng Dũng - 2017</span></h2>
        <br>
      </div>
      <div class="row">
        <form method="post" action="" enctype="multipart/form-data">
          <div class="form-group">
            <label>
                <input type="radio" name="optionsInput" id="optionsFileIP" value="1" <?php if ($optionsInput == 1) echo "checked"; ?> >
                Nhập dữ liệu từ File:
            </label>
            <br>
            <div id="fileIP" style="margin-left: 30px; " <?php if ($optionsInput == 2) echo "hidden"; ?> >
              <p>Định dạng file:</p>
              <p>- Dòng đầu tiên là thời gian đến của các tiến trình - Thời gian đến là số nguyên và cách nhau 1 dấu cách.</p>
              <p>- Dòng thứ 2 là thời gian chạy tương ứng của các tiến trình - Thời gian chạy là số nguyên và cách nhau 1 dấu cách.</p>
              <p>- Nếu sử dụng thuật toán Round Robin thì dòng thứ 3 là lượng tử thời gian.</p>
              <label>
                Chọn file (định dạng *.txt, tối đa 100KB):
                <input type="file" id="filedata" name="filedata" <?php if ($optionsInput == 1) echo "required"; ?> >
              </label>
              <?php 
                if (isset($_FILES['filedata']) && $optionsInput == 1){
                  if(empty($errors)==false){
                    for ($i=0; $i < sizeof($errors); $i++) { 
                      echo '<p style="color: red;">'.$errors[$i].'</p>';
                    }
                  }
                } ?>
            </div>
            <label>
              <input type="radio" name="optionsInput" id="optionsFormIP" value="2" <?php if ($optionsInput == 2) echo "checked"; ?>>
              Nhập dữ liệu từ Form:
            </label>
          </div>
          <div id="frmIP" <?php if ($optionsInput == 1) echo "hidden"; ?> >
            <div class="form-group">
              <label>Thời gian đến của các tiến trình - Thời gian là số nguyên và cách nhau 1 dấu cách.</label>
              <input type="text" class="form-control" id="txtAT" name="txtAT" <?php if ($optionsInput == 2) echo "required"; ?> autofocus placeholder="Yêu cầu có tiến trình đến từ 0">
            </div>
            <div class="form-group">
              <label>Thời gian chạy tương ứng của các tiến trình - Thời gian là số nguyên và cách nhau 1 dấu cách.</label>
              <input type="text" class="form-control" id="txtBT" name="txtBT" <?php if ($optionsInput == 2) echo "required"; ?> >
            </div>
          </div>
          <!-- <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" id="exampleInputFile">
            <p class="help-block">Example block-level help text here.</p>
          </div> -->
          <!-- <div class="checkbox">
            <label>
              <input type="checkbox"> Check me out
            </label>
          </div> -->
          <div class="form-group">
            <label >Chọn các thuật toán</label>
            <br>
            <label class="checkbox-inline">
              <input type="checkbox" name="fcfs" value="1" <?php if ($fcfs == 1) echo 'checked='.'"checked"'; ?> > FCFS (First Come First Served)
            </label>
            <br>
            <label class="checkbox-inline">
              <input type="checkbox" name="sjnf" value="1" <?php if ($sjnf == 1) echo 'checked='.'"checked"'; ?> > SJFnP (Shortest Job First non Preemptive)
            </label>
            <br>
            <label class="checkbox-inline">
              <input type="checkbox" name="sjf" value="1" <?php if ($sjf == 1) echo 'checked='.'"checked"'; ?> > SJFP (Shortest Job First Preemptive)
            </label>
            <br>
            <label class="checkbox-inline">
              <input id="rr" type="checkbox" name="rr" value="1" <?php if ($rr == 1) echo 'checked='.'"checked"'; ?> > RR (Round Robin)
            </label>
            <br>
            <div class="input-quantum" hidden="true">
              <label style="display: block;">Lượng tử thời gian:</label>
              <div class="row">
                <div class="col-xs-2" style="float: left;">
                  <input type="text" id="txtQT" name="txtQT" class="form-control" 
                  <?php 
                    if (isset($_POST["txtQT"])) 
                      echo 'value="'.$_POST["txtQT"].'"'; ?> >
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary" name="btnRun">Tính toán</button>
        </form>
      </div>
      <br>
  
      <?php require "tra-loi-fcfs.php" ?>
      <?php require "tra-loi-sjnf.php" ?>
      <?php require "tra-loi-sjf.php" ?>
      <?php require "tra-loi-rr.php" ?>
      
      
      
    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   <!--  <script type="text/javascript" src="../js/bootstrap.min.js"></script> -->
    <!-- my script -->
    <script>
      $(document).ready(function() {
            var checked = $("#rr").attr("checked");
            var fileIPchecked = $("#optionsFileIP").attr("checked"); 
            
            if (checked == "checked" && fileIPchecked != "checked"){
              $(".input-quantum").show();
            }
            $("#rr").on('change', function(){ // on change of state
              if(this.checked && !$("#optionsFileIP").is(':checked')) // if changed state is "CHECKED"
              {
                $(".input-quantum").show(500);
                // $("#quantum").removeAttr("disabled");
                $('#txtQT').prop('required',true);
                // do the magic here
              }
              else{
                $(".input-quantum").hide(500);
              // $("#txtQT").attr("disabled", "disabled");
                $('#txtQT').prop('required',false);
              }
            });
            $("#optionsFormIP").on('change', function(){ // on change of state
              if (this.checked){
                 $("#frmIP").show(500);
                 $("#fileIP").hide(500);
                 $("#filedata").prop("required",false);
                 $("#txtAT").prop("required",true);
                 $("#txtBT").prop("required",true);
              }
              
              if($("#rr").is(':checked')) // if changed state is "CHECKED"
              {
                $(".input-quantum").show(500);
                $('#txtQT').prop('required',true);
                // $("#quantum").removeAttr("disabled");
                //$('#optionsFileIP').prop('checked');
                // do the magic here
              }
              
            });
            $("#optionsFileIP").on('change', function(){ // on change of state
              if (this.checked){
                $("#fileIP").show(500);
                 $("#frmIP").hide(500);
                 $("#filedata").prop("required",true);
                 $("#txtAT").prop("required",false);
                 $("#txtBT").prop("required",false);
              }
                
              if($("#rr").is(':checked')) // if changed state is "CHECKED"
              {
                $(".input-quantum").hide(500);
                $('#txtQT').prop('required',false);
                // $("#quantum").removeAttr("disabled");
                //$('#optionsFileIP').prop('checked');
                // do the magic here
              }
              
            });

        });
    </script>
  </body>
</html>