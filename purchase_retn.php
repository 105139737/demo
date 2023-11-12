<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$blno=$_REQUEST['blno'];

$data1= mysqli_query($conn,"select * from main_purchase where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$brncd=$row1['bcd'];
$dt=date('d-m-Y',strtotime($row1['dt']));
$sid=$row1['sid'];
$inv=$row1['inv'];
$nrtn=$row1['nrtn'];

$fst=$row1['fst'];
$tst=$row1['tst'];
$tmod=$row1['tmod'];
$cbnm=$row1['cbnm'];
$paid=$row1['paid'];
$crdtp=$row1['crdtp'];
$remk=$row1['remk'];
$adl=$row1['adl'];
$adlv=$row1['adlv'];
$roff=$row1['roff'];
$addrsl=$row1['addr'];
$datad= mysqli_query($conn,"select * from main_suppl where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$mob1=$rowd['mob1'];
$mail=$rowd['email'];
}
$datad1= mysqli_query($conn,"select * from main_suppl_gst where sl='$addrsl'")or die(mysqli_error($conn));
while ($rowd1 = mysqli_fetch_array($datad1))
{
$addr=$rowd1['addr'];
$gstin=$rowd1['gstin'];
}

}
?>
<html>
<head>
	

<script type="text/javascript" src="atosg_2.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<link rel="stylesheet" href="atosg_2.css" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" src="popup_sedtunt.js"></script>

<style type="text/css"> 
th{
text-align:center;
color:#FFF;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
select.sc {
	width: 340px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 7px;
}
select.sc1 {
	width: 150px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 7px;
}

select.lig {
	width: 280px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 7px;
}
select.lig1 {
	width: 150px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 7px;
}
#sfdtl
{
	border : none;
	border-radius: 3px;
	background-image: url(images/bg1.png);
	width : 195px;
	
	display : none;
	color: #fff;
	position : absolute;
	left : 6%;
	top : 46%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	z-index:1000;
}
</style> 

<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

   
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
<script>

function get_state()
{
addr=document.getElementById('addr').value;
$.get('get_state.php?addr='+addr, function(data) {   

if(data!='')
{
$('#fst').val(data);

$('#fst').trigger('chosen:updated');	
}
else
{
$('#fst').val('1');

$('#fst').trigger('chosen:updated');		
} 
}); 	
}
</script>
<script type="text/javascript">
</script>
<link rel="stylesheet" type="text/css" href="style_sedt.css" />
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />

<script>
function t()
{
	var blno=document.getElementById('blno').value;
	$('#pay').load('total_gst_retn.php?blno='+blno).fadeIn('fast');
	$('#subt').load('subt1_gst.php').fadeIn('fast');
	$('#gst_am').load('gst_am_p.php').fadeIn('fast');
	$('#dis_am').load('dis_am.php').fadeIn('fast');
var tdis=document.getElementById('disa').value;
}
  
	
function cal()
{  
var qnty=parseFloat(document.getElementById('qnty').value);if(document.getElementById('qnty').value==''){qnty=0;}
var prc=parseFloat(document.getElementById('mrp').value);if(document.getElementById('mrp').value==''){prc=0;}
var total=parseFloat(document.getElementById('total').value);if(document.getElementById('total').value==''){total=0;}
var disp=parseFloat(document.getElementById('disp').value);if(document.getElementById('disp').value==''){disp=0;}
var disa=parseFloat(document.getElementById('disa').value);if(document.getElementById('disa').value==''){disa=0;}
var ldis=parseFloat(document.getElementById('ldis').value);if(document.getElementById('ldis').value==''){ldis=0;}
var ldisa=parseFloat(document.getElementById('ldisa').value);if(document.getElementById('ldisa').value==''){ldisa=0;}
var lttl=parseFloat(document.getElementById('lttl').value);if(document.getElementById('lttl').value==''){lttl=0;}
var cgst_rt=parseFloat(document.getElementById('cgst_rt').value);if(document.getElementById('cgst_rt').value==''){cgst_rt=0;}
var sgst_rt=parseFloat(document.getElementById('sgst_rt').value);if(document.getElementById('sgst_rt').value==''){sgst_rt=0;}
var igst_rt=parseFloat(document.getElementById('igst_rt').value);if(document.getElementById('igst_rt').value==''){igst_rt=0;}
var sgst=0;
var cgst=0;
var igst=0;
var total=0;
var disa1=0;
var ldisa1=0;
var rate1=0;
total=(qnty*prc).round(2);
if(disp>0)
{
disa1=((total*disp)/100).round(2);
}
if(ldis>0)
{
ldisa1=((total*ldis)/100).round(2);
}
lttl=total-(disa1+ldisa1);

	if(sgst_rt>0)
	{
	var sgst=((lttl*sgst_rt)/100).round(2);
	}
	if(cgst_rt>0)
	{
	var cgst=((lttl*cgst_rt)/100).round(2);
	}
	if(igst_rt>0)
	{
	var igst=((lttl*igst_rt)/100).round(2);
	}
	
	document.getElementById('sgst_am').value=sgst;
	document.getElementById('cgst_am').value=cgst;
	document.getElementById('igst_am').value=igst;
	net_amm=sgst+cgst+igst+lttl;
	document.getElementById('total').value=total;
	document.getElementById('disa').value=disa1;
	document.getElementById('ldisa').value=ldisa1;
	$('#lttl').val(lttl);
	if(net_amm>0)
	{
	rate1=(net_amm/qnty).round(2);
	}
	
	
	document.getElementById('net_amm').value=net_amm;
	document.getElementById('rate').value=rate1;
}

function cal_back()
{
var total=parseFloat(document.getElementById('total').value);if(document.getElementById('total').value==''){total=0;}
var lttl=parseFloat(document.getElementById('lttl').value);if(document.getElementById('lttl').value==''){lttl=0;}	

var disa=total-lttl;

var disp=((disa*100)/total).round(2);
document.getElementById('disa').value=disa;
document.getElementById('disp').value=disp;
cal();
}


	function tmppr1()
	{
	var blno=document.getElementById('blno').value;
	$('#wb_Text13').load("tmppr_retn.php?blno="+blno).fadeIn('fast');
	/*
	$('#fst_div').load("fst_get.php").fadeIn('fast');
	$('#tst_div').load("tst_get.php").fadeIn('fast');
	*/
	}
	
	function cal_main()
	{
	tdis=document.getElementById('tdis').value;
	$('#wb_Text13').load("cal_main.php?tdis="+tdis).fadeIn('fast');
	}



function t2()
{
var adlv=document.getElementById('adlv').value;if(adlv==''){adlv=0;}
var tamm=document.getElementById('tamm').value;if(tamm==''){tamm=0;}
var adl=document.getElementById('adl').value;
if(adl=='+')
{
tvvvv=Number(tamm)+Number(adlv);
}
else
{
	tvvvv=Number(tamm)-Number(adlv);
}
document.getElementById('tamm2').value=tvvvv.round(2);
/*$('#ledg').load('get_ledg.php?adl='+encodeURIComponent(adl)).fadeIn("fast");*/

} 

   Number.prototype.round = function(places) {
  return +(Math.round(this + "e+" + places)  + "e-" + places);
}

function isNumber(evt) 
{
var iKeyCode = (evt.which) ? evt.which : evt.keyCode
if(iKeyCode < 48 || iKeyCode > 57)
{
return false;
}
return true;
}
</script>

<style>
#Button1:focus { 
    outline: none !important;
    border-color: red;
    box-shadow: 0 0 30px #719ECE;
}
</style>


	</head>
<body onload="tmppr1()" >
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side strech">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Purchase Return
                     
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Purchase Return</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                   <form method="post" name="form1" id="form1" action="purchase_retns.php">
  <input type="hidden" name="blno" id="blno" value="<?php echo $blno;?>">  
 <input type="hidden" id="chk" readonly="true" name="chk" value="0" >
  
		<div class="box box-success" >
  
  <table border="0" width="860px" class="table table-hover table-striped table-bordered">
  <tr>
  <td align="right" style="padding-top:15px;"><b>Company Name :</b>
  </td>
  <td colspan="3" > 
  
  <select id="sup" name="sup" tabindex="1"  class="form-control" onchange="gtid()" >
	<?
		$query="select * from main_suppl  WHERE sl='$sid'";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
			?>
			<option value="<?=$rw['sl'];?>"><?=$rw['spn'];?> <?if($rw['nm']!=""){?>( <?=$rw['nm'];?> )<?}?></option>
			<?
		}
	?>
	</select>
	
  </td>

  </tr>
  <tr>
   <td align="right" style="padding-top:15px;"><b>Address : </b></td>

<td >
<div id="get_add">
 <input type="text"  class="form-control" tabindex="2"  style="font-weight: bold;" readonly id="addr" name="addr" value="<?php echo $addr;?> (<?php echo $gstin;?>)"  placeholder="Customer Address">
</div>
 </td>
   <td align="right" style="padding-top:15px;"><b>Contact No. :</b></td>

<td>
<input type="text" id="mob" class="form-control" tabindex="3"  style="font-weight: bold;" readonly="true" name="mob" value="<?php echo $mob1;?>" size="35" placeholder="Customer Contact No.">
 </td>
  </tr>
  <tr>

   <td align="right" style="padding-top:15px;"><b>E-Mail :</b></td>

<td>
<input type="text" id="mail" class="form-control" tabindex="4"  style="font-weight: bold;" readonly="true" name="mail" value="<?php echo $mail;?>"  size="35" placeholder="Customer E-Mail">
 </td>
  <td align="right" style="padding-top:15px">
<b>Branch : </b>
</td>
<td align="left" >

<select name="brncd" class="form-control" tabindex="5"  size="1" id="brncd" >
<?

$query="Select * from main_branch where sl='$brncd'";

   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
</select>

</td>

</tr>
  <tr>
    <td align="right" style="padding-top:15px;"> <b>Invoice No. : </b></td>
  <td>
  <input type="text" class="form-control" tabindex="6"  id="inv"  name="inv" value="<?php echo $inv;?>" readonly size="35" placeholder="Enter Invoice No...">
  </td>
    <td align="right" style="padding-top:15px;"> <b>Date : </b></td>
  <td>
  <input type="text" class="form-control"  id="dt" tabindex="7"  name="dt" value="<? echo date('d-m-Y');?>" size="35" placeholder="Enter Date">
  </td>
</tr>
  <tr>
    <td align="right" style="padding-top:15px;"> <b>From State : </b></td>
  <td>
  <div id="fst_div">
<select id="fst" data-placeholder="Choose Your Supplier" name="fst"  class="form-control" onchange="get_gst()" >

	<?
	$sql="SELECT * FROM main_state WHERE sl='$fst' ORDER BY sn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($result))
		{
	?>
    <option value="<?=$row['sl'];?>"<?if($row['sl']==$fst){echo 'selected';}?>><?=$row['sn'];?> - <?=$row['cd'];?></option>
<?}?>
</select>
</div>
  </td>
    <td align="right" style="padding-top:15px;"> <b>To State : </b></td>
  <td>
<div id="tst_div">
<select id="tst" data-placeholder="Choose Your Supplier" name="tst" class="form-control" onchange="get_gst()"  >

	<?
	$sql="SELECT * FROM main_state WHERE  sl='$tst' ORDER BY sn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($result))
		{
	?>
    <option value="<?=$row['sl'];?>"<?if($row['sl']==$tst){echo 'selected';}?>><?=$row['sn'];?> - <?=$row['cd'];?></option>
<?}?>
</select>
</div>
  </td>
</tr>

</table>
</div>
<div class="box box-success" >
<table width="800px" class="table table-hover table-striped table-bordered">
<tr>
<td colspan="18">
<table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td align="center" width="10%" ><b>Model</b></td>
<td align="center" width="10%" ><b>Godown</b></td>
<td align="center" width="5%" ><b>Unit</b></td>
<td align="center" width="7%" ><b>Serial No.</b></td>
<td align="center" width="8%" ><b>Quantity</b></td>
<td align="center" width="5%" ><b>Basic Rate</b></td>
<td align="center" width="6%" ><b>Total</b></td>
<td align="center" width="5%" ><b>Dis.%</b></td>
<td align="center" width="5%" ><b>Dis.Am.</b></td>
<td align="center" hidden ><b>L.Dis.%</b></td>
<td align="center" hidden ><b>L.Dis.Am</b></td>
<td align="center" width="5%" ><b>Taxable Val.</b></td>
<td align="center" width="3%" ><B>C-GST%</B></td>
<td align="center" width="5%"><B>C-GST Am.</B></td>
<td align="center" width="3%"><B>S-GST%</B></td>
<td align="center" width="5%"><B>S-GST Am.</B></td>
<td align="center" width="3%"><B>I-GST%</B></td>
<td align="center" width="5%"><B>I-GST Am.</B></td>
<td align="center" width="5%" ><b>Amount</b></td>
<td align="center" width="5%" ><b>Rate</b></td>
</tr>

</table>
   </td>
	   </tr>
	       <tr height="230px">
	   <td colspan="10">
	<div id="wb_Text13" ></div>
	  	</td>
	   </tr>
<input type="hidden" name="lcd" id="lcd"    class="form-control" style="text-align:right"  value="" onblur="v()">
<input type="hidden" name="lfr" id="lfr"  class="form-control" style="text-align:right" onblur="v()" >
<input type="hidden" name="vat" id="vat"  readonly class="form-control" style="text-align:right"  value="" onblur="v()">
<input type="hidden" name="vatamm" id="vatamm"  readonly class="form-control" style="text-align:right"  value="" >

<tr>

<td align="left">
<b><font size="3" color="blue">Total Amount :</font></b>
<input readOnly type="text" name="ttl_amm" id="ttl_amm" tabindex="29" class="form-control" style="text-align:right;font-size:14pt" value="">
</td>
<td align="left"  >
<b>
<font size="3" color="blue">Total Discount Am. :</font></b>
<div id="subt">
<input type="text" readOnly name="tddis" id="tddis" tabindex="34"  class="form-control" style="text-align:right;font-size:14pt"  value="" >
</div>
</td>
<td align="left"  >
<b>
<font size="3" color="blue">Total Taxable Am. :</font></b>
<div id="subt">
<input type="text" readOnly name="taxable_amm" id="taxable_amm" tabindex="34"  class="form-control" style="text-align:right;font-size:14pt"  value="" >
</div>
</td>
<td align="left">
<b><font size="3" color="blue">Tax Amount : C-GST :</font></b>
<input readOnly type="text" name="cgst_amm" id="cgst_amm" tabindex="30" class="form-control" style="text-align:right;font-size:14pt" value="">
</td>
<td align="left"  >
<b><font size="3" color="blue">Tax Amount : S-GST :</font></b>
<input readOnly type="text" name="sgst_amm" id="sgst_amm" tabindex="31" class="form-control" style="text-align:right;font-size:14pt" value="">
</td>
<td align="left"  >
<b><font size="3" color="blue">Tax Amount : I-GST :</font></b>
<input readOnly type="text" name="igst_amm" id="igst_amm" tabindex="32" class="form-control" style="text-align:right;font-size:14pt" value="">
</td>
<td align="left"  >
<b>
<font size="3" color="blue">Tax Amount : GST :</font></b>
<div id="gst_am">
<input type="text" name="gst" id="gst" tabindex="33" readonly class="form-control" style="text-align:right;font-size:14pt"  value="0">
</div>
</td>



</tr>
<tr>
<td align="left"  >
<b>
<font size="3" color="blue">Sub Total :</font></b>
<div id="subt">
<input type="text" name="sttl" id="sttl" tabindex="34"  class="form-control" readonly style="text-align:right;font-size:14pt"  value="" >
</div>
</td>
 <td>
 <b>Round OFF:</b>
 <input type="text" class="form-control" id="roff" tabindex="35"  name="roff" value="" readonly style="text-align:right;background-color:#f3f4f5;font-size:14pt;color:blue" placeholder ="Enter Round OFF" size="25" onblur="document.getElementById('tamm').value=(parseFloat(document.getElementById('tamm1').value)+parseFloat(this.value)).round(2);t2();">
 </td>
<td align="left" >
<b><font size="3" color="blue">Amount :</font></b>
<font size="3">
<b>
<div id="pay">
<input type="text" name="tamm" id="tamm" tabindex="36" readonly class="form-control" style="background-color:#f3f4f5;font-size:14pt;color:blue" > 
<input type="hidden" name="tamm1" id="tamm1" tabindex="37"  class="form-control" style="background-color:#f3f4f5;" > 
</div>
</b>
</font>
</td>
 <td colspan="2">
 <b>Ledger :</b>
<div id="ledg">
 <select  name="remk" id="remk" tabindex="1"  class="form-control">
		<?php 
		$gettt = mysqli_query($conn,"SELECT * FROM main_ledg WHERE sl='$remk'") or die(mysqli_error($conn));
		while($rowww = mysqli_fetch_array($gettt))
		{
		?>
		<option value="<?=$rowww['sl'];?>" <?php if($rowww['sl']==$ledg){?> selected <? } ?>><?=$rowww['nm']?></option>
		<?php 
		} 
		?>
		</select>
		</div>
 </td>
 <td>
 <b>Add/Less</b><br>
 <table>
 <tr>
 <td>
<select class="sc" id="adl" name="adl" onchange="t2()" tabindex="39">
<?php if($adl=='+'){?><option value="+">Add(+)</option><? }  
if($adl=='-'){?><option value="-">less(-)</option><?}?>
</select>
</td>
<td>
<input type="text" class="form-control" onblur="t2()" id="adlv" tabindex="40" name="adlv" value="<?=$adlv;?>" readonly style="text-align:right;background-color:#f3f4f5;font-size:14pt;color:blue;" size="25" >
</td>
</tr>
</table>
</td>
<td align="left" >
<b><font size="3" color="blue">Pay Amount :</font></b>
<input type="text" name="tamm2" id="tamm2" tabindex="41"  readOnly class="form-control"  style="text-align:right;background-color:#f3f4f5;font-size:14pt;color:blue" >

</td>
</tr>
 <tr class="odd" >
<td colspan="10" align="right">

<input type="submit" class="btn btn-success" id="Button2" tabindex="48"  onclick="return confirm('Are You Sure To Submit !'); " name="bt1" tabindex="15" value="Submit"  >
</td>
</tr>
</table>





 
<input type="hidden" id="prid"  name="prid" value="<? echo $cid;?>">
<input type="hidden" id="stk" >
<input type="hidden" id="fls" >
<div id="ps">
</div>
</form>







</div>
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                         
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     

<div id="adpnm"></div>
<div id="admnm"></div>
	<!-- Light Box -->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true"  >
	<div class="modal-dialog"  style="width:700px;;">
		<div class="modal-content">
		
			<div class="modal-body" id="cnt1">
			
			
			</div>
        </div>
    </div>
</div>
<div class="modal fade" id="modals" tabindex="-1" role="dialog" aria-hidden="true"  >
	<div class="modal-dialog"  style="width:700px;;">
		<div class="modal-content">
		
			<div class="modal-body" id="cntt">
			
			
			</div>
        </div>
    </div>
</div>
<!-- End -->





    </body>
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>	
 $('#prnm').chosen({
no_results_text: "Oops, nothing found!",
});	
$('#bcd').chosen({
no_results_text: "Oops, nothing found!",
});	

 $('#sup').chosen({
  no_results_text: "Oops, nothing found!",

  });
     $('#fst').chosen({
  no_results_text: "Oops, nothing found!",
   }); 
      $('#tst').chosen({
  no_results_text: "Oops, nothing found!",
   }); 
   $('#remk').chosen({
  no_results_text: "Oops, nothing found!",
   }); 
</script>
<script>
function get_data(tsl,prsl,unit,qty,mrp,total,disp,disa,ttl,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,rate,net_am,unit,betno,bcd)
{ 
		document.getElementById('tsl').value=tsl;
		document.getElementById('prnm').value=prsl;
		$('#prnm').trigger("chosen:updated");	
		document.getElementById('bcd').value=bcd;
		$('#bcd').trigger("chosen:updated");		
		
		document.getElementById('qnty').value=qty;
		document.getElementById('mrp').value=mrp;
		document.getElementById('total').value=total;
		document.getElementById('disp').value=disp;
		document.getElementById('disa').value=disa;
		document.getElementById('lttl').value=ttl;
		document.getElementById('cgst_rt').value=cgst_rt;
		document.getElementById("cgst_rt").readOnly = true;
		document.getElementById('cgst_am').value=cgst_am;
		document.getElementById('sgst_rt').value=sgst_rt;
		document.getElementById("sgst_rt").readOnly = true;
		document.getElementById('sgst_am').value=sgst_am;
		document.getElementById('igst_rt').value=igst_rt;
		document.getElementById("igst_rt").readOnly = true;
		document.getElementById('igst_am').value=igst_am;
		document.getElementById('rate').value=rate;
		document.getElementById('net_amm').value=net_am;
		document.getElementById('unit_nm').value=unit;
		document.getElementById('betno').value=betno;
		$('.upd').html('<input type="button" value="Update" onclick="add()" style="padding:2px;width:100%" class="btn btn-warning">');
gtt_unt();

}
</script>
</html>