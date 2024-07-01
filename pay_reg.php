<?php
$reqlevel = 0;
include("membersonly.inc.php");
include "header.php";
$bill_typ=$_REQUEST['bsl'];
$get=mysqli_query($conn,"select * from main_billtype where sl='$bill_typ'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$brncds=$row['brncd'];
$typ=$row['inv_typ'];
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
   $("#fdt").datepicker(jQueryDatePicker1Opts);
   $("#tdt").datepicker(jQueryDatePicker1Opts);
});
function gtcrvl1()
	{	
	var brncd= document.getElementById('brncd').value;
		proj = document.getElementById('proj').value;
		sl = document.getElementById('dldgr').value;
		sid = document.getElementById('sid').value;
		
		$('#drbl').load('pay_reg_bal.php?sl='+sl+'&pno='+proj+'&sid1='+sid+'&brncd='+brncd).fadeIn('fast');
		//$('#crbl').load('sale_ser_totalbal.php?pno='+proj).fadeIn('fast');
		
			}
			
			function gtcrvlfi()
	{	
		var brncd= document.getElementById('brncd').value;
		proj = document.getElementById('proj').value;
		sl = document.getElementById('cldgr').value;
		$('#crbl').load('jrnl_form_gtdrvl.php?sl='+sl+'&pno='+proj+'&brncd='+brncd).fadeIn('fast');
		
	}
	
function sh()
{
var brncd= document.getElementById('brncd').value;
proj = document.getElementById('proj').value;

var fdt = document.getElementById('fdt').value;
var	tdt = document.getElementById('tdt').value;
var	ledg = document.getElementById('ledg').value;

$('#show').load('pay_list.php?pno1='+proj+'&brncd='+brncd+'&fdt='+fdt+'&tdt='+tdt+'&ledg='+ledg).fadeIn('fast');
}

function pagnt(pnog){
var brncd= document.getElementById('brncd').value;
proj = document.getElementById('proj').value;
var ps=document.getElementById('ps').value;

var fdt = document.getElementById('fdt').value;
var	tdt = document.getElementById('tdt').value;
var	ledg = document.getElementById('ledg').value;

$('#show').load("pay_list.php?ps="+ps+"&pnog="+pnog+"&pno1="+proj+'&brncd='+brncd+'&fdt='+fdt+'&tdt='+tdt+'&ledg='+ledg).fadeIn('fast');
$('#pgn').val=pnog;
}
function pagnt1(pnog){
pnog=document.getElementById('pgn').value;
pagnt(pnog);

}
	
 function sfdtlpay(sl)
{
	$('#cnt').load('pay_det.php?sl='+sl).fadeIn("fast");
	$('#myModal').modal('show');
}
function cancell(ssl)
{
		if(confirm("Are You Sure??"))
		{
		$('#show').load("cancel_clctn_rprt.php?sl="+ssl).fadeIn('fast');
		}
}
</script>
 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<?
/*$query51="select * from ".$DBprefix."drcr order by vno";
$result51 = mysqli_query($conn,$query51);
while($rows=mysqli_fetch_array($result51))
{
	$vnos=$rows['vno'];
}
	$vid1=substr($vnos,2,7);
	
$count6=5;

while($count6>0){
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);

$vno="SV".$vnoc;
$query5="select * from ".$DBprefix."drcr where vno='$vno'";
$result5 = mysqli_query($conn,$query5);
$count6=mysqli_num_rows($result5);

}*/
?>
<body onload="">
 <aside class="right-side">

  <section class="content-header">
                    <h1 align="center">
                 Payment 
                        <small>Register</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Payment Register</li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="jrnl_forms.php" id="Form1">
<input type="hidden" name="vno" id="vno" class="form-control" value="NA" readonly style="background :transparent; color : red;">
<input type="hidden" name="flnm" id="flnm" value="pay_reg.php" >
<input type="hidden" name="proj" id="proj" value="NA" readonly>
<input type="hidden" name="it" id="it" value="NA" readonly >
<input type="hidden" name="flnm1" id="flnm1" value="1" >
<input type="hidden" name="btyp" id="btyp" value="<? echo $typ; ?>" >
<input type="hidden" class="form-control"  value="<?php echo $bill_typ;?>" tabindex="1"  name="bsl" id="bsl" >              

 <div class="box box-success" >

          <table  width="860px" class="table table-hover table-striped table-bordered">
   
      
  <tr >
    <td align="right" width="20%" ><font color="red">*</font>Date :</td>
    <td align="left" width="30%" >
	<input type="text" name="dt" id="dt" value="<? echo date('d-M-Y'); ?>" class="form-control">
	</td>
	<td align="right" width="20%" ><font color="red">*</font>Branch :</td>
    <td align="left" width="30%" >
     <select name="brncd" class="form-control" size="1" id="brncd"  onchange="gtcrvl1();gtcrvlfi()" >
<?
if($user_current_level<0)
{

}
if($user_current_level<0)
{
$query="Select * from main_branch where sl='$brncds'";
}
else
{
$query="Select * from main_branch where sl='$brncds'";
}
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$slb=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $slb;?>" <?if($slb==$brncd){echo 'selected';}?>><? echo $bnm;?></option>
<?
}
?>
</select> 
	</td>   
  </tr>
  <tr style="display:none">
        <td align="right" ></td>
    <td align="left" >

						

	</td>
    <td align="right" ></td>
    <td align="left" >

	</td>
	  
  </tr>
  
   <tr >
    <td align="right" ><font color="red">*</font>Supplier :</td>
    <td align="left" >
						
							<input type="hidden" value="12" id="dldgr" name="dldgr"/> 
		<select id="sid"  name="sid"  tabindex="2" class="form-control" onchange="gtcrvl1()" >
		<option value="">---Select---</option>
	<?
$query="Select * from  main_suppl  order by spn";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sid=$R['sl'];
$spn=$R['spn'];
?>
<option value="<? echo $sid;?>"><? echo $spn;?></option>
<?
}
?>
			</select>
						
	</td>
	<td align="right" ><font color="red">*</font>Cash Or Bank Ac. :</td>
    <td align="left" >
      <select  name="cldgr" id="cldgr" class="form-control" onchange="gtcrvlfi()">
							<option value="">-- Select --</option>
							<?php 
							$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='1' or gcd='2' or gcd='22'") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?=$row['sl']?>" <?=$row['sl'] == $rowpages['pcd'] ? 'selected' : '' ?>><?=$row['nm']?></option>
							<?php 
							} 
							?>
						</select>
	</td>   
  </tr>
  
  <tr >
    
	<td align="right" > Balance :</td>
    <td align="left" >
     <div id="drbl">
	 <img src="images\rp.png" height="15px"><input type="text" name="dbal" id="dbal"  value="0.00" style="background :transparent; color : red;" readonly>
	</div>
	</td>
<td align="right" > Balance :</td>
    <td align="left" >
	<div id="crbl">
	 <img src="images\rp.png" height="15px"><input type="text" name="cbal" id="cbal" size="35" value="0.00" style="background :transparent; color : red;" readonly>
	</div>
	</td>	
  </tr>
  
  <tr >
    <td align="right" ><font color="red">*</font>Payment Mode :</td>
    <td align="left" >
	 <select  name="paymtd" id="paymtd" class="form-control">
							<option value="">-- Select --</option>
							<?php 
							$get = mysqli_query($conn,"SELECT * FROM ac_paymtd") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?=$row['sl']?>" <?=$row['sl'] == $rowpages['pcd'] ? 'selected' : '' ?>><?=$row['mtd']?></option>
							<?php 
							} 
							?>
						</select>
	</td>
	<td align="right" >Ref. No. :</td>
    <td align="left" >
       <input type="text" name="refno" id="refno" class="form-control">
	</td>   
  </tr>
  <tr >
    <td align="right" ><font color="red">*</font>Amount :</td>
    <td align="left" >
	 <img src="images\rp.png" height="15px"><input type="text" name="amm" id="amm" size="35">
	</td>
   <td align="right" ><font color="red">*</font>Narration :</td>
    <td align="left"  colspan="" >
	<input type="text" name="nrtn" id="nrtn" class="form-control">
	</td>
  </tr>

  
  
  
  <tr >
    <td colspan="4" align="right"><input type="submit" value="Submit" class="btn btn btn-success"></td>
  </tr>

</table>
</div>
 <div class="box box-success" >
 
<table border="0"   align="center" class="table table-hover table-striped table-bordered">
<tr class="odd">
<td  ><font size="4"><b>From :</b></font></td>
<td align="left">
<input type="text" name="fdt" class="form-control" id="fdt" value="">
</td>
<td  ><font size="4"><b>To :</b></font></td>
<td align="left" >
<input type="text" name="tdt" class="form-control" id="tdt" value="">
</td>   
<td  ><font size="4"><b>Supplier :</b></font></td>
<td  align="left" >

<select id="ledg" name="ledg" class="form-control"  >
<option value="">-- Select --</option>
	<?
$query="Select * from  main_suppl  order by spn";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sid=$R['sl'];
$spn=$R['spn'];
?>
<option value="<? echo $sid;?>"><? echo $spn;?></option>
<?
}
?>
</select>
</td>
<td>
<input type="button" value=" Show " onclick="sh()" class="btn btn-primary"/>
</td>
</tr>

</table>

 
<div id="show"></div>
</div>

<!-- Modal Box Start-->
<div class="modal" id="myModal">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h4>Payment Register Update</h4>
			</div>
			<div class="page" id="cnt" style="overflow: auto;"></div>
		</div>
	</div>
</div>
<!-- Modal Box End -->

</form>




 </section><!-- /.content -->
 </aside><!-- /.right-side -->
</body>

<script type="text/javascript">
  $('#sid').chosen({
  no_results_text: "Oops, nothing found!",
  
  });

$('#ledg').chosen({
  no_results_text: "Oops, nothing found!",
  
  });



  </script>

</div>
</html>