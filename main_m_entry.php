<?php
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
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
<form name="Form1" method="post" action="main_m_entrys.php" id="Form1">
<input type="hidden" name="flnm" id="flnm" value="income.php" >
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
<input type="text" class="form-control" name="nm" id="nm"  size="40">
</td>
</tr>
<tr>
<td align="left">
<input type="submit" class="btn btn-primary" value="Submit" name="B1" >
</td>
</tr>
</table>
 </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
		<div class="col-md-12" >
              <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Main Menu List</h3>
                  <div class="box-tools pull-right">
              </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" >
<?
$data= mysqli_query($conn,"SELECT * FROM main_mmenu order by sl") or die(mysqli_error($conn));
?>
<table width="860px" class="table table-hover table-striped table-bordered">
<tr style="height: 30px;">	
<th style="text-align:center;" width="10%">
Action
</th>	
<th style="text-align:center;" width="20%">
Sl.
</th>
<th style="text-align:center;" width="70%">
Menu Name
</th>
</tr>
		<?
		$f=0;
		while ($row = mysqli_fetch_array($data))
		{
		$sln= $row['sl'];
		$nm=$row['nm'];				
												
		$f++;
		if($f%2==0)
		{$cls="odd";
		}
		else
		{$cls="even";
		}
		$dt=date('d-M-Y', strtotime($dt));
		?>
<tr class="<?echo $cls;?>" style="height: 20px;">
<td align="center" valign="top">
<a href="main_m_edit.php?sl=<?=$sln;?>" title="Edit"><i class="fa fa-edit"></i></a></td>
<td align="center" valign="top"><?echo $f;?>.</td>
<td align="left" valign="top"><?echo $nm;?></td>

</tr>
  <?
  }
  ?>
</table>
</div><!-- /.box-body -->
             </div><!-- /.box -->
            </div>
 <!-- /.col -->
</form>
 </section><!-- /.content -->
 </aside><!-- /.right-side -->
</body>
<div id="underlay" style="z-index:200;">
</div>
</div>
</html>