<?php
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$brncd=$_REQUEST['brncd'];
$cid=$_REQUEST['cid'];
$bill_typ=$_REQUEST['bsl'];
$dldgr=$_REQUEST['dldgr'];
$dt=$_REQUEST['dt'];
$pcat=$_REQUEST['pcat'];

$get=mysqli_query($conn,"select * from main_billtype where sl='$bill_typ'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$brncds=$row['brncd'];
$typ=$row['inv_typ'];
$tp=$row['tp'];
$brand=$row['brand'];
}
set_time_limit(0);
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
function isNumber1(evt) 
{
var iKeyCode = (evt.which) ? evt.which : evt.keyCode
if(iKeyCode < 45 || iKeyCode > 57)
{
return false;
}
return true;
}


$(document).ready(function()
{
	
   var jQueryDatePicker1Opts =
   {
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show',
	  minDate: '<?php echo $rng_dt;?>'
   };
   $(".dt").datepicker(jQueryDatePicker1Opts);
   $("#fdt").datepicker(jQueryDatePicker1Opts);
   $("#tdt").datepicker(jQueryDatePicker1Opts);
});
function gtcrvl1()
	{		
	var brncd= document.getElementById('brncd').value;
	var	proj = document.getElementById('proj').value;
	var	sl = document.getElementById('cldgr').value;
	var	cid = document.getElementById('cid').value;
	var	blno=encodeURIComponent(document.getElementById('blno').value);
	var	ramm=document.getElementById('ramm').value;
	if(cid=="")	return;
	if(blno=="")return;
	console.log("gtcrvl1 load 222222222222222");
		//$('#drbl').load('jrnl_form_gtdrvl_blno.php?sl='+sl+'&cid='+cid+'&brncd='+brncd+'&blno='+blno).fadeIn('fast');
		//$('#crbl').load('sale_ser_totalbal.php?pno='+proj).fadeIn('fast');
		//$('#totbal').load('recv_totalbal.php?pno='+proj+'&brncd='+brncd+'&cid='+cid).fadeIn('fast');

		$('#drbl').load('jrnl_form_gtdrvl_blno_oth_cust_credit.php?sl='+sl+'&cid='+cid+'&brncd='+brncd+'&blno='+blno+'&ramm='+ramm).fadeIn('fast');
		
			}
			
			function gtcrvlfi()
	{	
		proj = document.getElementById('proj').value;
		sl = document.getElementById('dldgr').value;
		var brncd= document.getElementById('brncd').value;
		if(sl=="")	return;
		$('#crbl').load('jrnl_form_gtdrvl.php?sl='+sl+'&pno='+proj+'&brncd='+brncd).fadeIn('fast');
		
	}
	
function sh()
	{
	var proj = document.getElementById('proj').value;
	var brncd= document.getElementById('bcd').value;
	var custid= document.getElementById('custid').value;
	var fdt= document.getElementById('fdt').value;
	var tdt= document.getElementById('tdt').value;
	var slp= encodeURIComponent(document.getElementById('slp').value);
	$('#show').load('cust_credit_note_list.php?pno1='+proj+'&brncd='+brncd+'&custid='+custid+'&fdt='+fdt+'&tdt='+tdt+'&slp='+slp).fadeIn('fast');
	}
			
	function pagnt(pnog)
	{
	var proj = document.getElementById('proj').value;
	var ps=document.getElementById('ps').value;
    var brncd= document.getElementById('bcd').value;
	var custid= document.getElementById('custid').value;
	var fdt= document.getElementById('fdt').value;
	var tdt= document.getElementById('tdt').value;
		var slp= encodeURIComponent(document.getElementById('slp').value);

    $('#show').load("cust_credit_note_list.php?ps="+ps+"&pnog="+pnog+"&pno1="+proj+'&brncd='+brncd+'&custid='+custid+'&fdt='+fdt+'&tdt='+tdt+'&slp='+slp).fadeIn('fast');
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

 function sfdtlrecv(sl)
{
//$('#cnt').load('recv_det_new.php?sl='+sl).fadeIn("fast");
window.open('cust_credit_note_det.php?sl='+sl, '_blank');
}

function cancell(ssl)
{
		if(confirm("Are You Sure??"))
		{
		$('#show').load("cancel_clctn_rprt.php?sl="+ssl).fadeIn('fast');
		}
}

async function get_blno()
{
var brncd= document.getElementById('brncd').value;
var proj = document.getElementById('proj').value;
var sl = document.getElementById('cldgr').value;
var cid = document.getElementById('cid').value;
var tp = document.getElementById('tp').value;
if(cid=="")return;
$('#blno_div').load('get_blno.php?sl='+sl+'&cid='+cid+'&brncd='+brncd+'&tp='+tp).fadeIn('fast');	

}

function submit1()
{
var blno=document.getElementById("blno").value;
if(blno=='')
{
alert('Please Select Invoice No....')
return false;	
}
else
{
document.forms["Form1"].submit();
} 
}

function add()
{
var cid=document.getElementById("cid").value;
var blno=document.getElementById("blno").value;
var amm=document.getElementById("amm").value;
var nrtn=encodeURIComponent(document.getElementById("nrtn").value);
var ramm=document.getElementById('ramm').value;

$('#tmpadd').load('tempadd.php?cid='+cid+'&blno='+blno+'&amm='+amm+'&nrtn='+nrtn+'&ramm='+ramm).fadeIn('fast');	
document.getElementById("amm").value="";
//document.getElementById("nrtn").value="";	
}

async function ctmppr()
{
var cid=document.getElementById('cid').value;	
var tamm=document.getElementById('tamm').value;	
$('#tmpadd').load("ctmppr.php?cid="+cid+"&tamm="+tamm,
function() {
	gtcrvl1();
}
).fadeIn('fast');	
return 0;
}
function dlt(sl)
{
$('#tmpadd').load("ctmppr_dlt.php?sl="+sl).fadeIn('fast');	
}




function check()
{
var ramm=document.getElementById('ramm').value;
var tamm=document.getElementById('tamm').value;
var dldgr=document.getElementById('dldgr').value;
if(tamm<1)
{
alert("Received Amount  Can't be blank");	
return false;	
}
else if(ramm!=0)
{
alert("Rest Amount  Can't be Same Rest Payment Amount...");	
return false;	
}
else
{
if (confirm("Are You Sure ?")) 
{	
document.forms["Form1"].submit();
}	
}
 
}
function get_cust(div,cs,id,fn,searchid,query='',efn='')
{
	var cat=document.getElementById('cat').value;
	var typ=document.getElementById('tp').value;
	if(typ==2 && cat=="")
	{
		alert("Please select Brand !!")
		return;
	}
	if(typ==2){
	query+=" and brand='"+cat+"'";
	}
	get_cust_by_cs(div,cs,id,fn,searchid,query,efn);
}
function get_total_due()
	{		
	var brncd= document.getElementById('brncd').value;
	var	proj = document.getElementById('proj').value;
	var	cid = document.getElementById('cid').value;

	if(cid=="")	return;
	$.get('cname_cust_credit.php?cid='+cid, function(data) {

	$('#sman').val(data);
	$('#sman').trigger('chosen:updated');

	});
	//$('#totbal').load('recv_totalbal.php?pno='+proj+'&brncd='+brncd+'&cid='+cid).fadeIn('fast');

	get_blno().then(
  function(value) {
	$('#totbal').load('recv_totalbal.php?pno='+proj+'&brncd='+brncd+'&cid='+cid,
	function() {
		recallRamm();
}).fadeIn('fast');
	
}
);
}
function recallRamm()
{
	ctmppr().then(
  function(value) {}
);
	//await temp();
}


</script>
 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>


<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
</head>

<body onload="ctmppr();">
<aside class="right-side">
<section class="content-header">
                    <h1 align="center">
                 Credit Note 
               
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Credit Note </li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="cust_credit_notes.php" id="Form1" >
<input type="hidden" name="flnm" id="flnm" value="cust_credit_note.php" >
<input type="hidden" name="proj" id="proj" value="NA" readonly>
<input type="hidden" name="it" id="it" value="NA" readonly >

<input type="hidden" name="flnm1" id="flnm1" value="1" >
<input type="hidden" name="btyp" id="btyp" value="<? echo $typ; ?>" >
<input type="hidden" name="tp" id="tp" value="<? echo $tp; ?>" >
<input type="hidden" class="form-control"  value="<?php echo $bill_typ;?>" tabindex="1"  name="bsl" id="bsl" >              

 <div class="box box-success" >
<table  width="860px" class="table table-hover table-striped table-bordered">

<tbody>
<tr class="">
<td align="left" width="50%">
<font color="red">*</font><b>Branch :</b>
<select name="brncd" class="form-control" size="1" id="brncd"  onchange="get_blno();" >
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
<td align="left" width="50%" >
<font color="red">*</font><b>Date :</b>
<?php if($user_current_level<0){?>
<input type="text" name="dt" id="dt" class="form-control dt" value="<?php if($dt==""){echo date('d-m-Y');}else{echo $dt;}?>" >
	<?php }else{ ?>

	<input type="text" name="dt" id="dt" class="form-control" readonly value="<?php if($dt==""){echo date('d-m-Y');}else{echo $dt;}?>" >
	<?php } ?>

</td>   
  </tr>
      <input type="hidden" name="vno" class="form-control" id="vno" value="<?echo $vno;?>" readonly style="background :transparent; color : red;">

<?php
//if($tp=='2'){$qury=" and find_in_set(brand,'$brand')>0 ";}
$query=" and typ='$tp' ";
?> 
<tr class="">
<td align="left" >
	<table>
		<tr>
			<td width="40%">
				<font color="red">*</font><b>Brand :</b>
				<select name="cat" class="form-control" size="1" id="cat" tabindex="1">
				<Option value="">---Select---</option>
				<?
				$data1 = mysqli_query($conn,"Select * from main_catg where stat='0' and find_in_set(sl,'$brand')>0 order by cnm");
				while ($row1 = mysqli_fetch_array($data1))
				{
				$sl=$row1['sl'];
				$cnm=$row1['cnm'];
				?>				
				<option value="<?php echo $sl;?>" <?if($sl==$pcat){?> selected <? } ?>><?php echo $cnm;?></option>
				<?php
				}
				?>
				</select>
			</td>
			<td width="60%">
				<font color="red">*</font><b>Customer :</b>
				<input type="hidden" value="4" id="cldgr" name="cldgr"/> 
				<input type="text" id="cs" name="cs" size="40" value="" onkeyup="get_cust('cust_src',this.value,'cid','get_total_due','cs',`<?php echo $query;?>`,'')"  placeholder="Enter 3 Digit Name / 10 Digit Mobile No.">
				<div id="cust_src">
				<select id="cid"  name="cid"   tabindex="2" class="form-control"  onchange="get_total_due();">
				<option value="">---Select---</option>

				<?php
				/*
				if($tp=='2'){$qury=" and find_in_set(brand,'$brand')>0 ";}
				$query="select * from main_cust  WHERE sl>0 and typ='$tp' $qury order by nm";
				$result = mysqli_query($conn,$query);
				while ($R = mysqli_fetch_array ($result))
				{
				$sid=$R['sl'];
				$spn=$R['nm'];
				$cont=$R['cont'];
				$addr=$R['addr'];
				?>
				<option value="<? echo $sid;?>" <?if($cid==$sid){?> selected <? } ?> ><? echo $spn;?></option>
				<?
				}*/
				?>
				</select>
			</td>
			</tr>
			</table>
</div>

</td>
    <td align="left" >
	<font color="red">*</font><b>Ledger Name :</b>
      <select  name="dldgr" id="dldgr" class="form-control" >
							<option value="">-- Select --</option>
							<?php 
							$get = mysqli_query($conn,"SELECT * FROM main_ledg where (gcd='17' or sl='140' or sl='217')") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?=$row['sl']?>" <?if($row['sl']==$dldgr){?> selected <? } ?>><?=$row['nm']?></option>
							<?php 
							} 
							?>
						</select>
	</td>   
  </tr>
<tr>

<td>
<b>Total Received Amount :</font></b>
<input  type="text" name="tamm" id="tamm" class="form-control" onblur="recallRamm()" onkeypress="return isNumber1(event)">
</td> 

<td>
<font color="red" size="3"><b>Rest Amount :</font></b>
<input  type="text" name="ramm" readonly id="ramm" class="form-control" onkeypress="return isNumber1(event)">
</td>

</tr>
  
<tr class="">
	<td>
	<b>Total :</b>
	<div id="totbal">
	<input type="text" name="dbal" id="dbal"  value="0.00" style="background :transparent; color : red;width:120px;" readonly>
	</div>
	</td>  
    <td align="left" >
	<b> Balance :</b>
	<div id="crbl">
	 <input type="text" name="cbal" id="cbal"  value="0.00" style="background :transparent; color : red;" readonly>
	</div>
	</td>	
  </tr>
  
  <tr class="" style="display:none">
    <td align="right" ><font color="red">*</font><b>Payment Mode :</b></td>
    <td align="left" >
	 <select  name="paymtd" id="paymtd" class="form-control">
							<option value="">-- Select --</option>
							<?php 
							$get = mysqli_query($conn,"SELECT * FROM ac_paymtd") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?=$row['sl']?>" <?=$row['sl'] == '1' ? 'selected' : '' ?>><?=$row['mtd']?></option>
							<?php 
							} 
							?>
						</select>
	</td>
	<td align="right" ><b>Ref. No. :</b></td>
    <td align="left" >
       <input type="text" name="refno" class="form-control" id="refno" >
	</td>   
  </tr>

  
  <tr class="">
    <td align="left"  >
	<font color="red">*</font><b>Sales Person :</b>
	<select id="sman" name="sman" tabindex="1"  class="form-control">
	<option value="">---Select---</option>
	<?
		$queryss="select * from main_sale_per  WHERE sl>0 order by spid";
		$resultss=mysqli_query($conn,$queryss);
		while($rwss=mysqli_fetch_array($resultss))
		{
			$spid=$rwss['spid'];
			$spnm=$rwss['nm'];
		?>
			<option value="<?=$spid;?>"><?=$spid;?></option>
			<?
		}
	?>
	</select>
	</td>
<td align="left"  >
<font color="red" size="3"><b>SMS :</font></b>
<select id="sms" name="sms" tabindex="1" class="form-control" >
<option value="1">No</option>
<option value="2">Yes</option>


</select>
</td>

</tr>
  
  
  

<tr class="odd">
<td colspan="4" align="right">


<table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td align="left" width="35%" ><b>Bill No.</b></td>
<td align="center" width="15%" ><b>Due</b></td>
<td align="left" width="15%" ><b>Amount</b></td>
<td align="left" width="25%" ><b>Narration</b></td>
<td align="center" width="5%"><b>Action</b></td>
</tr>

<tr class="odd">
<td>
<div id="blno_div" width="30%">
<select id="blno"  name="blno"   tabindex="2" class="form-control"  onchange="gtcrvl1()">
<option value="">---Select---</option>
</select>
</div>
</td>
<td align="center">

	<div id="drbl">
	<img src="images\rp.png" height="15px"><input type="text" name="dbal" id="dbal"  value="0.00" style="background :transparent; color : red;width:120px;" readonly>
	</div>
</td>
<td ><input  type="text" name="amm" id="amm" class="sc" ></td>
<td ><input type="text" name="nrtn" id="nrtn" class="sc"></td>
<td align="center" width="3%">
<input type="button" class="btn btn-primary btn-xs" value="Add"  onclick="add()" style="width:100%" >
</td>
</tr>
</table>
</td>
</tr>

 
  
<tr class="odd">
<td colspan="4" align="left" valign="top" height="250px;">
<div id="tmpadd"></div>
</td>
</tr>
 
  
<tr class="odd">
<td colspan="4" align="right">
<input type="button" value="Submit" class="btn bt btn-success" onclick="return check()">
</td>
</tr>

</table>
</div>




<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="left" width="20%">
<font size="3"><b>Branch :</b></font><br>
<select name="bcd" class="form-control" size="1" id="bcd" >
<?
if($user_current_level<0)
{
$query1="Select * from main_branch where sl='$brncds'";
}
else
{
$query1="Select * from main_branch where sl='$brncds'";
}
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$slb1=$R1['sl'];
$bnm1=$R1['bnm'];
?>
<option value="<? echo $slb1;?>"><? echo $bnm1;?></option>
<?
}
?>
</select>
</td>


<td align="left" width="25%">
<font size="3"><b>Customer :</b></font>
<input type="text" id="cs1" name="cs1" size="40" value="" onkeyup="get_cust_by_cs('cust_src_search',this.value,'custid','','cs1',`<?php echo $query;?>`)"  placeholder="Enter 3 Digit Name / 10 Digit Mobile No.">
<div id="cust_src_search">
<select id="custid" name="custid" tabindex="1"  class="form-control" >
	<option value="">---ALL---</option>
	<?
if($tp=='2'){$qury=" and find_in_set(brand,'$brand')>0 ";}
/*
$query2="select * from main_cust  WHERE sl>0 and typ='$tp' $qury order by nm";

$result2=mysqli_query($conn,$query2);
while($rw2=mysqli_fetch_array($result2))
{
?>
<option value="<?=$rw2['sl'];?>"><?=$rw2['nm'];?> --  <?=$rw2['cont'];?></option>
<?
}*/
	?>
</select>
</div>
</td>
<td align="left" width="15%">
<font size="3"><b>From Date : </b></font>
<input type="text" id="fdt" name="fdt" value="<?//=date('01-M-Y');?>" readonly class="form-control" >
</td>
<td align="left" width="15%">
<font size="3"><b>To Date : </b></font>
<input type="text" id="tdt" name="tdt" value="<?//=date('d-M-Y');?>" readonly class="form-control" >
</td>
<td align="left" width="25%">
<font size="3"><b>Sales Person : </b></font>
	<select id="slp" name="slp" tabindex="1"  class="form-control">
	<option value="">---ALL---</option>
	<?
		$queryss="select * from main_sale_per  WHERE sl>0 order by spid";
		$resultss=mysqli_query($conn,$queryss);
		while($rwss=mysqli_fetch_array($resultss))
		{
			$spid=$rwss['spid'];
			$spnm=$rwss['nm'];
		?>
			<option value="<?=$spid;?>"><?=$spid;?></option>
			<?
		}
	?>
	</select>
</td>
<td align="left" width="10%"><br>
<input type="button" value=" Show " class="btn btn-primary" onclick="sh()">
</td>
</tr>
</tbody>
</table>
</div>



<div class="box box-success" >
<div id="show">

</div>
</div>


											         <!-- COMPOSE MESSAGE MODAL -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
           <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-bars"></i>Member List </h4>
                    </div>
                 
<div class="modal-body">
<div class="row">
<div class="col-md-12">
<div id="list">
</div>
</div>
</div>
</div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
<!-- Modal Box Start-->
<div class="modal" id="myModal">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h4>Received Register Update</h4>
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
  $('#cid').chosen({no_results_text: "Oops, nothing found!",});
  $('#custid').chosen({no_results_text: "Oops, nothing found!",});
  $('#slp').chosen({no_results_text: "Oops, nothing found!",});
  $('#sman').chosen({no_results_text: "Oops, nothing found!",});
  $('#cat').chosen({no_results_text: "Oops, nothing found!",});
   $('#blno').chosen({
  no_results_text: "Oops, nothing found!",
  
  });
<?
if($cid!="")
{
?>
get_blno();
<?	
}
?>

</script>

</div>
</html>