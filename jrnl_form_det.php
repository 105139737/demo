<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$sl=$_REQUEST['sl'];		
$data= mysqli_query($conn,"SELECT * FROM main_drcr where sl='$sl'");
while ($row = mysqli_fetch_array($data))
{
	$dt= $row['dt'];
	$pno= $row['pno'];
	$vno= $row['vno'];
	$cldgr= $row['cldgr'];
	$dldgr= $row['dldgr'];
	$paymtd= $row['mtd'];
	$mtddtl= $row['mtddtl'];
	$amm= $row['amm'];
	$nrtn= $row['nrtn'];
	$it= $row['it'];
	$bsl= $row['bsl'] ?? "";
	$sid= $row['sid'];
	$bill_typ= $row['bill_typ'];
	$brncd= $row['brncd'];
	
		$imgpath="img/jrnl_form/".$vno.".jpg";
		
		if (!file_exists($imgpath)) {
		$imgpath1="img/noimg.jpg";
		}
		else
		{
		$imgpath1=$imgpath;
		}
}
$dt=date('d-M-Y', strtotime($dt));
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
<title>Journal Forms</title>
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

		proj = document.getElementById('proj').value;
		sl = document.getElementById('cldgr').value;
		var brncd= document.getElementById('brncd').value;
		cid = document.getElementById('cust').value;
		sid = document.getElementById('sup').value;
		$('#crbl').load('jrnl_form_gtdrvl_new.php?sl='+sl+'&pno='+proj+'&brncd='+brncd+'&cid='+cid+'&sid='+sid).fadeIn('fast');
	}
	
	function gtdrvl(sl)
	{	var brncd= document.getElementById('brncd').value;
		proj = document.getElementById('proj').value;
		sl = document.getElementById('dldgr').value;
	
		cid = document.getElementById('cust1').value;
		sid = document.getElementById('sup1').value;
		
		$('#drbl').load('jrnl_form_gtdrvl_new.php?sl='+sl+'&pno='+proj+'&brncd='+brncd+'&cid='+cid+'&sid='+sid).fadeIn('fast');
		sh();
	}

function sh()
{
var brncd= document.getElementById('brncd').value;
proj = document.getElementById('proj').value;

var fdt = document.getElementById('fdt').value;
var	tdt = document.getElementById('tdt').value;
var	ledg = document.getElementById('ledg').value;

$('#show').load('jrnl_list.php?pno1='+proj+'&brncd='+brncd+'&fdt='+fdt+'&tdt='+tdt+'&ledg='+ledg).fadeIn('fast');
}

function pagnt(pnog){
var brncd= document.getElementById('brncd').value;
proj = document.getElementById('proj').value;
var ps=document.getElementById('ps').value;

var fdt = document.getElementById('fdt').value;
var	tdt = document.getElementById('tdt').value;
var	ledg = document.getElementById('ledg').value;

$('#show').load("jrnl_list.php?ps="+ps+"&pnog="+pnog+"&pno1="+proj+'&brncd='+brncd+'&fdt='+fdt+'&tdt='+tdt+'&ledg='+ledg).fadeIn('fast');
$('#pgn').val=pnog;
}
function pagnt1(pnog){
pnog=document.getElementById('pgn').value;
pagnt(pnog);

}

		 		function chk_dt(cdt)
{
    ddt=document.getElementById('dt').value;
    
    $.get('set_date_limit_chk.php?dt='+ddt, function(data) {
		if(data=='0')
		{
			
		document.getElementById('dt').value=cdt;	
		alert('You Have No Permission For Entry Date.');
		}
  
}); 


}

 function sfdtl3(sl)
{
	$('#cnt').load('jrnl_form_det.php?sl='+sl).fadeIn("fast");
	$('#myModal').modal('show');
}

function cancell(ssl)
{
		if(confirm("Are You Sure??"))
		{
		$('#show').load("cancel_clctn_rprt.php?sl="+ssl).fadeIn('fast');
		}
}

function readURL(input)
{
if (input.files && input.files[0]) {
	var reader = new FileReader();
	reader.onload = function (e) {
		$('#blah')
			.attr('src', e.target.result)
			  .width(200)
			.height(250);
	};

	reader.readAsDataURL(input.files[0]);
}
}

function readURL1(input)
{
if (input.files && input.files[0]) {
	var reader = new FileReader();
	reader.onload = function (e) {
		$('#blah1')
			.attr('src', e.target.result)
			  .width(200)
			.height(250);
	};

	reader.readAsDataURL(input.files[0]);
}
}


   function sia(val,sid)
 {
	sid = document.getElementById('sup').value;
	 $('#cs').load('cusi_ledgr_jrnl.php?val='+val+'&sid='+sid).fadeIn('fast'); 
	
	 if(val==4)
	 {
		 $('#c').html('Customer :');
	 }
	 else if(val==12)
	 {
		$('#c').html('Supplier :'); 
	 }
	 else
	 {
		 $('#c').html('');
	 }
	 
 }
   function sia1(val,sid)
 {
	
	 $('#cs1').load('cusi_ledgr1.php?val='+val+'&sid='+sid).fadeIn('fast'); 
	
	 if(val==4)
	 {
		 $('#c1').html('Customer :');
	 }
	 else if(val==12)
	 {
		$('#c1').html('Supplier :'); 
	 }
	 else
	 {
		 $('#c1').html('');
	 }
	 
 }
 

</script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<?php 
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
$get=mysqli_query($conn,"select * from main_billtype where sl='$bill_typ'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$brncds=$row['brncd'];
$typ=$row['inv_typ'];

}
?>
<body >
 <aside class="right-side">
  <section class="content-header">
                    <h1 align="center">
                 J O U R N A L
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">J O U R N A L</li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="jrnl_forms.php" id="Form1" enctype="multipart/form-data">
<input type="hidden" name="updt" id="updt" value="<?php  echo $sl;?>" >
<input type="hidden" name="flnm1" id="flnm1" value="1" >
<input type="hidden" name="btyp" id="btyp" value="<?php  echo $typ; ?>" >
<input type="hidden" class="form-control"  value="<?php  echo $bill_typ;?>" tabindex="1"  name="bsl" id="bsl" >              


 <select  name="it" id="it" class="form-control" style="display:none">
							<option value="">-- Select --</option>
							<option value="1">IT</option>
							<option selected value="0">Non-IT</option>
						</select>
<select  name="proj" id="proj" class="form-control" style="display:none">

<option value="0"> NA </option>
<?php  
$get = mysqli_query($conn,"SELECT * FROM main_project") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?php  echo $row['sl']?>"><?php  echo $row['nm']?></option>
<?php  
} 
?>
</select>
<input type="hidden" name="vno" id="vno" class="form-control" value="NA" readonly style="background :transparent; color : red;">
<input type="hidden" name="flnm" id="flnm" value="jrnl_form.php" >
 <div class="box box-success" >

<table  width="860px" class="table table-hover table-striped table-bordered">

       
  <tr>
    <td align="right" width="10%"><font color="red">*</font>Date :</td>
    <td align="left" width="40%">
	<input type="text" name="dt" id="dt" class="form-control"  value="<?php  echo $dt; ?>" onchange="chk_dt('<?php echo date('d-M-Y')?>')">
	</td>
	<td align="right" width="10%"><font color="red">*</font>Branch:</td>
    <td align="left" width="40%">
    <select name="brncd" class="form-control" size="1" id="brncd"  onchange="gtcrvl1();gtdrvl()" >
<?php 
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
<option value="<?php  echo $slb;?>" <?php if($slb==$brncd){echo 'selected';}?>><?php  echo $bnm;?></option>
<?php 
}
?>
</select> 
	</td>   
  </tr>

<tr style="display:none;">
<td align="right"></td>
<td align="left">

</td>
<td align="right"></td>
<td align="left" >

</td>

</tr>
  
   <tr >
    <td align="right" width="10%" ><font color="red">*</font>Credit Ledger :</td>
    <td align="left" width="40%" >
	<div id="cldgr_div">
	
	 <select  name="cldgr" id="cldgr" class="sc" onchange="gtcrvl1(),sia(this.value),show_div(this.value)">
							<option value="">-- Select --</option>
							<?php  
							$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd!='3' and gcd!='5' and sl>0 and sl!=4  order by nm") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?php  echo $row['sl']?>" <?php  echo $row['sl'] == $cldgr? 'selected' : '' ?>><?php  echo $row['nm']?></option>
							<?php  
							} 
							?>
	</select>
	</div>
	</td>
	<td align="right" width="10%" ><font color="red">*</font>Debit Ledger :</td>
    <td align="left" width="50%">
	<div id="dldgr_div">
	
      <select  name="dldgr" id="dldgr" class="sc" onchange="gtdrvl(),sia1(this.value),show_div1(this.value)">
							<option value="">-- Select --</option>
							<?php  
							$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd!='3' and gcd!='4' and gcd!='5' and sl>0 and sl!=4 order by nm") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?php  echo $row['sl']?>" <?php  echo $row['sl'] == $dldgr ? 'selected' : '' ?>><?php  echo $row['nm']?></option>
							<?php  
							} 
							?>
	</select>
	</div>
	</td>   
  </tr>
  <tr >
  <td style="padding-top:15px;" align="right">
	  <b>
	  <div id="c">
		</div>
		</b>
	  </td>
	  
	  <td>
	  	<div id="cs">
	<input type="hidden" id="cust" value="">
	<input type="hidden" id="sup" value="">
	</div>
	  </td>
	  
	  
	  
	  
 <td style="padding-top:15px;" align="right">
	  <b>
	  <div id="c1">
		</div>
		</b>
	  </td>
	  
	  <td>
	  	<div id="cs1">
	<input type="hidden" id="cust1" value="">
	<input type="hidden" id="sup1" value="">
	</div>
	  </td>
</tr>
  <tr style="display:none;" >
    <td align="right"> Balance :</td>
    <td align="left" >
	<div id="crbl">
	 <img src="images\rp.png" height="15px"><input type="text" name="cbal" id="cbal" size="35" value="0.00" style="background :transparent; color : red;" readonly>
	</div>
	</td>
	<td align="right" >Balance :</td>
    <td align="left" >
     <div id="drbl">
	 <img src="images\rp.png" height="15px"><input type="text" name="dbal" id="dbal" size="35" value="0.00" style="background :transparent; color : red;" readonly>
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
								<option value="<?php  echo $row['sl']?>" <?php  echo $row['sl'] == $paymtd ? 'selected' : '' ?>><?php  echo $row['mtd']?></option>
							<?php  
							} 
							?>
						</select>
	</td>
	<td align="right" >Ref. No. :</td>
    <td align="left" >
       <input type="text" name="refno" id="refno" value="<?php  echo $mtddtl;?>" class="form-control">
	</td>   
  </tr>
  <tr >
    <td align="right" ><font color="red">*</font>Amount :</td>
    <td align="left" >
	 <img src="images\rp.png" height="15px"><input type="text" name="amm" value="<?php  echo $amm;?>" id="amm" size="35">
	</td>
	<td align="right" ><font color="red">*</font>Narration :</td>
    <td align="left" >
  <input type="text" name="nrtn" id="nrtn" class="form-control" value="<?php  echo $nrtn;?>">
	</td>   
  </tr>
<tr>
 <td align="right"  >Upload Picture :</td>
 <td colspan="3">
 <!--
<label for="fileToUpload" title="Click To Chose Picture">
<img id="blah" src="img/upld.jpg" alt="Image" style="width:200px; height:250px; cursor:pointer;"/>
</label>-->
<input type="file" name="fileToUpload1" id="fileToUpload1" class="btn btn-info" onchange="readURL(this);" >
</td>
  </tr>
  <tr style="display:none;">
    <td align="right" ></td>
    <td align="left"  colspan="3">
	
	</td>
	 
  </tr>
  
  
  
  
  <tr>
    <td colspan="4" align="right"><input type="submit" value="Submit" class="btn btn btn-success"></td>
  </tr>

</table>
</div>

<!-- Modal Box Start-->
<div class="modal" id="myModal">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h4>J O U R N A L Update</h4>
			</div>
			<div class="page" id="cnt" style="overflow: auto;"></div>
		</div>
	</div>
</div>
<!-- Modal Box End -->
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">

sia('<?php  echo $cldgr;?>','<?php  echo $sid;?>');
sia1('<?php  echo $dldgr;?>','<?php  echo $sid;?>');

  $('#ledg').chosen({
  no_results_text: "Oops, nothing found!",
  });
$('#cldgr').chosen({
  no_results_text: "Oops, nothing found!",
  });
 $('#dldgr').chosen({
  no_results_text: "Oops, nothing found!",
  });
  function show_div(xx)
  {
	  var dldgr=document.getElementById('dldgr').value;
	   $('#dldgr_div').load('dldgr_ledgr_jrnl.php?xx='+xx+'&dldgr='+dldgr).fadeIn('fast'); 
  }
  function show_div1(xx)
  {
	  var cldgr=document.getElementById('cldgr').value;
	   $('#cldgr_div').load('cldgr_ledgr_jrnl.php?xx='+xx+'&cldgr='+cldgr).fadeIn('fast'); 
  }
    function show_div_edt(xx)
  {
	  var dldgr=document.getElementById('dldgr').value;
	   $('#dldgr_div_edt').load('dldgr_ledgr_jrnl.php?xx='+xx+'&dldgr='+dldgr).fadeIn('fast'); 
  }
  function show_div1_edt(xx)
  {
	  var cldgr=document.getElementById('cldgr').value;
	   $('#cldgr_div_edt').load('cldgr_ledgr_jrnl.php?xx='+xx+'&cldgr='+cldgr).fadeIn('fast'); 
  }
</script>
</div>
</html>