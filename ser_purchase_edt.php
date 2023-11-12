<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
include "function.php";
$blno=$_REQUEST['blno'];

$result2 = mysqli_query($conn,"DELETE FROM main_ser_purchasedet_edt WHERE blno='$blno'");

$query214 = "insert into main_ser_purchasedet_edt (cat, scat, unit, betno, usl, uval, pck, prsl, qty, prc, ttl, dis, amm, total, disp, disa, ldis, ldisa, fst, tst, cgst_rt, cgst_am, sgst_rt, sgst_am, igst_rt, igst_am, net_am, mrp, bcd, rate, stk_rate, blno, rdt, dt, eby, rqty)
select cat, scat, unit, betno, usl, uval, pck, prsl, qty, prc, ttl, dis, amm, total, disp, disa, ldis, ldisa, fst, tst, cgst_rt, cgst_am, sgst_rt, sgst_am, igst_rt, igst_am, net_am, mrp, bcd, rate, stk_rate, blno, rdt, dt, eby, rqty
from main_ser_purchasedet where blno = '$blno'";
$result214 = mysqli_query($conn,$query214)or die (mysqli_error($conn));  


$data=mysqli_query($conn,"select * from main_ser_purchase where blno='$blno'");
while($row=mysqli_fetch_array($data))
{
$blno=$row['blno'];
$typ=$row['typ'];
$fst=$row['fst'];
$tst=$row['tst'];
$gst=$row['gst'];
$sid=$row['sid'];
$addr=$row['addr'];
$inv=$row['inv'];
$sttl=$row['sttl'];
$tmm2=$row['tmm2'];
$amm=$row['amm'];
$sdis=$row['sdis'];
$tamm=$row['tamm'];
$paid=$row['paid'];
$due=$row['due'];
$roff=$row['roff'];
$adl=$row['adl'];
$adlv=$row['adlv'];
$remk=$row['remk'];
$lfr=$row['lfr'];
$lcd=$row['lcd'];
$crdtp=$row['crdtp'];
$cbnm=$row['cbnm'];
$dt=$row['dt'];
$edt=$row['edt'];
$rdt=$row['rdt'];
$pdts=$row['pdts'];
$vat=$row['vat'];
$vatamm=$row['vatamm'];
$bcd=$row['bcd'];
$eby=$row['eby'];
$rstat=$row['rstat'];


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

<script type="text/javascript" language="javascript">
$(document).ready(function()
{

var jQueryDatePicker2Opts =
{
dateFormat: 'dd-mm-yy',
changeMonth: true,
changeYear: true,
showButtonPanel: false,
showAnim: 'show'
};
$("#dt").datepicker(jQueryDatePicker2Opts);
$("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$('#overlay').fadeOut('fast');
$("#expdt").datepicker(jQueryDatePicker2Opts);
$("#expdt1").datepicker(jQueryDatePicker2Opts);
$("#expdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#ddt").datepicker(jQueryDatePicker2Opts);
$("#ddt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#idt").datepicker(jQueryDatePicker2Opts);
$("#idt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

$('#cat').trigger('chosen:open');
h();
});
  
function isNumber(evt) 
{
var iKeyCode = (evt.which) ? evt.which : evt.keyCode
if(iKeyCode < 48 || iKeyCode > 57)
{
return false;
}
return true;
} 
function isNumber1(evt) 
{
var iKeyCode = (evt.which) ? evt.which : evt.keyCode
if(iKeyCode < 45 || iKeyCode > 57)
{
return false;
}
return true;
}   
  </script>
   <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>


<script>
function gtid()
{
    sid=document.getElementById('sup').value;

    if(sid=='Add')
	{
		
		$('#cnt1').load('adsup.php?typ=Debtors').fadeIn("fast");
		$('#compose-modal').modal('show');
	}
	else
	{
    $.get('suname.php?cid='+sid, function(data) {
        
                var str= data;
				var stra = str.split("@@")
				var fstr1 = stra.shift()
				var addr = stra.shift()  
                var mob = stra.shift() 
                var mail = stra.shift() 
                var st = stra.shift() 
    //$('#addr').val(addr);
    $('#mob').val(mob);
    $('#mail').val(mail);
	
if(st!='')
{
$('#fst').val(st);

$('#fst').trigger('chosen:updated');	
}
else
{
$('#fst').val('1');

$('#fst').trigger('chosen:updated');		
}
		

     
}); 

 $("#get_add").load("get_addr.php?cid="+sid).fadeIn('fast');
	

	}
}
/*
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
*/


/*
function getad()
{
	 sid=document.getElementById('sup').value;
	 alert(sid);
	 $("#get_addr").load("get_addr.php?sid="+sid).fadeIn('fast');
}
*/

function addspnm()
{
	var snm=encodeURIComponent(document.getElementById('snm').value);
	var pnm=encodeURIComponent(document.getElementById('cpnm').value);
	var addr=encodeURIComponent(document.getElementById('addr1').value);
	var email=encodeURIComponent(document.getElementById('email').value);
	var mob1=encodeURIComponent(document.getElementById('mob1').value);
	var mob2=encodeURIComponent(document.getElementById('mob2').value);
	var gstin_no=encodeURIComponent(document.getElementById('gstin_no').value);
	$('#adpnm').load("adsups.php?snm="+snm+"&pnm="+pnm+"&addr="+addr+"&email="+email+"&mob2="+mob2+"&mob1="+mob1+"&gstin_no="+gstin_no).fadeIn('fast');

}

</script>
<script type="text/javascript">
</script>
<link rel="stylesheet" type="text/css" href="style_sedt.css" />

<script type="text/javascript">

function h()
{
$("#asd").hide();
}
function pmod(a)
{
	if(a=="1")
	{ 
		document.getElementById('gtdl1').style.display='none';
		document.getElementById('crfno').value='';
		document.getElementById('idt').value='';
		document.getElementById('cbnm').value='';
    }
	else
	{
	  document.getElementById('gtdl1').style.display='table-row';
	  $("#xxx").load("getbank.php").fadeIn('fast');
	}

}
</script>

<script type="text/javascript" src="shortcut.js"></script>

<script type="text/javascript" src="ajax.js"></script>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />

<script>
	
/*
function t()
{
	$('#pay').load('total_gst.php').fadeIn('fast');
	$('#subt').load('subt1_gst.php').fadeIn('fast');
	$('#gst_am').load('gst_am_p.php').fadeIn('fast');
	$('#dis_am').load('dis_am.php').fadeIn('fast');
tdis=document.getElementById('disa').value;
}
 */ 
	
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


/* function get_cat()  
 {
cat=document.getElementById('cat').value;
scat=document.getElementById('scat').value;
$("#scat_div").load("get_cat_pur.php?cat="+cat).fadeIn('fast');
$("#prod_div").load("get_product.php?cat="+cat+"&scat="+scat).fadeIn('fast');
get_gstval();

 }*/
 function gtt_unt()
 {
	prnm=document.getElementById('prnm').value;		
	 $("#g_unt").load("get_unt.php?prnm="+prnm).fadeIn('fast');
 }
 /*function get_prod()
 {
cat=document.getElementById('cat').value;
scat=document.getElementById('scat').value;	 
$("#prod_div").load("get_product.php?cat="+cat+"&scat="+scat).fadeIn('fast');	
$("#unit_div").load("get_unit.php?cat="+cat+"&scat="+scat).fadeIn('fast');	
get_gstval();
 }*/
function add()
{
		var prnm=document.getElementById('prnm').value;
		var unit=document.getElementById('unit').value;
		var usl=document.getElementById('usl').value;
		var qnty=document.getElementById('qnty').value;
		var mrp=document.getElementById('mrp').value;
		var total=document.getElementById('total').value;
		var disp=document.getElementById('disp').value;
		var disa=document.getElementById('disa').value;
		var ldis=document.getElementById('ldis').value;
		var ldisa=document.getElementById('ldisa').value;		
		var lttl=document.getElementById('lttl').value;
		var fst=document.getElementById('fst').value;
		var tst=document.getElementById('tst').value;
		var cgst_rt=document.getElementById('cgst_rt').value;
		var sgst_rt=document.getElementById('sgst_rt').value;
		var igst_rt=document.getElementById('igst_rt').value;
		var cgst_am=document.getElementById('cgst_am').value;
		var sgst_am=document.getElementById('sgst_am').value;
		var igst_am=document.getElementById('igst_am').value;
		var net_amm=document.getElementById('net_amm').value;
		var bcd=document.getElementById('bcd').value;
		var rate=document.getElementById('rate').value;
		var betno=document.getElementById('betno').value;
		var tsl=document.getElementById('tsl').value;
		var blno=document.getElementById('blno').value;
			 	
	if(prnm=='')
	  {
	alert("Product Can't be blank");
	  }
	  else if(unit=='')
	  {
		alert("Unit Can't be blank");  
		document.getElementById('unit').focus();
	  }
	   else if(qnty=='')
	  {
		alert("Quantity Can't be blank");   
		document.getElementById('qnty').focus();
	  }
	  else if(mrp=='')
	  {
		alert("Rate Can't be blank");   
		document.getElementById('mrp').focus();
	  }
	    else if(net_amm=='')
	  {
		alert("Amount Can't be blank");   
		document.getElementById('net_amm').focus();
	  } 
	  
	else
	{
	 $('#wb_Text13').load("ser_adtmppr_edt.php?prnm="+prnm+"&unit="+unit+"&usl="+usl+"&qnty="+qnty+"&mrp="+mrp+"&total="+total+"&disp="+disp+"&disa="+disa+"&ldis="+ldis+"&ldisa="+ldisa+'&lttl='+lttl+'&fst='+fst+'&tst='+tst+'&cgst_rt='+cgst_rt+'&sgst_rt='+sgst_rt+'&igst_rt='+igst_rt+'&cgst_am='+cgst_am+'&sgst_am='+sgst_am+'&igst_am='+igst_am+'&net_amm='+net_amm+'&bcd='+bcd+'&rate='+rate+'&betno='+betno+'&tsl='+tsl+'&blno='+blno).fadeIn('fast');
	}
	}
	function reset()
	{
		document.getElementById('prnm').value='';
		$('#prnm').trigger('chosen:updated');	
		document.getElementById('unit').value='';
		document.getElementById('usl').value='';
		document.getElementById('qnty').value='';
		document.getElementById('mrp').value='';
		document.getElementById('total').value='';
		document.getElementById('disp').value='';
		document.getElementById('disa').value='';
		document.getElementById('ldis').value='';
		document.getElementById('ldisa').value='';
		document.getElementById('lttl').value='';
		document.getElementById('cgst_rt').value='';
		document.getElementById('sgst_rt').value='';
		document.getElementById('igst_rt').value='';
		document.getElementById('cgst_am').value='';
		document.getElementById('sgst_am').value='';
		document.getElementById('igst_am').value='';
		document.getElementById('net_amm').value='';		
		document.getElementById('rate').value='';		
		document.getElementById('betno').value='';		
		document.getElementById('tsl').value='';		
	}
	function tmppr1()
	{
	var blno=document.getElementById('blno').value;
	$('#wb_Text13').load("ser_tmppr_edt.php?blno="+blno).fadeIn('fast');
	$('#fst_div').load("fst_get_edt.php?blno="+blno).fadeIn('fast');
	$('#tst_div').load("tst_get_edt.php?blno="+blno).fadeIn('fast');
	}
	
	function cal_main()
	{
	tdis=document.getElementById('tdis').value;
	$('#wb_Text13').load("cal_main.php?tdis="+tdis).fadeIn('fast');
	}
	function deltpr1(sl)
	{
	$('#wb_Text13').load("ser_deltpr_edt.php?sl="+sl).fadeIn('fast');
	}

 function get_gst()
 {
var fst=document.getElementById('fst').value;	
var tst=document.getElementById('tst').value;
if(fst==tst)	
{
document.getElementById("sgst_am").readOnly = false;	
document.getElementById("cgst_am").readOnly = false;	
document.getElementById("igst_am").readOnly = true;
}
else
{
document.getElementById("sgst_am").readOnly = true;	
document.getElementById("cgst_am").readOnly = true;	
document.getElementById("igst_am").readOnly = false;
	
}
get_gstval();
}	
function get_gstval()
{
var prnm=document.getElementById('prnm').value;	
var dt=document.getElementById('dt').value;	
var fst=document.getElementById('fst').value;	
var tst=document.getElementById('tst').value;
if(prnm=="Add")
{
	$('#cntt').load('ser_admodel.php').fadeIn("fast");
	$('#modals').modal('show');
}
else
{
	$.get('get_gst.php?dt='+dt+'&prnm='+prnm, function(data) 
	{
			
					var str= data
					var stra = str.split("@")
					var cgst = stra.shift()
					var sgst = stra.shift()  
					var igst = stra.shift() 
	if(fst==tst)	
	{
	igst=0;	
	}	
	else
	{
	cgst=0;	
	sgst=0;	
	}	
		$('#cgst_rt').val(cgst);
		$('#sgst_rt').val(sgst);
		
		$('#igst_rt').val(igst);
		 cal();
	}); 
	gtt_unt();

}
}

function addmodel()
{
	var cat=encodeURIComponent(document.getElementById('cat').value);
	var scat=encodeURIComponent(document.getElementById('scat').value);
	var pnm=encodeURIComponent(document.getElementById('pnm').value);
	var hsn=encodeURIComponent(document.getElementById('hsn').value);
	var igst=encodeURIComponent(document.getElementById('igst').value);
	var ret=encodeURIComponent(document.getElementById('ret').value);
	var sun=encodeURIComponent(document.getElementById('sun').value);
	var smvlu=encodeURIComponent(document.getElementById('smvlu').value);
	var mun=encodeURIComponent(document.getElementById('mun').value);
	var mdvlu=encodeURIComponent(document.getElementById('mdvlu').value);
	var bun=encodeURIComponent(document.getElementById('bun').value);
	var bgvlu=encodeURIComponent(document.getElementById('bgvlu').value);
	var sret=encodeURIComponent(document.getElementById('sret').value);
	var mret=encodeURIComponent(document.getElementById('mret').value);
	var bret=encodeURIComponent(document.getElementById('bret').value);
	var cgst=encodeURIComponent(document.getElementById('cgst').value);
	var sgst=encodeURIComponent(document.getElementById('sgst').value);
$('#admnm').load("ser_admodels.php?cat="+cat+"&scat="+scat+"&pnm="+pnm+"&hsn="+hsn+"&igst="+igst+"&ret="+ret+"&sun="+sun+"&smvlu="+smvlu+"&mun="+mun+"&mdvlu="+mdvlu+"&bun="+bun+"&bgvlu="+bgvlu+"&sret="+sret+"&mret="+mret+"&bret="+bret+"&cgst="+cgst+"&sgst="+sgst).fadeIn('fast');
/*document.location="admodels.php?cat="+cat+"&scat="+scat+"&pnm="+pnm+"&hsn="+hsn+"&igst="+igst+"&ret="+ret+"&sun="+sun+"&smvlu="+smvlu+"&mun="+mun+"&mdvlu="+mdvlu+"&bun="+bun+"&bgvlu="+bgvlu+"&sret="+sret+"&mret="+mret+"&bret="+bret+"&cgst="+cgst+"&sgst="+sgst;*/
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
} 

   Number.prototype.round = function(places) {
  return +(Math.round(this + "e+" + places)  + "e-" + places);
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
                 Service Purchase Invoice
                     
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Service Purchase Invoice</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">
<form method="post" name="form1" id="form1" action="ser_purchase_edts.php" enctype="multipart/form-data">
<input type="hidden" name="blno" id="blno" value="<?php echo $blno;?>">
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="right" style="padding-top:15px;"><b>Company Name :</b>
</td>
<td colspan="3" > 

<select id="sup" name="sup" tabindex="1"  class="form-control" onchange="gtid()" >
<option value="">---Select---</option>
<option value="Add">---Add New---</option>
<?
$query="select * from main_suppl WHERE sl>0 order by nm";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
?>
<option value="<?=$rw['sl'];?>" <?php if($sid==$rw['sl']){ echo 'selected';}?>><?=$rw['spn'];?> <?if($rw['nm']!=""){?>( <?=$rw['nm'];?> )<?}?></option>
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
<select name="addr"  id="addr"  class="form-control" onchange="get_state()">

<?
$query1="Select * from main_suppl_gst where spn='$sid'";
$result1=mysqli_query($conn,$query1);
while($row=mysqli_fetch_array ($result1))
{
$spn=$row['spn'];
$addr=$row['addr'];
$pan=$row['pan'];
$gstin=$row['gstin'];
$x=$row['sl'];
?>
<option value="<?=$x?>" <?php if($addr==$row['sl']){ echo 'selected';}?>><?=$addr?> <?if($gstin!=""){?>( <?=$gstin;?> )<?}?></option>
<?
}
?>
</select>
</div>
</td>
<td align="right" style="padding-top:15px;"><b>Contact No. :</b></td>

<td>
<input type="text" id="mob" class="form-control" tabindex="3"  style="font-weight: bold;" readonly="true" name="mob" value="" size="35" placeholder="Customer Contact No." onkeypress="return isNumber(event)">
</td>
</tr>
<tr>

<td align="right" style="padding-top:15px;"><b>E-Mail :</b></td>

<td>
<input type="text" id="mail" class="form-control" tabindex="4"  style="font-weight: bold;" readonly="true" name="mail" value=""  size="35" placeholder="Customer E-Mail">
</td>
<td align="right" style="padding-top:15px">
<b>Branch : </b>
</td>
<td align="left" >

<select name="brncd" class="form-control" tabindex="5"  size="1" id="brncd" >
<?
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
$sl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $sl;?>" <?php if($bcd==$sl){ echo 'selected';}?>><? echo $bnm;?></option>
<?
}
?>
</select>

</td>

</tr>
<tr>
<td align="right" style="padding-top:15px;"> <b>Invoice No. : </b></td>
<td>
<input type="text" class="form-control" tabindex="6"  id="inv"  name="inv" value="<?php echo $inv;?>" size="35" placeholder="Enter Invoice No...">
</td>
<td align="right" style="padding-top:15px;"> <b>Date : </b></td>
<td>
<input type="text" class="form-control"  id="dt" tabindex="7"  name="dt" value="<? echo date('d-m-Y',strtotime($dt));?>" width="100%" placeholder="Enter Date">
</td>
</tr>
<tr>
<td align="right" style="padding-top:15px;"> <b>From State : </b></td>
<td>
<div id="fst_div">
<select id="fst" data-placeholder="Choose Your Supplier" name="fst"  class="form-control" onchange="get_gst()" width="100%">

<?
$sql="SELECT * FROM main_state WHERE sl>0 ORDER BY sn";
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
<select id="tst" data-placeholder="Choose Your Supplier" name="tst" class="form-control" onchange="get_gst()" width="100%" >

<?
$sql="SELECT * FROM main_state WHERE sl>0 ORDER BY sn";
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
<tr>
<td align="right" style="padding-top:15px;"> <b>Type : </b></td>
<td>
<select id="typ" name="typ" class="form-control" width="100%" >
<?
$sql="SELECT * FROM main_ledg WHERE gcd='6' or gcd='20' ORDER BY nm";
$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
while($row=mysqli_fetch_array($result))
{
?>
<option value="<?=$row['sl'];?>"<?php if($typ==$row['sl']){ echo 'selected';}?> ><?=$row['nm'];?></option>
<?}?>
</select>
  </td>
<td align="right"   ><b>File Upload :</b></td>
<td >
<input type="file" name="fileToUpload1" id="fileToUpload1" class="btn btn-info" onchange="readURL(this);" >
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
<td align="center" width="10%" ><b>Service</b></td>
<td align="center" hidden ><b>Godown</b></td>
<td align="center" width="5%" ><b>Unit</b></td>
<td align="center" hidden><b>Serial No.</b></td>
<td align="center" width="6%" ><b>Quantity</b></td>
<td align="center" width="6%" ><b>Basic Rate</b></td>
<td align="center" width="8%" ><b>Total</b></td>
<td align="center" width="5%" ><b>Dis.%</b></td>
<td align="center" width="5%" ><b>Dis.Am.</b></td>
<td align="center" hidden ><b>L.Dis.%</b></td>
<td align="center" hidden ><b>L.Dis.Am</b></td>
<td align="center" width="8%" ><b>Taxable Val.</b></td>
<td align="center" width="5%" ><B>C-GST%</B></td>
<td align="center" width="6%"><B>C-GST Am.</B></td>
<td align="center" width="5%"><B>S-GST%</B></td>
<td align="center" width="6%"><B>S-GST Am.</B></td>
<td align="center" width="5%"><B>I-GST%</B></td>
<td align="center" width="6%"><B>I-GST Am.</B></td>
<td align="center" width="5%" ><b>Amount</b></td>
<td align="center" width="5%" ><b>Rate</b></td>
<td align="center" width="4%"><b>Action</b></td>
</tr>
<tr>
<input type="hidden" name="unit_nm" id="unit_nm">
<input type="hidden" name="tsl" id="tsl">
<td> 
<div id="prod_div">
<select id="prnm" name="prnm" tabindex="10"  onchange="get_gstval()" style="width:100%">
<option value="">---Select---</option>
<option value="Add">---Add New---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_product where typ='1' order by pnm");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
?>
<Option value="<?=$sl;?>"><?=reformat($pnm);?></option>
<?}?>
</select>
</div>
</td>
<td align="left" hidden>
<select name="bcd" class="form-control" tabindex="5"  size="1" id="bcd" >
<?
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
$sl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
</select>

</td>

<td> 
<div id="g_unt">
<select id="unit" name="unit" class="sc" tabindex="11" style="padding:3px;width:100%">
<option value="">---Select---</option>
</select>
</div>
</td>
<td hidden>
<input type="text" id="betno" class="sc" tabindex="13"  autocomplete="off" style="text-align:center" name="betno">
</td>
<td>
<input type="text" id="qnty" class="sc" tabindex="13"  autocomplete="off" style="text-align:center" name="qnty" value="" onblur="cal()" onkeypress="return isNumber(event)" >
</td>
<td>
<input type="text" class="sc" id="mrp" tabindex="14"  autocomplete="off" name="mrp" value="" style="text-align:right" onblur="cal()" onkeypress="return isNumber1(event)">
</td>

<td>
<input type="text" class="sc"  id="total" tabindex="15" autocomplete="off" name="total" value=""  style="text-align:left" onkeypress="return isNumber1(event)">
</td>
<td>
<input type="text" class="sc"   id="disp" tabindex="16" autocomplete="off" name="disp" value="" onblur="cal()" style="text-align:left" onkeypress="return isNumber1(event)">
</td>
<td >
<input type="text" class="sc"   id="disa" tabindex="17" autocomplete="off" name="disa" value="0"  style="text-align:left" onkeypress="return isNumber1(event)">
</td>
<td hidden>
<input type="text" class="sc"   id="ldis" tabindex="18" autocomplete="off" name="ldis" value="0" onblur="cal()" style="text-align:left" >
</td>
<td hidden>
<input type="text" class="sc" tabindex="19"  id="ldisa" autocomplete="off" name="ldisa" value=""  style="text-align:left" >
</td>

<td>
<input type="text" class="sc" id="lttl" name="lttl" value="" tabindex="20"   autocomplete="off"  style="text-align:right" onblur="cal_back()" onkeypress="return isNumber1(event)">
</td>
<td align="center">
<input type="text" name="cgst_rt" id="cgst_rt" class="sc" tabindex="21" readOnly class="sc" onfocus="this.select();"  style="text-align:center" onkeypress="return isNumber1(event)">
</td>
<td  align="center">
<input type="text" name="cgst_am" id="cgst_am" class="sc" tabindex="22" class="sc" onfocus="this.select();"  style="text-align:right" onkeypress="return isNumber1(event)">
</td>
<td  align="center">
<input type="text" name="sgst_rt" id="sgst_rt" class="sc" tabindex="23" readOnly class="sc" onfocus="this.select();"  style="text-align:center" onkeypress="return isNumber1(event)">
</td>
<td  align="center">
<input type="text" name="sgst_am" id="sgst_am" class="sc" tabindex="24" class="sc" onfocus="this.select();"  style="text-align:right" onkeypress="return isNumber1(event)">
</td>
<td  align="center">
<input type="text" name="igst_rt" id="igst_rt" class="sc" tabindex="25" readOnly class="sc" onfocus="this.select();"  style="text-align:center" onkeypress="return isNumber1(event)">
</td>
<td align="center">
<input type="text" name="igst_am" id="igst_am" class="sc" readOnly tabindex="26" class="sc" onfocus="this.select();"  style="text-align:right" onkeypress="return isNumber1(event)">
</td>
<td>
<input type="text" class="sc" id="net_amm" name="net_amm" value="" tabindex="27"   autocomplete="off"  style="text-align:right" onkeypress="return isNumber1(event)">
</td>
<td>
<input type="text" class="sc" id="rate" name="rate" readonly tabindex="27"   autocomplete="off"  style="text-align:right" onkeypress="return isNumber1(event)">
</td>

<td class="upd">
<input type="button" class="btn btn-primary btn-xs" id="Button1" tabindex="28"  name="" value="Add"  onclick="add()" style="width:100%" >
</td>
</tr>
</table>
   </td>
	   </tr>
	       <tr height="230px">
	   <td colspan="10">
	<div id="wb_Text13" >

		</div>
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
<input type="text" name="sttl" id="sttl" tabindex="34"  class="form-control" style="text-align:right;font-size:14pt" readonly onkeypress="return isNumber1(event)">
</div>
</td>
 <td>
 <b>Round OFF:</b>
 <input type="text" class="form-control" id="roff" tabindex="35"  name="roff" onkeypress="return isNumber1(event)" style="text-align:right;background-color:#f3f4f5;font-size:14pt;color:blue" placeholder ="Enter Round OFF" size="25" onblur="document.getElementById('tamm').value=(parseFloat(document.getElementById('tamm1').value)+parseFloat(this.value)).round(2);t2();">
 </td>
<td align="left" >
<b><font size="3" color="blue">Amount :</font></b>
<font size="3">
<b>
<div id="pay">
<input type="text" name="tamm" id="tamm" tabindex="36"  class="form-control" style="background-color:#f3f4f5;font-size:14pt;color:blue" readonly onkeypress="return isNumber1(event)"> 
<input type="hidden" name="tamm1" id="tamm1" tabindex="37"  class="form-control" style="background-color:#f3f4f5;" onkeypress="return isNumber1(event)"> 
</div>
</b>
</font>
</td>
 <td colspan="2">
 <b>Remark's :</b>
 <input type="text" class="form-control" id="remk" tabindex="38"  name="remk" value="<?=$remk;?>" size="25" >
 </td>
 <td>
 <b>Add/Less</b><br>
 <table>
 <tr>
 <td>
<select class="sc" id="adl" name="adl" onchange="t2()" tabindex="39">
<option value="+">Add(+)</option>
<option value="-">less(-)</option>
</select>
</td>
<td>
<input type="text" class="form-control" onblur="t2()" id="adlv" tabindex="40" name="adlv" value="" style="text-align:right;background-color:#f3f4f5;font-size:14pt;color:blue;" onkeypress="return isNumber1(event)">
</td>
</tr>
</table>
</td>
<td align="left" >
<b><font size="3" color="blue">Pay Amount :</font></b>
<input type="text" name="tamm2" id="tamm2" tabindex="41"  class="form-control"  style="text-align:right;background-color:#f3f4f5;font-size:14pt;color:blue" onkeypress="return isNumber1(event)" readonly>

</td>
</tr>
</table>
<table width="800px" class="table table-hover table-striped table-bordered">

<tr>
	<td align="left" >
	<font color="red">*</font><b>Cash Or Bank Ac. :</b>
	 <select  name="dldgr" id="dldgr" tabindex="42"  class="form-control">
							<?php 
							$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='1' or gcd='2'") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?=$row['sl']?>"<?=$row['sl'] == '3' ? 'selected' : '' ?>><?=$row['nm']?></option>
							<?php 
							} 
							?>
						</select>
	</td>

<td>
<b>Payment Mode: </b>
<select name="mdt" size="1" id="mdt" tabindex="43" onchange="pmod(this.value)" class="form-control">

<?
$data2 = mysqli_query($conn,"select * from ac_paymtd ");

		while ($row2 = mysqli_fetch_array($data2))
	{
	$mtd = $row2['mtd'];
	$msl = $row2['sl'];
	echo "<option value='".$msl."'>".$mtd."</option>";
	}
	?>
</select>
 </td>

 <td  >
 <b>Payment Amount:</b>
 <input type="text" class="form-control" id="pamm" tabindex="44"  name="pamm" onkeypress="return isNumber1(event)" placeholder ="Enter Payment Amount">
 </td>

 

</tr>
<tr id="gtdl1" style="display:none">
<td>
<b>Reference No: </b>
<input type="text" class="form-control" id="crfno"  tabindex="45"  name="crfno" value="" >
</td>

<td>
 <b>Date: </b>
<input type="text" class="form-control" id="idt" name="idt" tabindex="46"  value="" readonly >
</td>

<td>
 <b>Issued By:</b>
<input type="text" class="form-control" id="cbnm" tabindex="47"  name="cbnm" value="" >
</td>

</tr>

 <tr class="odd" >
<td colspan="10" align="right">

<input type="submit" class="btn btn-warning" id="Button2" tabindex="48"  onclick="return confirm('Are Yoy Sure To Submit !'); " name="bt1" tabindex="15" value="Update"  >
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