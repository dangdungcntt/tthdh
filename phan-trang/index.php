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
    <title>Thuật toán phân trang </title>
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
      .table-responsive th{
        min-width: 35px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <h1><a href="../"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a> Thuật toán phân trang </h1>
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
              <p>- Dòng đầu tiên là chuỗi tham chiếu - Mỗi tham chiếu là số nguyên và cách nhau 1 dấu cách.</p>
              <p>- Dòng thứ 2 là số Frames (số trang cùng ở bộ nhớ trong 1 thời điểm) - Số Frames là số nguyên.</p>
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
              <label>Chuỗi tham chiếu - Mỗi tham chiếu là số nguyên và cách nhau 1 dấu cách.</label>
              <input type="text" class="form-control" id="txtPage" name="txtPage" <?php if ($optionsInput == 2) echo "required"; ?> autofocus>
            </div>
            <div class="form-group">
              <label>Số Frames</label>
              <input type="text" class="form-control" id="txtFrames" name="txtFrames" <?php if ($optionsInput == 2) echo "required"; ?> >
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
          <label >Chọn các thuật toán:</label>
          
          <br>
          <label class="checkbox-inline">
            <input type="checkbox" name="FIFO" value="1" <?php if ($fifo == 1) echo 'checked='.'"checked"'; ?> > First In First Out
          </label>
          <br>
          <label class="checkbox-inline">
            <input type="checkbox" name="OPTI" value="1" <?php if ($opti == 1) echo 'checked='.'"checked"'; ?> > Optimal Page Replacement
          </label>
          <br>
          <label class="checkbox-inline">
            <input type="checkbox" name="LRU" value="1" <?php if ($lru == 1) echo 'checked='.'"checked"'; ?> > Least Recently Used
          </label>
          <br><br>
          <button type="submit" class="btn btn-primary" name="btnRun">Tính toán</button>
        </form>
      </div>
      
      <!-- kết quả FIFO -->
  
      <?php if (isset($soPage) && $fifo == 1){ 
        echo '<hr style="border: none; border-bottom: 3px solid red;">';
      ?>

      <div class="row">
      <h3>
        FIFO <span class="label label-success"><?php echo $soPage." tham chiếu, ".$soFrames." frames"; ?></span>
        <span class="label label-danger"><?php echo $tongSoLoififo; ?> lỗi</span>
        <?php 
          if ($tongSoLoififo == $minFault){
            echo '<span class='.'"label label-warning"'.'>Tốt nhất</span>';
          }
        ?>
      </h3>
      </div>
      <div class="row">
        <div class="table-responsive"> 
          <table class="table table-bordered"> 
            <thead> 
              <tr> <!-- hàng đầu tiên là tiêu đề (giá trị các pages) -->
                <th>FIFO</th> 
                <?php for ($j = 1; $j <= $soPage ; $j++){ ?>
                <th><?php echo $arrPage[$j]; ?></th> 
                <?php } ?>
              </tr> 
            </thead> 
            <tbody> 
              <?php for ($i = 1; $i <= $soFrames ; $i++) { ?>
              <tr> <!-- các hàng tiếp theo là kết quả -->
                <th scope="row"><?php echo "F$i"; ?></th> 
                <?php for ($j = 1;$j <= $soPage ; $j++){ ?>
                <td><?php if ($resfifo[$i][$j]==0) echo " "; else echo $resfifo[$i][$j]; ?></td> 
                <?php } ?>
              </tr> 
              <?php } ?>
              
              <tr> <!-- hàng này là hàng lỗi -->
                <th scope="row">Fault</th> 
                <?php for ($j = 1;$j <= $soPage ; $j++){ ?>
                <td style="font-weight: bold; color: red;"><?php echo $faultfifo[$j]; ?></td> 
                <?php } ?>
              </tr> 
            
            </tbody> 
          </table> 
        </div> <!-- /table-responsive -->
      </div> <!-- /row -->
      <?php } ?> <!-- end kết quả FIFO -->

      <!-- kết quả OPTI -->
      
      <?php if (isset($soPage) && $opti == 1){ 
        echo '<hr style="border: none; border-bottom: 3px solid red;">';
        ?>
      <div class="row">
      <h3>
        OPR <span class="label label-success"><?php echo $soPage." tham chiếu, ".$soFrames." frames"; ?></span>
        <span class="label label-danger"><?php echo $tongSoLoiopti; ?> lỗi</span>
        <?php 
          if ($tongSoLoiopti == $minFault){
            echo '<span class='.'"label label-warning"'.'>Tốt nhất</span>';
          }
        ?>
      </h3>
      </div>
      <div class="row">
        <div class="table-responsive"> 
          <table class="table table-bordered"> 
            <thead> 
              <tr> <!-- hàng đầu tiên là tiêu đề (giá trị các tham chiếu) -->
                <th>OPR</th> 
                <?php for ($j = 1; $j <= $soPage ; $j++){ ?>
                <th><?php echo $arrPage[$j]; ?></th> 
                <?php } ?>
              </tr> 
            </thead> 
            <tbody> 
              <?php for ($i = 1; $i <= $soFrames ; $i++) { ?>
              <tr> <!-- các hàng tiếp theo là kết quả -->
                <th scope="row"><?php echo "F$i"; ?></th> 
                <?php for ($j = 1;$j <= $soPage ; $j++){ ?>
                <td><?php if ($resopti[$i][$j]==0) echo " "; else echo $resopti[$i][$j]; ?></td> 
                <?php } ?>
              </tr> 
              <?php } ?>
              
              <tr> <!-- hàng này là hàng lỗi -->
                <th scope="row">Fault</th> 
                <?php for ($j = 1;$j <= $soPage ; $j++){ ?>
                <td style="font-weight: bold; color: red;"><?php echo $faultopti[$j]; ?></td> 
                <?php } ?>
              </tr> 
            
            </tbody> 
          </table> 
        </div> <!-- /table-responsive -->
      </div> <!-- /row -->
      <?php } ?> <!-- end kết quả OPTI -->

      <!-- kết quả LRU -->
      
      <?php if (isset($soPage) && $lru == 1){ 
        echo '<hr style="border: none; border-bottom: 3px solid red;">';
        ?>
      <div class="row">
      <h3>
        LRU <span class="label label-success"><?php echo $soPage." tham chiếu, ".$soFrames." frames"; ?></span>
        <span class="label label-danger"><?php echo $tongSoLoilru; ?> lỗi</span>
        <?php 
          if ($tongSoLoilru == $minFault){
            echo '<span class='.'"label label-warning"'.'>Tốt nhất</span>';
          }
        ?>
      </h3>
      </div>
      <div class="row">
        <div class="table-responsive"> 
          <table class="table table-bordered"> 
            <thead> 
              <tr> <!-- hàng đầu tiên là tiêu đề (giá trị các pages) -->

                <th>LRU
                </th> 
                <?php for ($j = 1; $j <= $soPage ; $j++){ ?>
                <th>
                  <?php echo $arrPage[$j]; ?>
                </th>  <!-- in giá trị page (tiêu đề cột) -->
                <?php } ?>
              </tr> 
            </thead> 
            <tbody> 

              <?php for ($i = 1; $i <= $soFrames ; $i++) { ?>
              <tr> <!-- các hàng tiếp theo là kết quả -->
                <th scope="row">
                  <?php echo "F$i"; ?>
                </th> <!-- tiêu đề hàng -->
                <?php for ($j = 1;$j <= $soPage ; $j++){ ?>
                <td>
                  <?php if ($reslru[$i][$j]==0) echo " "; else echo $reslru[$i][$j]; ?>
                </td> 
                <?php } ?>
              </tr> 
              <?php } ?>
              
              <tr> <!-- hàng này là hàng lỗi -->
                <th scope="row">Fault</th> 
                <?php for ($j = 1;$j <= $soPage ; $j++){ ?>
                <td style="font-weight: bold; color: red;"><?php echo $faultlru[$j]; ?></td> 
                <?php } ?>
              </tr> 
            </tbody> 
          </table> 
        </div> <!-- /table-responsive -->
      </div> <!-- /row -->
      <?php } ?> <!-- end kết quả LRU-->

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery-3.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="../js/bootstrap.min.js"></script> -->
    <script>
      $(document).ready(function() {
            $("#optionsFormIP").on('change', function(){ // on change of state
              if (this.checked){
                 $("#frmIP").show(500);
                 $("#fileIP").hide(500);
                 $("#filedata").prop("required",false);
                 $("#txtPage").prop("required",true);
                 $("#txtFrames").prop("required",true);
              }
            });
            $("#optionsFileIP").on('change', function(){ // on change of state
              if (this.checked){
                $("#fileIP").show(500);
                 $("#frmIP").hide(500);
                 $("#filedata").prop("required",true);
                 $("#txtPage").prop("required",false);
                 $("#txtFrames").prop("required",false);
              }
            });

        });
    </script>
  </body>
</html>