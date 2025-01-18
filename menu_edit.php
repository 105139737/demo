<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$sln = $_REQUEST['sl'];
$sql1 = mysqli_query($conn,"select * from main_menu where sl='$sln'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($sql1))
{
	$sls = $row['sl'];
	$msl = $row['msl'];
	$mnm = $row['mnm'];
	$fnm = $row['fnm'];
	$ntb = $row['ntb'];
}
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
function sh()
{
//$('#show').load('acldgr_form_list.php').fadeIn('fast');
}
function check(evt)
{
	var iKeyCode = (evt.which) ? evt.which : evt.keyCode
	if(iKeyCode < 48 || iKeyCode > 57)
	{
	return false;
	}
	return true;
}
</script>
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<body>
<aside class="right-side">
<section class="content-header">
                    <h1 align="center">
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Menu</li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="menu_edits.php" id="Form1">
<input type="hidden" name="sls" id="sls" width="24%" value="<?php  echo $sls;?>" class="form-control">
<input type="hidden" name="flnm" id="flnm" value="income.php" >
 <div class="col-md-12" >
              <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Menu Entry</h3>
                  <div class="box-tools pull-right">
              </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" >
          <table width="860px" class="table table-hover table-striped table-bordered">
 <tr class="odd">
     <td align="left" width="20%">
	<b>Main Menu :</b> 
	<select class="form-control" id="mm" name="mm" required>
	<option value="">---SELECT---</option>
	<?php 
	$sql1 = mysqli_query($conn,"select * from main_mmenu where sl>0") or die(mysqli_error($conn));
	while($row = mysqli_fetch_array($sql1))
	{
	$sld = $row['sl'];
	$nm = $row['nm'];
	
	?>
	<option value="<?php  echo $sld;?>" <?php  if($sld == $msl){echo 'selected';}?>><?php  echo $nm;?></option>	
	<?php 
	}
	?>
	</select></td>	
    
    <td align="left" >
	<b>Menu Name :</b>
      <input type="text" name="mnm" id="mnm" width="24%" value="<?php  echo $mnm;?>" class="form-control" required>
	</td>
	
    <td align="left">
	<b>File Name :</b>
      <input type="text" name="fnm" id="fnm" width="24%" value="<?php  echo $fnm;?>" class="form-control" required>
	</td>
    
    <td align="left" width="24%">
	<b>New Tab :</b>
	<select class="form-control" id="ntb" name="ntb" required>
				<option value="">---SELECT---</option>
				<option value="_blank"<?php  if($ntb == "_blank"){echo 'selected';}?>>Yes</option>
				<option value="" <?php  if($ntb == ""){echo 'selected';}?>>No</option>
				</select></td>	     	
  </tr>
  
  <tr class="odd">    
   <td colspan="6" align="right"><input type="submit" value="Update" class="btn btn-success"></td>	
  </tr>  
</table>
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
</html>