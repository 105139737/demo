<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$blno=$_REQUEST['blno'];
$bsl=$_REQUEST['bsl'];
$data1= mysqli_query($conn,"select * from main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$brncd=$row1['bcd'];
$dt=date('d-m-Y',strtotime($row1['dt']));
$fst=$row1['fst'];
$tst=$row1['tst'];
$cid=$row1['cid'];
$amm=$row1['amm'];
$tamm=$row1['tamm'];
$gstam=$row1['gstam'];
$payam=$row1['payam'];
$inv=$row1['inv']??"";
$nrtn=$row1['nrtn']??"";
$invto=$row1['invto'];


$tmod=$row1['tmod'];
$psup=$row1['psup'];
$vno=$row1['vno'];
$lpd=$row1['lpd'];
$no_servc=$row1['no_servc'];
$dur_mnth=$row1['dur_mnth'];
$cust_typ=$row1['cust_typ'];
$sale_per=$row1['sale_per'];
$cbnm=$row1['cbnm'];
$paid=$row1['paid'];
$crdtp=$row1['crdtp'];
$remk=$row1['remk'];
$adl=$row1['adl']??"";
$roff=$row1['roff'];

$sfno=$row1['sfno'];
$dpay=$row1['dpay'];
$finam=$row1['finam'];
$emiam=$row1['emiam'];
$emi_mnth=$row1['emi_mnth'];
$dldgr=$row1['dldgr'];
$datad= mysqli_query($conn,"select * from main_cust where sl='$cid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$caddr=$rowd['addr'];
}
}
$crfno="";
$idt="";
$rult21 = mysqli_query($conn,"SELECT * FROM ".$DBprefix."drcr where cbill='$blno' and nrtn='Payment' and cid='$cid'")or die (mysqli_error($conn));
while($R0=mysqli_fetch_array($rult21))
{
//$dldgr=$R0['cldgr'];
$idt=date('d-m-Y',strtotime($R0['idt']));
$crfno=$R0['mtddtl'];
}


?>
<html>
    
    
<head>
<style type="text/css"> 
th{
text-align:center;
color:#000;
border:1px solid #37880a;
}


a{
cursor:pointer;
}

select.sc {
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
	padding: 4px;
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
	left: 6%;
	top: 46%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	z-index:1000;
}
</style> 

   <link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003;
   display: none;
   
}
</style>

<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
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
     /* $("#dt").datepicker(jQueryDatePicker2Opts);
	$("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	
	$("#idt").datepicker(jQueryDatePicker2Opts);
	
	$("#idt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	*/
	$("#dob").datepicker(jQueryDatePicker2Opts);
	$("#dob").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	$("#doa").datepicker(jQueryDatePicker2Opts);
	$("#doa").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});	  

 h();
   });
   
  </script>
      <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
   
<script type="text/javascript">
/*function getb()
{
prnm=document.getElementById('prnm').value;
brncd=document.getElementById('brncd').value;
$("#gbet").load("getbe.php?pcd="+prnm+"&brncd="+brncd).fadeIn('fast');
}
*/
</script>

<script type="text/javascript" src="jquery.ui.widget.min.js"></script>


<script type="text/javascript">
function gtid()
{
    sid=document.getElementById('custnm').value;
    if(sid=='Add')
	{
		
		$('#cnt1').load('adcstnm.php?typ=Debtors').fadeIn("fast");
		$('#compose-modal').modal('show');
	}
	else
	{
    $.get('cname.php?cid='+sid, function(data) {
        
                var str= data;
				var stra = str.split("@@") 
                var typ = stra.shift() 
				var fstr1 = stra.shift()
				var addr = stra.shift()  
                var mob = stra.shift() 
                var mail = stra.shift()
                var pp = stra.shift()
                var bal = stra.shift()
    $('#addr').val(addr);
    $('#mob').val(mob);
    $('#mail').val(mail);
    $('#pbal').val(bal);
    
     
}); 

setTimeout(function(){ v(); }, 500);
	}
}
function gtt_unt()
 {
	prnm=document.getElementById('prnm').value;
	unit_nm=document.getElementById('unit_nm').value;
	 $("#g_unt").load("get_unt_sale.php?prnm="+prnm+"&unit_nm="+unit_nm).fadeIn('fast');
 }
function addspnm()
{
	var ctyp=encodeURIComponent(document.getElementById('ctyp').value);
	var nm=encodeURIComponent(document.getElementById('nm').value);
	var addr1=encodeURIComponent(document.getElementById('addr1').value);
	var email=encodeURIComponent(document.getElementById('email').value);
	var mob1=encodeURIComponent(document.getElementById('mob1').value);

$('#adpnm').load("sentrysadd.php?nm="+nm+"&addr="+addr1+"&email="+email+"&mob1="+mob1+"&ctyp="+ctyp).fadeIn('fast');
}


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

function v()
{
		var vatt=0;
		var tt=0;
		var tam=0;
		var pbal= parseFloat(document.getElementById('pbal').value);if(document.getElementById('pbal').value==""){pbal=0;}		

		var tam= parseFloat(document.form1.tamm1.value);if(document.form1.tamm1.value==""){tam=0;}
		
	
		tt=tam;		
		document.getElementById('pay').value=Math.round(tt+pbal);	
}
function cal()
{
var pcs=parseFloat(document.getElementById('pcs').value);if(document.getElementById('pcs').value==''){pcs=0;}
var prc=parseFloat(document.getElementById('prc').value);if(document.getElementById('prc').value==''){prc=0;}
var total=parseFloat(document.getElementById('total').value);if(document.getElementById('total').value==''){total=0;}
var disp=parseFloat(document.getElementById('disp').value);if(document.getElementById('disp').value==''){disp=0;}
var disa=parseFloat(document.getElementById('disa').value);if(document.getElementById('disa').value==''){disa=0;}
var lttl=parseFloat(document.getElementById('lttl').value);if(document.getElementById('lttl').value==''){lttl=0;}
var cgst_rt=parseFloat(document.getElementById('cgst_rt').value);if(document.getElementById('cgst_rt').value==''){cgst_rt=0;}
var sgst_rt=parseFloat(document.getElementById('sgst_rt').value);if(document.getElementById('sgst_rt').value==''){sgst_rt=0;}
var igst_rt=parseFloat(document.getElementById('igst_rt').value);if(document.getElementById('igst_rt').value==''){igst_rt=0;}
var sgst=0;
var cgst=0;
var igst=0;
var lttl1=0;
var total1=0;
var disa1=0;
total1=(pcs*prc).round(2);
if(disp>0)
{
disa1=(total1*disp/100).round(2);
}
lttl=(total1-disa1).round(2);
/*if(sgst_rt>0)
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
	
*/
	if(sgst_rt>0 && cgst_rt>0)
	{
		
	var Tsgst=((lttl*(sgst_rt+cgst_rt))/(100+sgst_rt+cgst_rt)).round(2);
	sgst=(Tsgst/2).round(2);
	cgst=(Tsgst/2).round(2);
	}
	if(cgst_rt>0)
	{
	/*var cgst=((lttl*cgst_rt)/(100+cgst_rt)).round(2);*/
	}
	if(igst_rt>0)
	{
	var igst=((lttl*igst_rt)/(100+igst_rt)).round(2);
	}
	document.getElementById('sgst_am').value=sgst.round(2);
	document.getElementById('cgst_am').value=cgst.round(2);
	document.getElementById('igst_am').value=igst.round(2);
	net_amm=sgst+cgst+igst+lttl;
	document.getElementById('total').value=total1;	
	document.getElementById('disa').value=disa1;
	document.getElementById('lttl').value=lttl;
	document.getElementById('net_amm').value=lttl.round(2);	
	

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
$("#prod_div").load("get_product_bill.php").fadeIn('fast');
}
 function get_prod()
 {
$("#prod_div").load("get_product_bill.php").fadeIn('fast');	
}
*/
function get_stock()
{
var prnm=document.getElementById('prnm').value;
var brncd=document.getElementById('bcd').value;
var unit=document.getElementById('unit').value;
var reffno=document.getElementById('reffno').value;
var betno=encodeURIComponent(document.getElementById('betno').value);

$("#gbet").load("getbe.php?pcd="+prnm+"&brncd="+brncd+"&unit="+unit+"&betno="+betno+"&reffno="+reffno).fadeIn('fast');
}


/*	function add1()
	{
		
		var prnm=document.getElementById('prnm').value;
		var unit=document.getElementById('unit').value;
		var pcs=document.getElementById('pcs').value;
		var prc=document.getElementById('prc').value;
		var total=document.getElementById('total').value;
		var disp=document.getElementById('disp').value;
		var disa=document.getElementById('disa').value;
		var lttl=document.getElementById('lttl').value;
		var cgst_rt=document.getElementById('cgst_rt').value;
		var sgst_rt=document.getElementById('sgst_rt').value;
		var igst_rt=document.getElementById('igst_rt').value;
		var cgst_am=document.getElementById('cgst_am').value;
		var sgst_am=document.getElementById('sgst_am').value;
		var igst_am=document.getElementById('igst_am').value;
		var brncd=document.getElementById('brncd').value;
		var refno=document.getElementById('refno').value;
		var  fst=document.getElementById('fst').value;
		 var tst=document.getElementById('tst').value;
		 var usl=document.getElementById('usl').value;
		 var net_amm=document.getElementById('net_amm').value;
		 var betno=document.getElementById('betno').value;
		 var bcd=document.getElementById('bcd').value;
		 var tsl=document.getElementById('tsl').value;
		 var blno=encodeURIComponent(document.getElementById('blno').value);
	
	
		if(prnm=='')
		{
		alert("Product Can't be blank");
		}
		else if(refno=='')
		{
		alert("Purchase Invoice Can't be blank");
		}
		else if(lttl=='')
		{
		alert("Amount Can't be blank");	
		}
		else if(net_amm=='')
		{
		alert("Net Amount Can't be blank");	
		}
		else
		{
		
	//$('#wb_Text13').load('adtmppr.php?prnm='+prnm+'&pcs='+pcs+'&prc='+prc+'&lttl='+lttl+'&brncd='+brncd+'&fst='+fst+'&tst='+tst+'&cgst_rt='+cgst_rt+'&sgst_rt='+sgst_rt+'&igst_rt='+igst_rt+'&cgst_am='+cgst_am+'&sgst_am='+sgst_am+'&igst_am='+igst_am+'&refno='+encodeURIComponent(refno)+'&unit='+unit+'&usl='+usl).fadeIn('fast');
	$('#wb_Text13').load('adtmppr_edt.php?prnm='+prnm+'&unit='+unit+'&pcs='+pcs+'&prc='+prc+'&total='+total+'&disp='+disp+'&disa='+disa+'&lttl='+lttl+'&brncd='+brncd+'&fst='+fst+'&tst='+tst+'&cgst_rt='+cgst_rt+'&sgst_rt='+sgst_rt+'&igst_rt='+igst_rt+'&cgst_am='+cgst_am+'&sgst_am='+sgst_am+'&igst_am='+igst_am+'&refno='+encodeURIComponent(refno)+'&usl='+usl+'&bcd='+bcd+'&betno='+betno+'&tsl='+tsl+'&blno='+blno).fadeIn('fast');
		}
	
		
	}
	
	
	function reset()
	{
		document.getElementById('unit').value='';
		document.getElementById('pcs').value='';
		document.getElementById('prc').value='';
		document.getElementById('total').value='';
		document.getElementById('disp').value='';
		document.getElementById('disa').value='';
		document.getElementById('lttl').value='';
		document.getElementById('cgst_rt').value='';
		document.getElementById('sgst_rt').value='';
		document.getElementById('igst_rt').value='';
		document.getElementById('cgst_am').value='';
		document.getElementById('sgst_am').value='';
		document.getElementById('igst_am').value='';
		document.getElementById('net_amm').value='';
		document.getElementById('usl').value='';
		document.getElementById('betno').value='';
		$('#refno option').each(function() {
        $(this).remove();}); 
		document.getElementById('tsl').value='';
		document.getElementById('unit_nm').value='';
		document.getElementById('reffno').value='';
		document.getElementById('betnoo').value='';


	}
	*/
	
function temp()
	{
var blno=encodeURIComponent(document.getElementById('blno').value);
$('#wb_Text13').load("tmppr_bill_retn.php?blno="+blno).fadeIn('fast');
$('#fst_div').load("fst_get1.php").fadeIn('fast');
$('#tst_div').load("tst_get1.php").fadeIn('fast');
pmod('<?php  echo $crdtp;?>');
}
function deltpr(un,sl)
{
$('#wb_Text13').load("deltpr_edt.php?sl="+sl+"&tsl="+un).fadeIn('fast');
}
function t()
	{
	var blno=document.getElementById('blno').value;
	$('#billamm').load('stotal-gst-edt.php?blno='+blno).fadeIn('fast');
	$('#gst_am').load('gst-am-edt.php?blno='+blno).fadeIn('fast');
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
dt=document.getElementById('dt').value;	
prnm=document.getElementById('prnm').value;	
var fst=document.getElementById('fst').value;	
var tst=document.getElementById('tst').value;
$.get('get_gst.php?&dt='+dt+'&prnm='+prnm, function(data) 
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

}
   Number.prototype.round = function(places) {
  return +(Math.round(this + "e+" + places)  + "e-" + places);
}
function get_prc()
{
var prnm=document.getElementById('prnm').value;	
var unit=document.getElementById('unit').value;	
var cust_typ=document.getElementById('cust_typ').value;	

$("#getp").load("getp.php?prnm="+prnm+'&unit='+unit+'&cust_typ='+cust_typ).fadeIn('fast');	

}
function get_betno()
{
prnm=document.getElementById('prnm').value;	
bcd=document.getElementById('bcd').value;	
betnoo=document.getElementById('betnoo').value;	
$("#g_betno").load("get_betno.php?prnm="+prnm+'&bcd='+bcd+'&betnoo='+betnoo).fadeIn('fast');	
}
function check()
{
if (confirm("Are Sure To Return ?")) 
{	
document.forms["form1"].submit();
} 
}
</script>
</head>
<body onload="temp()" >
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side strech">
                <!-- Content Header (Page header) -->
              

                <!-- Main content -->
                <section class="content">
                   
<form method="post" target="" name="form1" id="form1"  action="sale_retns.php">
<input type="hidden"  class="form-control" name="blno" id="blno" value="<?php  echo $blno;?>">
 <input type="hidden" id="chk" readonly="true" name="chk" value="0" >
 <input type="hidden" class="form-control" value="<?php  echo $bsl;?>"  tabindex="1"  name="bill_typ" id="bill_typ" >  

 <div class="box box-success" >
<b>Invoice Details : </b>
  <center>
 <table border="0" width="860px" class="table table-hover table-striped table-bordered">
  <tr>
  <td align="left" style="padding-top:15px;" width="35%"><b>Customer Name :</b>
	<select id="custnm" name="custnm" tabindex="1"  class="form-control"  onchange="gtid()" >
	<?php 
		$query="select * from main_cust WHERE sl='$cid' order by nm";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
			$typ1=$rw['typ'];
			$ctyp1="";
			$p=mysqli_query($conn,"select * from main_cus_typ where sl='$typ1'") or die (mysqli_error($conn));
			while($rw2=mysqli_fetch_array($p))
		{
			$ctyp1=$rw2['tp'];
		}
		?>
		<option value="<?php  echo $rw['sl'];?>" <?php if($cid==$rw['sl']){?> selected <?php  } ?>><?php  echo $rw['nm'];?> <?php if($rw['cont']!=""){?>( <?php  echo $rw['cont'];?> )<?php }?> <?php  echo $ctyp1;?></option>
		<?php 
		}
	?>
	</select>

  </td>
	<td align="right" style="padding-top:15px;display:none;" ><b>Contact No. :</b></td>
	<td style="display:none;">
	<input type="text" id="mob" class="form-control" style="font-weight: bold;" readonly="true" name="mob" value=""  tabindex="2" size="35" placeholder="Customer Contact No.">
	</td>
	
	<td align="left" style="padding-top:15px;" width="35%" ><b>Shipped To : </b>
	<select id="invto" name="invto" tabindex="1"  class="form-control"   >
	<?php 
	$query="select * from main_cust WHERE sl='$invto' order by nm";
	$result=mysqli_query($conn,$query);
	while($rw=mysqli_fetch_array($result))
	{
	$typ1=$rw['typ'];				
	?>
	<option value="<?php  echo $rw['sl'];?>" <?php if($rw['sl']==$invto){?> selected <?php  } ?>><?php  echo $rw['nm'];?> <?php if($rw['cont']!=""){?>( <?php  echo $rw['cont'];?> )<?php }?> </option>
	<?php 
	}
	?>
	</select>
	<input type="hidden"  class="form-control" style="font-weight: bold;" id="addr" readonly="true" name="addr" value="" tabindex="3" placeholder="Customer Address">
	</td>
	
	
	<td align="left" style="padding-top:15px;display:none;" width="35%" ><b>Address : </b> 
	<input type="text"  class="form-control" style="font-weight: bold;" id="addr" readonly="true" name="addr" value="<?php  echo $caddr;?>" tabindex="3" placeholder="Customer Address">
	</td>
	<td align="left" style="padding-top:15px"><b>Branch : </b>
	<select name="brncd" class="form-control" tabindex="5" size="1" id="brncd" >
	<?php 
	if($user_current_level<0)
	{
	$query="Select * from main_branch where sl='$brncd'";
	}
	else
	{
	$query="Select * from main_branch where sl='$brncd'";
	}
	   $result = mysqli_query($conn,$query);
	while ($R = mysqli_fetch_array ($result))
	{
	$sl=$R['sl'];
	$bnm=$R['bnm'];

	?>
	<option value="<?php  echo $sl;?>"  <?php if($brncd==$sl){?> selected <?php  } ?>><?php  echo $bnm;?></option>
	<?php 
	}
	?>
	</select>
	</td>
	
</tr>
<tr style="display:none;">

   <td align="right" style="padding-top:15px;"><b>E-Mail :</b></td>

	<td colspan="">
	<input type="text" id="mail" class="form-control" style="font-weight: bold;" readonly="true" name="mail" value="" tabindex="4" size="35" placeholder="Customer E-Mail">
	</td>
</tr>

<tr style="display:none;">
<td align="right" style="padding-top:15px;"> <b>From State : </b></td>
	<td>
	<div id="fst_div">
	<select id="fst" data-placeholder="Choose Your Supplier" name="fst"  tabindex="7" class="form-control" onchange="get_gst()" >

	<?php 
	$sql="SELECT * FROM main_state WHERE sl>0 ORDER BY sn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($result))
	{
	?>
	<option value="<?php  echo $row['sl'];?>"<?php if($fst==$row['sl']){?> selected <?php  } ?>><?php  echo $row['sn'];?> - <?php  echo $row['cd'];?></option>
	<?php }?>
	</select>
	</div>
	</td>
	<td align="right" style="padding-top:15px;"> <b>To State : </b></td>
	<td>
	<div id="tst_div">
	<select id="tst" data-placeholder="Choose Your Supplier" name="tst"  tabindex="8" class="form-control" onchange="get_gst()"  >

	<?php 
	$sql="SELECT * FROM main_state WHERE sl>0 ORDER BY sn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($result))
	{
	?>
	<option value="<?php  echo $row['sl'];?>"<?php if($tst==$row['sl']){?> selected <?php  } ?>><?php  echo $row['sn'];?> - <?php  echo $row['cd'];?></option>
	<?php }?>
	</select>
	</div>
	</td>
</tr>
<tr>
	<td align="left" style="padding-top:15px;"> <b>Date : </b>
	<input type="text" class="form-control" readonly id="dt"  name="dt" value="<?php  echo $dt;?>" tabindex="6" size="35" placeholder="Enter Date">
	</td>
	<td align="left" style="padding-top:15px;"> <b>Bill Type : </b>
	<select id="cust_typ" name="cust_typ" class="form-control" onchange="get_prc()" tabindex="7">
	<?php 
	$p=mysqli_query($conn,"select * from main_cus_typ where sl='$cust_typ'") or die (mysqli_error($conn));
	while($rw2=mysqli_fetch_array($p))
	{
	?>
	<option value="<?php  echo $rw2['sl'];?>" <?php if($cust_typ==$rw2['sl']){echo 'selected';}?>><?php  echo $rw2['tp'];?></option>
	<?php 
	}
	?>
	</select>
	</td>
	<td align="left" style="padding-top:15px;"><b>Transportation Mode : </b>
	<input type="text"  class="form-control" style="font-weight: bold;" id="tmod" name="tmod" value="<?php  echo $tmod;?>" readonly tabindex="9" >
	</td>
</tr>
<tr>
	<td align="left" style="padding-top:15px;"><b>Place Of Supply :</b>
	<input type="text" id="psup" class="form-control" style="font-weight: bold;" name="psup" value="<?php  echo $psup;?>" readonly tabindex="10" size="35" >
	</td>
	<td align="left" style="padding-top:15px;"><b>Vehicle Number : </b>
	<input type="text"  class="form-control" style="font-weight: bold;" id="vno" name="vno" value="<?php  echo $vno;?>" readonly tabindex="11" >
	</td>
	<td align="left" style="padding-top:15px;"><b>Last Payment Days</b>
	<input type="text"  class="form-control" style="font-weight: bold;" id="lpd" name="lpd" value="<?php  echo $lpd;?>" readonly tabindex="12" >
	</td>
</tr>
<tr>
	<td align="left" style="padding-top:15px;"><b>No. of Service : </b>
	<input type="text"  class="form-control" style="font-weight: bold;" id="no_servc" name="no_servc" value="<?php  echo $no_servc;?>" readonly tabindex="11" >
	</td>
	<td align="left" style="padding-top:15px;"><b>Month Duration</b>
	<input type="text"  onkeypress="return isNumber(event)" maxlength="4"  value="<?php  echo $dur_mnth;?>" readonly id="dur_mnth" name="dur_mnth" class="form-control" style="font-weight: bold;">
	</td>
	<td align="left" style="padding-top:15px;" width="35%"><b>Sales Person :</b>
	<select id="sale_per" name="sale_per" tabindex="1"  class="form-control">
	<?php 
		$queryss="select * from main_sale_per where spid='$sale_per' order by spid";
		$resultss=mysqli_query($conn,$queryss);
		while($rwss=mysqli_fetch_array($resultss))
		{
			$spid=$rwss['spid'];
			$spnm=$rwss['nm'];
		?>
			<option value="<?php  echo $spid;?>" <?php if($spid==$sale_per){?> selected <?php  } ?>><?php  echo $spnm;?> <?php if($rwss['mob']!=""){?>( <?php  echo $rwss['mob'];?> )<?php }?></option>
			<?php 
		}
	?>
	</select>

  </td>
</tr>


</table>
</div>

<div class="box box-success"><b>Model Details :</b>
<table width="800px" class="table table-hover table-striped table-bordered">
	   <tr>
	   <td  colspan="19">
<table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td  align="left" width="11%"><b>Model</b></td>
<td  align="left" width="6%"><b>Godown</b></td>
<td align="center" width="10%"><b>Serial No.</b></td>
<td  align="center" width="5%"><b>Unit</b></td>
<td align="center" width="6%"><b>Stock In Hand</b></td>
<td align="center" width="7%" ><b>Quantity</b></td>
<td align="center" width="4%" ><b>Sale Rate</b></td>
<td align="center" width="6%"><b>Total</b></td>
<td align="center" width="4%"><b>Dis.%</b></td>
<td align="center" width="5%"><b>Dis. Am.</b></td>
<td align="center" width="5%"><b>Taxable Val.</b></td>
<td align="center" width="3%"><B>C-GST%</B></td>
<td align="center" width="5%"><B>C-GST Am.</B></td>
<td align="center" width="3%"><B>S-GST%</B></td>
<td align="center" width="5%"><B>S-GST Am.</B></td>
<td align="center" width="3%"><B>I-GST%</B></td>
<td align="center" width="5%"><B>I-GST Am.</B></td>
<td align="center" width="7%" ><b>Net Amount</b></td>
</tr>

</table>
   </td>
	   </tr>
	       <tr height="180px">
	   <td colspan="7">
	<div id="wb_Text13" >

		</div>
	  	</td>
	   </tr>


<tr>
<input type="hidden" name="dis" id="dis"  readOnly onblur="v()" value=""  tabindex="31" class="form-control"  style="text-align:right">
<input type="hidden" name="car" id="car"  readOnly onblur="v()" value=""  tabindex="32" class="form-control"  style="text-align:right">
<input type="hidden" name="vat" id="vat" onblur="v()" readOnly class="form-control"  tabindex="33" style="text-align:right" >
<input type="hidden" name="vatamm" id="vatamm" class="form-control"  tabindex="34" style="background-color:#f3f4f5;text-align:right" readonly="true" >
<td align="left" ><b>Bill Amount :</b><br>
<font >
<b>
<div id="billamm">
<input type="text" name="tamm" id="tamm" class="form-control" value="<?php  echo $tamm;?>"  tabindex="35" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 
</div>
</b>
</font>
</td>
<td align="left" ><b>Tax Amount : GST :</b><br>
<div id="gst_am">
<input type="text" name="gst" id="gst"  readOnly  value="<?php  echo $gstam;?>"   tabindex="36" class="form-control"  style="text-align:right">
</div>
</td>
<td align="left" hidden><b>Previous Balance :</b><br>
<font>
<b>
<input type="text" name="pbal" id="pbal" class="form-control"  tabindex="37" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 
</b>
</font>
</td>
<td align="left" ><b>Pay Amount :</b><br>
<font>
<b>
<input type="text" name="pay" id="pay" class="form-control" value="<?php  echo $payam;?>" tabindex="38" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 
</b>
</font>
</td>
</tr>
</table>
</div>

<div class="box box-success" >
<b>Payment Details :</b>
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="left" >
<font color="red">*</font><b>Cash Or Bank Ac. :</b>
<select  name="dldgr" id="dldgr"   class="form-control"  tabindex="39">
<?php  
$get = mysqli_query($conn,"SELECT * FROM main_ledg where sl='$dldgr'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?php  echo $row['sl']?>"<?php  echo $row['sl'] == $dldgr ? 'selected' : '' ?>><?php  echo $row['nm']?></option>
<?php  
} 
?>
</select>
</td>

<td><b>Payment Mode: </b>
<select name="mdt" size="1" id="mdt" tabindex="40" onchange="pmod(this.value)" class="form-control">
<?php 
$data2 = mysqli_query($conn,"select * from ac_paymtd where sl='$crdtp' ");

while ($row2 = mysqli_fetch_array($data2))
{
$mtd = $row2['mtd'];
$msl = $row2['sl'];
?>
<option value="<?php  echo $msl;?>"<?php  echo $msl == $crdtp ? 'selected' : '' ?>><?php  echo $mtd;?></option>
<?php  
}
?>
</select>
</td>
<td><b>Payment Amount:</b> 
<input type="text" class="form-control" id="pamm" name="pamm" value="<?php  echo $paid;?>" readonly  tabindex="41" placeholder ="Enter Payment Amount" style="text-align:right" size="25">
</td>
</tr>

<tr id="gtdl1" style="display:none">
<td>
<b>Reference No: </b>
<input type="text" class="form-control" id="crfno"  name="crfno" value="<?php  echo $crfno;?>" readonly  tabindex="42" value="" >
</td>
<td>
<b>Date: </b>
<input type="text" class="form-control" id="idt" name="idt" value="<?php  echo $idt;?>"  tabindex="43" readonly >
</td>

<td>
<b>Issued By:</b>
<input type="text" class="form-control" id="cbnm"  name="cbnm" value="<?php  echo $cbnm;?>" readonly tabindex="44" >
</td>
</tr>

<tr >
<td align="left" colspan="3" style="background-color:#f1f19b;"><font color="black" size="4"><b>Finance Details : -</b></font></td>
</tr>

<tr>
<td><b>Ref / SF No.:</b> 
<input type="text" class="form-control" id="sfno" name="sfno" value="<?php  echo $sfno;?>" readonly>
</td>
<td><b>Down payment:</b> 
<input type="text" class="form-control" id="dpay" name="dpay" value="<?php  echo $dpay;?>" readonly tabindex="41" style="text-align:right;" size="25">
</td>
<td><b>Finance Amount :</b> 
<input type="text" class="form-control" id="finam" name="finam" value="<?php  echo $finam;?>" readonly tabindex="41" style="text-align:right;" size="25">
</td>

</tr>
<tr>
<td><b>EMI Amount.:</b> 
<input type="text" class="form-control" id="emiam" name="emiam" value="<?php  echo $emiam;?>" readonly tabindex="41" style="text-align:right;" size="25">
</td>
<td><b>EMI Month:</b> 
<input type="text" class="form-control" id="emi_mnth" name="emi_mnth" value="<?php  echo $emi_mnth;?>" readonly>
</td>

<td colspan="" align="right"><br>
<input type="button" class="btn btn-success btn-sm" id="Button2" onclick="check()" name="bt1" tabindex="45" value="Submit"  >
</td>
</tr>
</table>

<input type="hidden" id="prid"  name="prid" value="<?php  echo $cid;?>">
<input type="hidden" id="stk" >
<input type="hidden" id="fls" >
</form>






</div>
                                <div class="box-footer clearfix no-border">
                                
                                </div>
<div id="adpnm"></div>
	<!-- Light Box -->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true"  >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="cnt1">
			</div>
        </div>
    </div>
</div>
<!-- End -->		
								
								
               
							
							
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

$('#prnm').chosen({no_results_text: "Oops, nothing found!",});	
$('#custnm').chosen({no_results_text: "Oops, nothing found!",});
$('#fst').chosen({no_results_text: "Oops, nothing found!",}); 
$('#tst').chosen({no_results_text: "Oops, nothing found!",});
$('#bcd').chosen({no_results_text: "Oops, nothing found!",});
$('#sale_per').chosen({no_results_text: "Oops, nothing found!",});
$('#invto').chosen({no_results_text: "Oops, nothing found!",});
</script>
<script>
function get_data(tsl,bcd,prsl,betno,unit,refno,pcs,prc,total,disp,disa,ttl,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,net_am)
{ 
		document.getElementById('tsl').value=tsl;
		document.getElementById('prnm').value=prsl;
		//$('#prnm').trigger("chosen:updated");
		$("#prnm").attr("disabled","disabled").trigger('chosen:updated');
		document.getElementById('bcd').value=bcd;		
		//$('#bcd').trigger("chosen:updated");
		$("#bcd").attr("disabled","disabled").trigger('chosen:updated');		
		document.getElementById('betnoo').value=betno;
		document.getElementById('unit_nm').value=unit;
		document.getElementById('reffno').value=refno;
		$('#g_betno').html('<input type="text" class="sc" value="'+betno+'" autocomplete="off" id="betno" name="betno" style="text-align:left;"  value="" tabindex="15" size="15">');
		document.getElementById('pcs').value=pcs;
		document.getElementById('pcs').readOnly = true;
		document.getElementById('prc').value=prc;
		//document.getElementById('prc').readOnly = true;
		document.getElementById('total').value=total;
		document.getElementById('total').readOnly = true;
		document.getElementById('disp').value=disp;
		document.getElementById('disp').readOnly = true;
		document.getElementById('disa').value=disa;
		document.getElementById('disa').readOnly = true;
		document.getElementById('lttl').value=ttl;
		document.getElementById('lttl').readOnly = true;
		document.getElementById('cgst_rt').value=cgst_rt;
		document.getElementById('cgst_rt').readOnly = true;
		document.getElementById('cgst_am').value=cgst_am;
		document.getElementById('cgst_am').readOnly = true;
		document.getElementById('sgst_rt').value=sgst_rt;
		document.getElementById('sgst_rt').readOnly = true;
		document.getElementById('sgst_am').value=sgst_am;
		document.getElementById('sgst_am').readOnly = true;
		document.getElementById('igst_rt').readOnly = true;
		document.getElementById('igst_am').value=igst_am;
		document.getElementById('igst_am').readOnly = true;
		document.getElementById('net_amm').value=net_am;
		document.getElementById('net_amm').readOnly = true;
		

		
$('.upd').html('<input type="button" value="Update" onclick="add1()" style="padding:2px;width:100%" class="btn btn-warning">');
//get_betno();
gtt_unt();

get_stock();

}
</script>
    </body>

</html>