<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php 
include "left_bar.php";

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/advancedtable.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css"> 
a
{
   color: black;
   outline: none;
   text-decoration: none;
}
</style>
<script type="text/javascript"> 
function show()
{
 uid=document.getElementById('uid').value;
$('#show').load('mroll_list.php?uid='+uid).fadeIn('fast');
}

</script>
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<body onload="show()">
<aside class="right-side">
<section class="content-header">
                    <h1 align="center">
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Roll</li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="mrolls.php" id="Form1">
 <div class="col-md-12" >
              <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Roll Asign</h3>
                  <div class="box-tools pull-right">
              </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" >
				
<table border="0" class="table table-hover table-striped table-bordered" >
<tr>
<td>
<b>User Name:</b>
<select class="form-control" id="uid" name="uid" required onchange="show()">
<option value="">---Select---</option>
<?php 
$sql1 = mysqli_query($conn,"select * from main_signup where sl>0") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($sql1))
{
$sls = $row['sl'];
$username = $row['username'];
$name = $row['name'];
?>
<option value="<?php  echo $username;?>"><?php  echo $username;?> - <?php  echo $name?></option>	
<?php 
}
?>
</select>
</td>
</tr>
<tr>
<td>
<input type="submit" class="btn btn-success" value="Submit" name="B1" >
</td>
</tr>
</table>				
<div id="show">			

</div>


 </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
 <!-- /.col -->
</form>
 </section><!-- /.content -->
 </aside><!-- /.right-side -->
</body>
<div id="underlay" style="z-index:200;">
</div>
</div>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
  
<script type="text/javascript">
 $('#uid').chosen({no_results_text: "Oops, nothing found!",});
</script>
</html>