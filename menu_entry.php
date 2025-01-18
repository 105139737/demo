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

function snd_fun(sl,val)
{
	$('#snd_div'+sl).load('update_snd.php?sl='+sl+"&val="+val).fadeIn('fast');	
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
<form name="Form1" method="post" action="menu_entrys.php" id="Form1">
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
	$sls = $row['sl'];
	$nm = $row['nm'];
	
	?>
	<option value="<?php  echo $sls;?>"><?php  echo $nm;?></option>	
	<?php 
	}
	?>
	</select></td>	 
    
    <td align="left" >
	<b>Menu Name :</b>
      <input type="text" name="mnm" id="mnm" width="20%" class="form-control" required>
	</td>
	
    <td align="left">
	<b>File Name :</b>
      <input type="text" name="fnm" id="fnm" width="20%" class="form-control" required>
	</td>
    
    <td align="left" width="20%">
	<b>New Tab :</b>
	<select class="form-control" id="ntb" name="ntb" required>
				<option value="">---SELECT---</option>
				<option value="_blank">Yes</option>
				<option value="">No</option>
				</select></td>	     	
  </tr>
  
  <tr class="odd">    
   <td colspan="6" align="right"><input type="submit" value="Submit" class="btn btn-success"></td>	
  </tr>  
</table>
 </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
		<div class="col-md-12" >
              <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Menu List</h3>
                  <div class="box-tools pull-right">
              </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" >
<?php 
$data= mysqli_query($conn,"SELECT * FROM main_menu order by msl,sl") or die(mysqli_error($conn));
?>
<table width="860px" class="table table-hover table-striped table-bordered">
<tr style="height: 30px;">
<th style="text-align:center;" width="5%">
Sl.
</th>
<th style="text-align:center;" width="10%">
Main Menu
</th>
<th style="text-align:center;" width="10%">
Menu Name
</th>
<th style="text-align:center;" width="10%">
Execution Time
</th>
<th style="text-align:center;" width="10%">
File Name
</th>
<th style="text-align:center;" width="10%">
New Tab
</th>		

<th style="text-align:center" width="5%">
Edit
</th>	
</tr>
		<?php 
		$f=0;
		while ($row = mysqli_fetch_array($data))
		{
		$sln= $row['sl'];
		$msl= $row['msl'];
		$data2= mysqli_query($conn,"SELECT * FROM main_mmenu where sl='$msl' ") or die(mysqli_error($conn));
		while($r = mysqli_fetch_array($data2))
		{
			$nm1 = $r['nm'];
		}
		$mnm=$row['mnm'];				
		$fnm=$row['fnm'];				
		$ntb=$row['ntb'];				
		$snd=$row['snd'];				
		
        if($ntb == "_blank")
		{
			$ntb1 = "Yes";
		}
		else
		{
			$ntb1 = "No";
		}	
				
		$f++;
		if($f%2==0)
		{$cls="odd";
		}
		else
		{$cls="even";
		}
	//	$dt=date('d-M-Y', strtotime($dt));
		?>
<tr class="<?php echo $cls;?>" style="height: 20px;">
<td align="center" valign="top"><?php echo $f;?>.</td>
<td align="left" valign="top"><?php echo $nm1;?></td>
<td align="left" valign="top"><?php echo $mnm;?></td>
<td align="left" valign="top"><?php  if($msl=='4' or $msl=='7'){?><input type="text" onblur="snd_fun('<?php  echo $sln?>',this.value)" name="snd" id="snd" value="<?php echo $snd;?>" class="form-control"><?php  } ?>
<div id="snd_div<?php  echo $sln?>"></div>
</td>
<td align="left" valign="top"><?php echo $fnm;?></td>
<td align="left" valign="top"><?php echo $ntb1;?></td>

<td align="left" valign="top">
<a href="menu_edit.php?sl=<?php  echo $sln;?>" title="Edit"><i class="fa fa-edit"></i></a></td>
</tr>
  <?php 
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