<?php
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$sln = $_REQUEST['sl'];
$sql1 = mysqli_query($conn,"select * from main_mmenu where sl='$sln'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($sql1))
{
	$sls = $row['sl'];
	$nm = $row['nm'];

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<div class="wrapper row-offcanvas row-offcanvas-left">
<? 
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
<form name="Form1" method="post" action="main_m_edits.php" id="Form1">
<input type="hidden" name="sls" id="sls" value="<?php echo $sls;?>">
 <div class="col-md-12" >
              <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Main Menu</h3>
                  <div class="box-tools pull-right">
              </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" >
<table border="0" class="table table-hover table-striped table-bordered" >
<tr>
<td  align="left" >
<b>Main Menu:</b>
<input type="text" class="form-control" name="nm" id="nm" value="<?php echo $nm;?>"  size="40">
</td>
</tr>
<tr>
<td align="left">
<input type="submit" class="btn btn-primary" value="Update" name="B1" >
</td>
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