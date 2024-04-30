<?php
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";
$brncd=$_REQUEST['brncd1'];
$cid=$_REQUEST['cid'];
$sa=date('d-m-Y');
$saa="01-".date('m-y');
$bill_typ=$_REQUEST['bsl'];
$get=mysqli_query($conn,"select * from main_billtype where sl='$bill_typ'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$brncds=$row['brncd'];
$typ=$row['inv_typ'];
$brand=$row['brand'];
$tp=$row['tp'];
$als=$row['als'];
}
$dt=$_REQUEST['dt'];
$blno=$_REQUEST['blno'];
if($blno!='')
{
$data1=mysqli_query($conn,"SELECT * FROM main_recv_app where sl>0 and blno='$blno'")or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($data1))
{
$cid=$row1['cid'];
}
}
if($dt=='')
{
$dt=date('d-m-Y');
}
$dt=date('d-m-Y',strtotime($dt));
$pdldgr=3;
$ppaymtd=1;

$datao=mysqli_query($conn,"SELECT * FROM main_recv where  als='$als' and eby='$user_currently_loged' order by sl desc limit 0,1")or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($datao))
{
$pdldgr=$row1['dldgr'];
$ppaymtd=$row1['paymtd'];
}
$discountReadOnly="";
if($tp==1 && strtoupper($user_currently_loged)!='ADMIN' && strtoupper($user_currently_loged)!='RIYA')
{
 $discountReadOnly="readonly";   
}
?>

<html>
<head>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
include "left_bar.php";
?>
<style type="text/css"> 
th{
text-align:center;
color:red;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
</style> 
<script>
function get_blno()
{
var brncd= document.getElementById('brncd').value;
var proj = document.getElementById('proj').value;
var sl = document.getElementById('cldgr').value;
var dldgr = document.getElementById('dldgr').value;
var cid = document.getElementById('cid').value;
var spid = document.getElementById('spid').value;
var nb = document.getElementById('nb').value;
$('#blno_div').load('get_blno_oth.php?sl='+sl+'&cid='+cid+'&brncd='+brncd+'&dldgr='+dldgr+'&nb='+nb).fadeIn('fast');
$.get('cname.php?cid='+cid, function(data) {
        
                var str= data;
				var stra = str.split("@@") 
                var typ = stra.shift() 
				var fstr1 = stra.shift()
				var addr = stra.shift()  
                var mob = stra.shift() 
                var mail = stra.shift()
                var pp = stra.shift()
                var bal = stra.shift()
                var aa = stra.shift()
                var fst = stra.shift()
                var sale_per = stra.shift()
  
    $('#spid').val(sale_per);
    $('#sman').val(sale_per);
	$('#spid').trigger('chosen:updated');

}); 

}
</script>
   <link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
</style>
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
   $(document).ready(function()
{
	gtcrvlfi();
   var jQueryDatePicker2Opts =
   {
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };	

$(".dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#tdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

$(".dt").datepicker(jQueryDatePicker2Opts);
$("#tdt").datepicker(jQueryDatePicker2Opts);
});

function isNumber1(evt) 
{
var iKeyCode = (evt.which) ? evt.which : evt.keyCode
if(iKeyCode < 45 || iKeyCode > 57)
{
return false;
}
return true;
}
function gtcrvl1()
{
var brncd=document.getElementById('brncd').value;
var	proj=document.getElementById('proj').value;
var	sl=document.getElementById('cldgr').value;
var	cid=document.getElementById('cid').value;
var	blno=encodeURIComponent(document.getElementById('blno').value);
var	ramm=document.getElementById('ramm').value;
var dt=document.getElementById('dt').value;	
$('#drbl').load('jrnl_form_gtdrvl_blno_oth.php?sl='+sl+'&cid='+cid+'&brncd='+brncd+'&blno='+blno+'&ramm='+ramm+'&dt='+dt).fadeIn('fast');
$('#totbal').load('recv_totalbal_oth.php?pno='+proj+'&brncd='+brncd+'&cid='+cid+'&tt=1').fadeIn('fast');
$('#totbal1').load('recv_totalbal_oth.php?pno='+proj+'&brncd='+brncd+'&cid='+cid+'&tt=2').fadeIn('fast');

}

function gtcrvlfi()
{	
proj = document.getElementById('proj').value;
sl = document.getElementById('dldgr').value;
var brncd= document.getElementById('brncd').value;
var	cid=document.getElementById('cid').value;
$('#crbl').load('jrnl_form_gtdrvl_oth.php?sl='+sl+'&pno='+proj+'&brncd='+brncd+'&cid='+cid).fadeIn('fast');
}
function add()
{
	var cid=encodeURIComponent(document.getElementById('cid').value);
	var brncd=encodeURIComponent(document.getElementById('brncd').value);
	var blno=encodeURIComponent(document.getElementById('blno').value);
	var amm=encodeURIComponent(document.getElementById('amm').value);
	var sman=encodeURIComponent(document.getElementById('sman').value);
	var disl=encodeURIComponent(document.getElementById('disl').value);
	var damm=encodeURIComponent(document.getElementById('damm').value);
	var dldgr=encodeURIComponent(document.getElementById('dldgr').value);
	var ramm=encodeURIComponent(document.getElementById('ramm').value);
	var remk=encodeURIComponent(document.getElementById('remk').value);
	var blno_ref=encodeURIComponent(document.getElementById('blno_ref').value);
	
	
		if(cid=='')
		{
		alert("Customer Can't be blank");
		$('#cid').trigger('chosen:open');
		}
		else if(blno=='')
		{
		alert("Bill No. Can't be blank");
		}
		else if(amm=='' || amm=='0')
		{
		alert("Amount Can't be blank");
		}
		else if(blno=='ADVANCE-PAYMENT' && dldgr=='7')
		{
		alert(" This Ledger Can't be Received Advance Amount");
		}
		else
		{
			$('#wb_Text').load('recv_reg_temp.php?blno='+blno+'&amm='+amm+'&sman='+sman+'&cid='+cid+'&brncd='+brncd+'&disl='+disl+'&damm='+damm+'&ramm='+ramm+'&remk='+remk+'&blno_ref='+blno_ref).fadeIn('fast');
		}
	
}
function reset()
{
$('#blno').trigger('chosen:open');
document.getElementById('amm').value='';
//document.getElementById('disl').value='';
//$('#disl').trigger('chosen:update');
document.getElementById('damm').value='';
//document.getElementById('remk').value='';

}
</script> 
<script>
function temp()
{
    
   // alert("ooops");
var cid=document.getElementById('cid').value;	
var brncd=document.getElementById('brncd').value;	
var tamm=document.getElementById('tamm').value;	
$('#wb_Text').load("recv_reg_tempsh.php?cid="+cid+"&brncd="+brncd+"&tamm="+tamm).fadeIn('fast');	
}

</script>
<script>
function get_refam()
{
	var blno=document.getElementById('blno').value;	
	var cid=document.getElementById('cid').value;	
	var dt=document.getElementById('dt').value;	
	var brncd=document.getElementById('brncd').value;	
	if((blno!='' || cid!='' || dt!='') && brncd=='1')
	{
		if(blno!='ADVANCE-PAYMENT')
		{
			$('#wb_Text_cal').load("recbper.php?cid="+cid+'&blno='+blno+'&dt='+dt).fadeIn('fast');
		}
	}	
}

function deltpr(sl)
{
$('#wb_Text').load("deltpr_recv_reg.php?sl="+sl).fadeIn('fast');
}


function getpay()
{
var dldgr=document.getElementById('dldgr').value;
if(dldgr==3)
{
    $('#paymtd').val('1');
	$('#paymtd').trigger('chosen:updated');
}
else if(dldgr==5 || dldgr==7 || dldgr==-1)
{
	  $('#paymtd').val('');
	$('#paymtd').trigger('chosen:updated');	
}
else
{
    $('#paymtd').val('3');
	$('#paymtd').trigger('chosen:updated');	
}
}
function check()
{
var ramm=document.getElementById('ramm').value;
var tamm=document.getElementById('tamm').value;
var dldgr=document.getElementById('dldgr').value;
if(tamm<1)
{
alert("Received Amount  Can't be blank");		
}
else if(ramm!=0 && dldgr!=7)
{
alert("Rest Amount  Can't be Same Rest Payment Amount...");	
}
else
{
if (confirm("Are You Sure ?")) 
{	
document.forms["form1"].submit();
}	
}
 
}
function get_app()
{
var cid=document.getElementById('cid').value;	
var brncd=document.getElementById('brncd').value;	

$.get('recv_app_count.php?cid='+cid+'&brncd='+brncd, function(data) {
        
if(data>0)
{
$('#cnt11').load("recv_app.php?cid="+cid+"&brncd="+brncd).fadeIn('fast');	
$('#compose-modal1').modal('show');	
}
else
{
$('#compose-modal1').modal('hide');		
}
}); 

}
function get_app_val(blno)
{
$('#wb_Text').load("recv_add_app.php?blno="+blno).fadeIn('fast');		
}

function set_dis()
{
	var cid=document.getElementById('cid').value;	
	if(cid=='')
	{
		alert("Samir da Customer ta select koro age !");
	}
	else
	{
	window.open("discount_setup.php?custid="+cid,'_blank');
	}
}
function recaldis()
{
	var dbal=parseFloat(document.getElementById('cal_dbal').value);	
	var amm=parseFloat(document.getElementById('amm').value);
	if(amm>0){
	document.getElementById('damm').value=(dbal-amm).round(2);	
	}
	console.log(dbal,amm);
}
Number.prototype.round = function(places) {
  return +(Math.round(this + "e+" + places)  + "e-" + places);
}
</script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>


	</head>
 <body onload="">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
             Received Register
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Received Register</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">			
<form method="post" action="recv_reg_oths.php" name="form1"  id="form1">
<input type="hidden" name="proj" id="proj" value="NA" readonly>
<input type="hidden" name="it" id="it" value="NA" readonly >
<input type="hidden" name="btyp" id="btyp" value="<? echo $typ; ?>" >
<input type="hidden" class="form-control"  value="<?php echo $bill_typ;?>" tabindex="1"  name="bsl" id="bsl" >              

<input type="hidden" name="blno_ref" id="blno_ref" value="<?=$blno;?>" >
<div id="wb_Text_cal"></div>
<div class="box box-success" >
<table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<tr>
<td align="right" width="15%"><font color="red">*</font><b>Branch :</b></td>
<td align="left" width="35%">
<select name="brncd" class="form-control" size="1" id="brncd"  onchange="get_blno();gtcrvlfi()" >
<?
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
<td align="right" width="15%" ><font color="red">*</font><b>Date :</b></td>
<td align="left" width="35%" >
    

	<?php if($user_current_level<0){?>
<input type="text" name="dt" id="dt" class="form-control dt" value="<? echo $dt; ?>" onchange="get_refam()">
	<?php }else{ ?>

	<input type="text" name="dt" id="dt" class="form-control" readonly value="<? echo $dt; ?>" >
	<?php } ?>
</td>   
</tr>

<tr>
<td align="right" ><font color="red">*</font><b>Customer :</b></td>
<td align="left" >
<table width="100%">
<tr>
<td>
<input type="hidden" value="4" id="cldgr" name="cldgr"/> 
<input type="text" id="cs" name="cs" style="width:95%" value="" onkeyup="cust_srch('<?php echo $tp;?>','<?php echo $brand;?>')"  placeholder="Enter 3 Digit Name / 10 Digit Mobile No.">
<div id="cust_src">
<select id="cid"  name="cid"   tabindex="1" class="form-control"  onchange="get_blno();get_app();">
<option value="">---Select---</option>
<?
/*if($tp=='2'){$qury=" and find_in_set(brand,'$brand')>0 ";}
$query="select * from main_cust  WHERE sl=0 and typ='$tp' $qury order by nm";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sid=$R['sl'];
$spn=$R['nm'];
$cont=$R['cont'];
$addr=$R['addr'];
?>
<option value="<? echo $sid;?>" <?if($cid==$sid){?> selected <? } ?> ><? echo $spn;?>  - <? echo $cont;?></option>
<?
}*/
?>
</select>
</div>
</td>
<td>
<u><b><a href="javascript:get_app()">App Payment</a></b></u>
</td>
</tr>
</table>
</td>
<td align="right" ><font color="red">*</font><b>Narration :</b></td>
<td align="left"  >
<input type="text" name="nrtn" id="nrtn" class="form-control">
</td>
</tr>
<tr>
<td align="right"><font color="red" size="3"><b>Ledger :</font></b></td>
<td>
<select  name="dldgr" id="dldgr" class="sc"  onchange="get_blno();gtcrvlfi();getpay()">
<option value="">-- Select --</option>

<?php 
$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='1' or gcd='2' or sl='5' or sl='7' or sl='-1' or gcd='22'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?=$row['sl']?>" <?=$row['sl'] == $pdldgr ? 'selected' : '' ?>><?=$row['nm']?></option>
<?php 
} 
?>
</select>
</td> 
<td align="right"><font color="red" size="3"><b>Payment Mode:</font></b></td>
<td align="left" >
<select  name="paymtd" id="paymtd" class="sc">
<option value="">-- Select --</option>
<?php 
$get = mysqli_query($conn,"SELECT * FROM ac_paymtd") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?=$row['sl']?>" <?=$row['sl'] == $ppaymtd ? 'selected' : '' ?>><?=$row['mtd']?></option>
<?php 
} 
?>
</select>
</td>

</tr>
<tr>
<td align="right"><font color="red" size="3"><b>Total Received Amount :</font></b></td>
<td>
<input  type="text" name="tamm" id="tamm" class="form-control" onblur="temp()"  onkeypress="return isNumber1(event)">
</td> 
<td align="right"><font color="red" size="3"><b> Ref. No. :</font></b></td>
<td align="left" >
<input type="text" name="refno" class="form-control" id="refno" >
</td>
</tr>

<tr>
<td align="right"><font color="red" size="3"><b>Rest Amount :</font></b></td>
<td>
<input  type="text" name="ramm" readonly id="ramm" class="form-control" onkeypress="return isNumber1(event)">
</td>
<td align="right"><font color="red" size="3"><b>Total Due :</font></b></td>
<td align="left"  >
<div id="totbal1">
<input type="text" name="dbal" id="dbal"  value="0.00" style="background :transparent; color : red;font-size:20px;" readonly>
</div>
</td>
</tr>
<tr>
<td align="right"><font color="red" size="3"><b>Sales Person :</font></b></td>
<td>
<select id="spid" name="spid" tabindex="1" class="sc1"  style="width:100%;">
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
<td align="right"><font color="red" size="3"><b>SMS :</font></b></td>
<td align="left"  >
<select id="sms" name="sms" tabindex="1" class="form-control" >
<option value="2">Yes</option>
<option value="1">No</option>

</select>
</td>
</tr>
</table>
</div>

<div class="box box-success"><b>Received Details :</b>
<span hidden>
<div id="totbal" >
<input type="text" name="tdbal" id="tdbal"  value="0.00" style="background :transparent; color : red;" readonly>
</div>
</span>
<span align="left" hidden>
<div id="crbl">
<input type="text" name="cbal" id="cbal"  value="0.00" style="background :transparent; color : red;" readonly>
</div>
</span>
<?
if($tp==2){$nb=100000;}else{$nb=1000000;}
?>
<table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td align="left" width="3%"><b>Sl. </b></td>
<td align="left" width="20%"><b>Bill No.<input type="hidden" value="10" id="nb" onblur="get_blno()"></b></td>
<td align="left"  width="12%"><b>Due</b></td>

<td align="center" width="12%" ><b>Amount</b></td>
<td align="left"  width="20%"><b>Discount Ledger</b></td>
<td align="left"  width="12%" onclick="recaldis()" style="cursor:pointer;color:blue"><b>Discount Am.</b></td>
<td align="left" width="12%" ><b>Discount Remark</b></td>
<?php

if($brncds=='1')
{
?>
<td align="center" width="5%" onclick="set_dis()" style="cursor:pointer;color:blue"><b>Due Days</b></td>
<td align="center" width="5%" ><b>% Refundable</b></td>
<td align="center" width="5%" ><b>Aplicable Days</b></td>
<?php
}
?>
<td align="center" width="5%" ><b>Action</b></td>

</tr>
<tr>
<td>
<input type="text" name="sll" id="sll" class="sc" readonly>
</td>
<td>
<div id="blno_div">
<select id="blno"  name="blno" tabindex="1" class="sc1"  onchange="gtcrvl1();" style="width:98%;">
<option value="">---Select---</option>
</select>
</div>
</td>
<td>
<div id="drbl">
<input type="text" name="dbal" id="dbal" class="sc" value="0.00" style="background :transparent; color : red;" readonly>
</div>
</td>
<td align="left">
<input  type="text" name="amm" id="amm" class="sc" onkeypress="return isNumber1(event)">
</td>
<td>
<select  name="disl" id="disl" class="form-control" style="width:98%;">
<option value="">-- Select --</option>
<?php 
$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='17'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?=$row['sl']?>"><?=$row['nm']?></option>
<?php 
} 
?>
</select>
</td>
<td align="left">
<input  type="text" name="damm" id="damm" <?php echo $discountReadOnly;?> class="sc" onkeypress="return isNumber1(event)">
</td>
<td align="left">
<input  type="text" name="remk" id="remk" class="sc" >
<div style="display:none">
<select id="sman" name="sman" tabindex="1" class="sc1"  style="width:100%;">
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
</div>
</td>
<?php
if($brncds=='1')
{
?>
<td align="left">
	<input type="text" id="day" size="5" readonly>
</td>
<td align="left">
	<input type="text" id="rdis" size="5" value="0" readonly>
</td>
<td align="left">
	<input type="text" id="cdate" size="5" value="0" readonly>
</td>
<?php
}
?>
<td>
<input type="button" class="btn btn-info" id="Button1" name="" value="Add"  onclick="add()" tabindex="1" style="width:100%;padding:2px" >
</td>
</tr>
<tr height="180px">
<td colspan="12" valign="top">
<div id="wb_Text" >

</div>
</td>
</tr>

</table>
<table class="table table-hover table-striped table-bordered">
<tr>
<td align="right">
<input type="button" class="btn btn-success" id="ss" name="" value="Submit"  tabindex="1" onclick="check()">
</td>
</tr>
</table>
</div>

<div class="modal fade" id="compose-modal1"  tabindex="-1" role="dialog" aria-hidden="true"  >
	<div class="modal-dialog" style="width:70%" >
		<div class="modal-content">
			<div class="modal-body" id="cnt11">
			</div>
        </div>
    </div>
</div>

</form><!-- /.box-body -->
<div class="box-footer clearfix no-border"></div>
                       
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>
$('#pnm').chosen({no_results_text: "Oops, nothing found!",});
$('#snm').chosen({no_results_text: "Oops, nothing found!",});
$('#cat').chosen({no_results_text: "Oops, nothing found!",});
$('#bnm').chosen({no_results_text: "Oops, nothing found!",});
$('#prnm').chosen({no_results_text: "Oops, nothing found!",});
  
function getv()
{
var cat= document.getElementById('cat').value;
var bnm= document.getElementById('bnm').value;
$('#vv').load('get_v.php?cat='+cat+'&bnm='+bnm).fadeIn('fast');
}
</script>
<script type="text/javascript">
  $('#dldgr').chosen({no_results_text: "Oops, nothing found!",});
  $('#paymtd').chosen({no_results_text: "Oops, nothing found!",});
  $('#cid').chosen({no_results_text: "Oops, nothing found!",});
  $('#custid').chosen({no_results_text: "Oops, nothing found!",});

  $('#disl').chosen({no_results_text: "Oops, nothing found!",});
  $('#spid').chosen({no_results_text: "Oops, nothing found!",});
   $('#blno').chosen({
  no_results_text: "Oops, nothing found!",
  
  });
<?
if($cid!="")
{
?>
//get_blno();
<?	
}
?>
<?
if($blno!='')
{
?>
get_app_val('<?=$blno;?>');
<?
}

?>
//temp();
function cust_srch(tp,brand)
{
var cs=encodeURIComponent(document.getElementById('cs').value);
if((!isNaN(cs) && cs.length>9) || (isNaN(cs) && cs.length>2)){
$("#cust_src").load("get_cust_src_recv.php?cs="+cs+"&tp="+tp+"&brand="+brand).fadeIn('fast');	
}
}
</script>
</body>
</html>