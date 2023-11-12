<?php
$reqlevel = 0;
include("membersonly.inc.php");
include "header.php";
$csl=$_REQUEST[csl];
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
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
<style type="text/css">
#sfdtl
{
	border : none;
	border-radius: 15px;
	background-image: url(images/bg1.png);
	width : 850px;
	
	display : none;
	color: #fff;
	position : absolute;
	left : 350px;
	top : 250px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
}
#underlay{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background-color:#000;
    -moz-opacity:0.5;
    opacity:.50;
    filter:alpha(opacity=50);
}
</style>

<script>
 function mnu()
 {
 $('#pmnu').load('mnu.php').fadeIn("slow");
  $('#tmnu').load('mnu2.php').fadeIn("slow");
 }
 </script>
<style type="text/css"> 
a
{
   color: black;
   outline: none;
   text-decoration: none;
}

</style>
<link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css"> 

#jQueryDatePicker1
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}

</style>


<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<link rel="stylesheet" href="wb.validation.css" type="text/css">
<script type="text/javascript" src="wb.validation.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function()
{
   var jQueryDatePicker1Opts =
   {
      dateFormat: 'dd-M-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
   $("#dt").datepicker(jQueryDatePicker1Opts);
});

</script>
 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" src="account.js" ></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
</head>

<body onload="sh()">
 <aside class="right-side">

  <section class="content-header">
                    <h1 align="center">
                 Credit 
                        <small>Note Edit</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Credit Note Edit</li>
                    </ol>
                </section>
				   <section class="content">
 <div class="box box-success" >
<form name="Form1" method="post" action="crdt_notes.php" id="Form1">

<?
 $data= mysqli_query($conn,"SELECT * FROM main_drcr where sl='$csl'")or die(mysqli_error($conn));
 
	
		while ($row = mysqli_fetch_array($data))
		{
		$sl1= $row['sl'];
		$dt= $row['dt'];
		$pno= $row['pno'];
		$vno= $row['vno'];
		$cldgr= $row['cldgr'];
		$dldgr= $row['dldgr'];
		$mtd= $row['mtd'];
		$mtddtl= $row['mtddtl'];
		$amm= $row['amm'];
		$nrtn= $row['nrtn'];
		$eby= $row['eby'];
		$edt= $row['edt'];
		$sid1= $row['sid'];
		$brncd= $row['brncd'];
		$bill_typ= $row['bill_typ'];
		}
?>



<input type="hidden" name="vno" id="vno" class="form-control" value="<?=$vno;?>">
<input type="hidden" class="form-control"  value="<?php echo $bill_typ;?>" tabindex="1"  name="bsl" id="bsl" >              

<table  width="860px" class="table table-hover table-striped table-bordered">

  <tr >
    <td align="right" width="20%" style="padding-top:15px"><font color="red">*</font><b>Date :</b></td>
    <td align="left" width="30%" >
	<input type="text" name="dt" id="dt" value="<?=$dt;?>" class="form-control">
	</td>
        <td align="right" style="padding-top:15px" ><font color="red">*</font><b>Branch :</b></td>
    <td align="left" >
 	<select name="brncd" class="form-control" size="1" id="brncd"  onchange="sh();" >
<?
if($user_current_level<0)
{
	?>
	<option value="">---ALL---</option>
	<?
}
if($user_current_level<0)
{
$query="Select * from main_branch";
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$slb=$R['sl'];
$bnm=$R['bnm'];
?>
<option value="<?=$slb;?>"<? if($slb==$brncd){echo 'selected';}?>><?=$bnm;?></option>
<?
}
?>
</select>
	</td>
  </tr>
  
   <tr >
    <td align="right" style="padding-top:15px"><font color="red">*</font><b>Supplier :</b></td>
    <td align="left" >
						
							<input type="hidden" value="12" id="dldgr" name="dldgr"/> 
							<input type="hidden" value="35" id="cldgr" name="cldgr"/> 
		<select id="sid"  name="sid"  tabindex="2" class="form-control"  >
		<option value="">---Select---</option>
	<?
$query="Select * from  main_suppl order by spn";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sid=$R['sl'];
$spn=$R['spn'];
?>
<option value="<? echo $sid;?>" <? if($sid==$sid1){echo 'selected';}?>><? echo $spn;?></option>
<?
}
?>
			</select>
						
	</td>
	<td align="right" style="padding-top:15px"><font color="red">*</font><b>Credit Note No. :</b></td>
    <td align="left" >
    <input type="text" name="cno" id="cno" value="<?=$mtddtl;?>" class="form-control" />
	</td>   
  </tr>
  
  <tr >
    <td align="right" style="padding-top:15px"><font color="red">*</font><b>Ammount :</b></td>
    <td align="left" ><input type="text" name="amm" id="amm"  value="<?=$amm;?>"size="35" class="form-control" ></td>

    <td align="right" style="padding-top:15px"><b>Remark :</b></td>
    <td align="left"  colspan="3" >
	<input type="text" name="nrtn" id="nrtn" value="<?=$nrtn;?>" class="form-control">
	<input type="hidden" name="sl" id="sl" value="<?=$sl1;?>" class="form-control" readonly>
	</td>
  </tr>
  <tr >
    <td colspan="4" align="right"><input type="submit" value="Update" class="btn btn btn-success"></td>
  </tr>
</table>
</form>
</div>
 <div class="box box-success" >
<div id="show">

</div>
</div>
<div id='sfdtl' align='center' style="z-index:1000;">
Loding.....<br>
<img src="images/loading.gif">
</div> 
 </section><!-- /.content -->
 </aside><!-- /.right-side -->
</body>

<script type="text/javascript">
  $('#sid').chosen({
  no_results_text: "Oops, nothing found!",
  });
</script>
<div id="underlay" style="z-index:200;">
</div>
</div>
</html>
