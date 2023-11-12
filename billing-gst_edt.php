<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$blno=$_REQUEST['blno'];
$data1= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$dt=$row1['dt'];
$edt1=$row1['edt'];
$vat=$row1['vat'];
$vatamm=$row1['vatamm'];
$car=$row1['car'];
$sid=$row1['cid'];
$pdts=$row1['pdts'];
$dis=$row1['dis'];
$paid=$row1['paid'];
$fst=$row1['fst'];
$tst=$row1['tst'];
$tmod=$row1['tmod'];
$psup=$row1['psup'];
$vno=$row1['vno'];
}
$dt=date('d-m-Y', strtotime($dt));
$datad= mysqli_query($conn,"select * from main_cust where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nm=$rowd['nm'];
$mob1=$rowd['cont'];
$addr=$rowd['addr'];
$mail=$rowd['mail'];
}
?>
<html>
        <div class="wrapper row-offcanvas row-offcanvas-left" >
            <?
            include "left_bar.php";
            ?>
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
      $("#dt").datepicker(jQueryDatePicker2Opts);
	$("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
		  	   $("#idt").datepicker(jQueryDatePicker2Opts);
	  $("#idt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
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
function getb()
{
prnm=document.getElementById('prnm').value;
brncd=document.getElementById('brncd').value;
$("#gbet").load("getbe.php?pcd="+prnm+"&brncd="+brncd).fadeIn('fast');
}

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
		var car= parseFloat(document.form1.car.value);if(document.form1.car.value==""){car=0;}
		var vat= parseFloat(document.form1.vat.value);if(document.form1.vat.value==""){vat=0;}
		var tam= parseFloat(document.form1.tamm1.value);if(document.form1.tamm1.value==""){tam=0;}
		var dis= parseFloat(document.form1.dis.value);if(document.form1.dis.value==""){dis=0;}
		
		vatt=(tam*vat)/100;
		document.getElementById('vatamm').value=vatt;
		tt=((tam+vatt)-dis)+car;
		
		document.getElementById('pay').value=Math.round(tt+pbal);
		
		
	}
	

	
	
function cal2()
{

var adp=parseFloat(document.getElementById('adp').value);
if(document.getElementById('adp').value==""){adp=0;}	

var srt=parseFloat(document.getElementById('srt').value);	
if(document.getElementById('srt').value==""){srt=0;}	


mrp1=((srt*adp)/100).round(4);

prc=(parseFloat(srt+mrp1)).round(4);
if(prc==''){prc=0;}
	
 $('#prc').val(prc);	
cal(); 
}	
	
function cal()
{
var cgst_rt=document.getElementById('cgst_rt').value;if(cgst_rt==''){cgst_rt=0;}
var sgst_rt=document.getElementById('sgst_rt').value;if(sgst_rt==''){sgst_rt=0;}
var igst_rt=document.getElementById('igst_rt').value;if(igst_rt==''){igst_rt=0;}
var sgst=0;
var cgst=0;
var igst=0;
var lttl=0;


/*
var adp=document.getElementById('adp').value;
if(adp==''){adp=0;}	
var srt=document.getElementById('srt').value;	
if(srt==''){srt=0;}



mrp1=srt*adp/100;

prc=srt-mrp1;
if(prc==''){prc=0;}

*/



var prc=document.getElementById('prc').value;	
if(prc==''){prc=0;}




var kg=document.getElementById('kg').value;	
if(kg==''){kg=0;}
var grm=document.getElementById('grm').value;
if(grm==''){grm=0;}	
var pcs=document.getElementById('pcs').value;	
if(pcs==''){pcs=0;}	
var scat_unit=document.getElementById('scat_unit').value;	
if(scat_unit=='1')
{
var qty=kg+'.'+grm;
document.getElementById('lttl').value=(qty*prc).toFixed(2);
lttl=(qty*prc);
}
else if(scat_unit=='2' || scat_unit=='3')
{
document.getElementById('lttl').value=(pcs*prc).toFixed(2);	
lttl=(pcs*prc).round(2);
}

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
	document.getElementById('sgst_am').value=sgst.toFixed(2);
	document.getElementById('cgst_am').value=cgst.toFixed(2);
	document.getElementById('igst_am').value=igst.toFixed(2);
	net_amm=sgst+cgst+igst+lttl;
	document.getElementById('net_amm').value=net_amm.toFixed(2);	

}

 function get_cat()  
 {
cat=document.getElementById('cat').value;
scat=document.getElementById('scat').value;
$("#scat_div").load("get_cat_pur.php?cat="+cat).fadeIn('fast');
$("#prod_div").load("get_product_bill.php?cat="+cat+"&scat="+scat).fadeIn('fast');

 }
 function get_prod()
 {
cat=document.getElementById('cat').value;
scat=document.getElementById('scat').value;	 
$("#prod_div").load("get_product_bill.php?cat="+cat+"&scat="+scat).fadeIn('fast');	
get_stock();


 }
function get_stock()
{
blno=document.getElementById('blno').value;
tsl=document.getElementById('tsl').value;
prnm=document.getElementById('prnm').value;
scat=document.getElementById('scat').value;
brncd=document.getElementById('brncd').value;
brncd=document.getElementById('brncd').value;
adp=document.getElementById('adp').value;

$("#gbet").load("getbe_edt.php?pcd="+prnm+"&brncd="+brncd+"&scat="+scat+'&blno='+blno+'&tsl='+tsl).fadeIn('fast');
}
function get_unit()
{
scat_unit=document.getElementById('scat_unit').value;
if(scat_unit=='1')	
{
document.getElementById("grm").readOnly = false;
document.getElementById("kg").readOnly = false;
document.getElementById("pcs").readOnly = true;
document.getElementById('pcs').value='';
}
else if(scat_unit=='2' || scat_unit=='3')
{
document.getElementById("grm").readOnly = true;
document.getElementById("kg").readOnly = true;	
document.getElementById('kg').value='';
document.getElementById('grm').value='';
document.getElementById("pcs").readOnly = false;	
}
}

	function add1()
	{
		
		var scat=document.getElementById('scat').value;
		var prnm=document.getElementById('prnm').value;
		var kg=document.getElementById('kg').value;
		var grm=document.getElementById('grm').value;
		var pcs=document.getElementById('pcs').value;
		var prc=document.getElementById('prc').value;
		var lttl=document.getElementById('lttl').value;
		var brncd=document.getElementById('brncd').value;
		var refno=document.getElementById('refno').value;
		 fst=document.getElementById('fst').value;
		 tst=document.getElementById('tst').value;
		 cgst_rt=document.getElementById('cgst_rt').value;
		 sgst_rt=document.getElementById('sgst_rt').value;
		 igst_rt=document.getElementById('igst_rt').value;
		 cgst_am=document.getElementById('cgst_am').value;
		 sgst_am=document.getElementById('sgst_am').value;
		 igst_am=document.getElementById('igst_am').value;
		 
		var adp=document.getElementById('adp').value;if(adp==''){adp=0;}	
		var srt=document.getElementById('srt').value;if(srt==''){srt=0;}
		if(scat=='')
		{
		alert("Sub-Category Can't be blank");
		}
		else if(refno=='')
		{
		alert("Purchase Invoice Can't be blank");
		}
		else if(prnm=='')
		{
		alert("Product Can't be blank");
		}
		else if(lttl=='')
		{
		alert("Amount Can't be blank");	
		}
		else
		{
		
	$('#wb_Text13').load('adtmppr.php?scat='+scat+'&prnm='+prnm+'&kg='+kg+'&grm='+grm+'&pcs='+pcs+'&prc='+prc+'&srt='+srt+'&adp='+adp+'&lttl='+lttl+'&brncd='+brncd+'&fst='+fst+'&tst='+tst+'&cgst_rt='+cgst_rt+'&sgst_rt='+sgst_rt+'&igst_rt='+igst_rt+'&cgst_am='+cgst_am+'&sgst_am='+sgst_am+'&igst_am='+igst_am+'&refno='+refno).fadeIn('fast');
		}
	/*	function reset()
	{
		*/
		
		
	}
	function reset()
	{
		document.getElementById('cat').value='';
		$('#cat').trigger('chosen:updated');
		document.getElementById('scat').value='';
		$('#scat').trigger('chosen:updated');
		document.getElementById('prnm').value='';
		$('#prnm').trigger('chosen:updated');	
		document.getElementById('kg').value='';
		document.getElementById('grm').value='';
		document.getElementById('pcs').value='';
		document.getElementById('prc').value='';
		document.getElementById('lttl').value='';
		document.getElementById('cgst_rt').value='';
		document.getElementById('sgst_rt').value='';
		document.getElementById('igst_rt').value='';
		document.getElementById('cgst_am').value='';
		document.getElementById('sgst_am').value='';
		document.getElementById('igst_am').value='';
		document.getElementById('net_amm').value='';
		document.getElementById('srt').value='';
		document.getElementById('adp').value='0';
		$('#refno option').each(function() {
        $(this).remove();
}); 
	}
	
function temp()
{
 blno=document.getElementById('blno').value;	
$('#wb_Text13').load("tmppr_gst_edt.php?blno="+blno).fadeIn('fast');
$('#fst_div').load("fst_get1.php?blno="+blno).fadeIn('fast');
$('#tst_div').load("tst_get1.php?blno="+blno).fadeIn('fast');
}
function deltpr(un,sl)
{
$('#wb_Text13').load("deltpr.php?sl="+sl+"&tsl="+un).fadeIn('fast');
}
function t()
	{
 blno=document.getElementById('blno').value;	
	$('#billamm').load('stotal-gst_edt.php?blno='+blno).fadeIn('fast');
	$('#gst_am').load('gst_am_edt.php?blno='+blno).fadeIn('fast');

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
cat=document.getElementById('cat').value;
scat=document.getElementById('scat').value;	
dt=document.getElementById('dt').value;	
var fst=document.getElementById('fst').value;	
var tst=document.getElementById('tst').value;

$.get('get_gst.php?cat='+cat+'&scat='+scat+'&dt='+dt, function(data) 
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
refno=document.getElementById('refno').value;	
scat=document.getElementById('scat').value;	
$("#p").load("getp.php?refno="+refno+'&scat='+scat).fadeIn('fast');	
}
function get_data(cat,scat,prsl,refno,kg,grm,pcs,adp,prc,ttl,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,net_am,blno,tsl)
{
			document.getElementById('cat').value=cat;
		$('#cat').trigger('chosen:updated');
		document.getElementById('scat').value=scat;
		$('#scat').trigger('chosen:updated');
		document.getElementById('prnm').value=prsl;
		$('#prnm').trigger('chosen:updated');	
		document.getElementById('kg').value=kg;
		document.getElementById('grm').value=grm;
		document.getElementById('pcs').value=pcs;
		document.getElementById('adp').value=adp;
		document.getElementById('prc').value=prc;
		document.getElementById('lttl').value=ttl;
		document.getElementById('cgst_rt').value=cgst_rt;
		document.getElementById('sgst_rt').value=sgst_rt;
		document.getElementById('igst_rt').value=igst_rt;
		document.getElementById('cgst_am').value=cgst_am;
		document.getElementById('sgst_am').value=sgst_am;
		document.getElementById('igst_am').value=igst_am;
		document.getElementById('net_amm').value=net_amm;
		document.getElementById('tsl').value=tsl;
		$('.upb').html('<input type="button" value="Update" onclick="update()" style="padding:2px;width:100%" class="btn btn-primary">');

get_stock();
}
function update()
{
		var scat=document.getElementById('scat').value;
		var prnm=document.getElementById('prnm').value;
		var kg=document.getElementById('kg').value;
		var grm=document.getElementById('grm').value;
		var pcs=document.getElementById('pcs').value;
		var prc=document.getElementById('prc').value;
		var lttl=document.getElementById('lttl').value;
		var brncd=document.getElementById('brncd').value;
		var refno=document.getElementById('refno').value;
		 fst=document.getElementById('fst').value;
		 tst=document.getElementById('tst').value;
		 cgst_rt=document.getElementById('cgst_rt').value;
		 sgst_rt=document.getElementById('sgst_rt').value;
		 igst_rt=document.getElementById('igst_rt').value;
		 cgst_am=document.getElementById('cgst_am').value;
		 sgst_am=document.getElementById('sgst_am').value;
		 igst_am=document.getElementById('igst_am').value;
		 tsl=document.getElementById('tsl').value;
		 blno=document.getElementById('blno').value;
		 
		var adp=document.getElementById('adp').value;if(adp==''){adp=0;}	
		var srt=document.getElementById('srt').value;if(srt==''){srt=0;}
		if(scat=='')
		{
		alert("Sub-Category Can't be blank");
		}
		else if(refno=='')
		{
		alert("Purchase Invoice Can't be blank");
		}
		else if(prnm=='')
		{
		alert("Product Can't be blank");
		}
		else if(lttl=='')
		{
		alert("Amount Can't be blank");	
		}
		else
		{
		
	$('#wb_Text13').load('update.php?scat='+scat+'&prnm='+prnm+'&kg='+kg+'&grm='+grm+'&pcs='+pcs+'&prc='+prc+'&srt='+srt+'&adp='+adp+'&lttl='+lttl+'&brncd='+brncd+'&fst='+fst+'&tst='+tst+'&cgst_rt='+cgst_rt+'&sgst_rt='+sgst_rt+'&igst_rt='+igst_rt+'&cgst_am='+cgst_am+'&sgst_am='+sgst_am+'&igst_am='+igst_am+'&refno='+refno+'&tsl='+tsl+'&blno='+blno).fadeIn('fast');
		}	
}
</script>
</head>
<body>
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
              

                <!-- Main content -->
                <section class="content">
                   

                   

                    <!-- Main row -->
                    
                        <!-- Left col -->
                       
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        
                           

                            <!-- Chat box -->
					
                     <!-- /.box (chat box) -->

                            <!-- TO DO List -->
                          
<form method="post" target="" name="form1" id="form1"  action="billings_edt_gst.php">
                              
							
								
 <input type="hidden" id="blno" name="blno" value="<?=$blno;?>" tabindex="3">
 <input type="hidden" id="tsl" name="tsl" value="<?=$blno;?>" tabindex="3">
 

<div class="box box-success" >
<b>Invoice Details : </b>
<center>
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="right" style="padding-top:15px;" width="15%"><b>Customer Name :</b>
</td>
<td colspan="" width="35%"> 



<select id="custnm" name="custnm" tabindex="1"  class="form-control"  onchange="gtid()" >
<option value="">---Select---</option>
<option value="Add">---Add New Customer---</option>
<?
$query="select * from main_cust  WHERE sl>0 order by nm";
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
<option value="<?=$rw['sl'];?>"<?if($sid==$rw['sl']){echo 'selected';}?>><?=$rw['nm'];?> <?if($rw['cont']!=""){?>( <?=$rw['cont'];?> )<?}?> <?=$ctyp1;?></option>
<?
}
?>
</select>
</td>
<td align="right" style="padding-top:15px;" width="13%"><b>Contact No. :</b></td>
<td width="37%" >
<input type="text" id="mob" class="form-control" style="font-weight: bold;" readonly="true" name="mob" value="<?=$mob1;?>"  tabindex="2" size="35" placeholder="Customer Contact No.">
</td>
</tr>
<tr>
<td align="right" style="padding-top:15px;"><b>Address : </b></td>
<td>
<input type="text"  class="form-control" style="font-weight: bold;" id="addr" readonly="true" name="addr" value="<?=$addr;?>" tabindex="3" placeholder="Customer Address">
</td>
<td align="right" style="padding-top:15px;"><b>E-Mail :</b></td>
<td colspan="">
<input type="text" id="mail" class="form-control" style="font-weight: bold;" readonly="true" name="mail" value="<?=$mail;?>" tabindex="4" size="35" placeholder="Customer E-Mail">
</td>
</tr>
<tr>
<td align="right" style="padding-top:15px;"> <b>Date : </b></td>
<td>
<input type="text" class="form-control"  id="dt"  name="dt" value="<? echo $dt;?>" tabindex="6" size="35" placeholder="Enter Date">
</td>
<td align="right" style="padding-top:15px">
<b>Branch : </b>
</td>
<td align="left" >
<select name="brncd" class="form-control" tabindex="5" size="1" id="brncd" onchange="getb()"  >
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

</tr>
</table>
</div>
<?
/*

<input type="hidden" id="usl" name="usl" value="" >

 <div class="box box-success" >
 <b>Product Details :</b>
	  <table width="800px" class="table table-hover table-striped table-bordered">
	   <tr>
	   <td  colspan="7">
<table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td  align="left" width="7%"><b>Category</b></td>
<td  align="left" width="9%"><b>Sub-Category</b></td>
<td  align="left" width="11%"><b>Product</b></td>
<td align="center" width="8%"><b>Stock In Hand</b></td>
<td align="center" width="4%" ><b>Kg</b></td>
<td align="center" width="4%" ><b>Gram</b></td>
<td align="center" width="4%" ><b>Pcs</b></td>
<td align="center" width="4%" ><b>Add Per(%)</b></td>
<td align="center" width="5%" ><b>Sale Rate</b></td>
<td align="center" width="7%"><b>Taxable Val.</b></td>
<td width="4%" align="center"><B>C-GST Rt.%</B></td>
<td width="5%" align="center"><B>C-GST Am.</B></td>
<td width="4%" align="center"><B>S-GST Rt.%</B></td>
<td width="5%" align="center"><B>S-GST Am.</B></td>
<td width="4%" align="center"><B>I-GST Rt.%</B></td>
<td width="5%" align="center"><B>I-GST Am.</B></td>
<td align="center" width="6%" ><b>Amount</b></td>
<td align="center" width="4%"><b>Action</b></td>
</tr>
<tr>
<td > 
<select id="cat" name="cat" class="form-control"  tabindex="7" onchange="get_cat()">
<option value="">---Select---</option>
<?

$data1 = mysqli_query($conn,"Select * from main_catg order by cnm");

		while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$cnm=$row1['cnm'];
?>
<option value="<?=$sl;?>"><?=$cnm;?></option>
	<?}?>
</select>
</td>

<td> 
<div id="scat_div">
<select id="scat" name="scat" class="form-control"  tabindex="8" onchange="get_prod()">
<option value="">---Select---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_scat order by nm");

		while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$nm=$row1['nm'];
?>
<Option value="<?=$sl;?>"><?=$nm;?></option>
	<?}?>
</select>
</div>
</td>
<td>
<div id="prod_div">
<select id="prnm" name="prnm" class="form-control"  tabindex="9" onchange="get_stock()">
<option value="">---Select---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_product order by pnm");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
?>
<Option value="<?=$sl;?>"><?=$pnm;?></option>
<?}?>
</select>
</div>
</td>
<td>
<div id="gbet">
<input type="text" class="sc" autocomplete="off" id="sih" readonly name="sih" style="text-align:center"  value="" tabindex="10" size="15"  >
</div>
</td>
<td>
<input type="text" class="sc" autocomplete="off" id="kg" name="kg" readonly style="text-align:center" onblur="cal()"  value="" tabindex="11" size="15"  >
</td>
<td>
<input type="text" id="grm" class="sc" autocomplete="off"  name="grm" readonly value="" style="text-align:center" onblur="cal()" maxlength="3" tabindex="12" size="15" >
</td>
<td>
<input type="text" id="pcs" class="sc" autocomplete="off"  name="pcs" readonly value=""  style="text-align:center" onblur="cal()" tabindex="13"  >
</td>
<td> 
<input type="text" class="sc" id="adp"  name="adp" value="0"  style="text-align:center" onblur="cal2()" tabindex="14">
</td>
<td> 
<div id="p">
<input type="text" class="sc" id="prc"  name="prc" value=""  style="text-align:right" onblur="cal()" tabindex="14">
</div>
</td>
<td> 
<input type="text" class="sc" id="lttl"  name="lttl" value="" readonly="true"  style="text-align:right" tabindex="15">
</td>
<td align="center">
<input type="text" name="cgst_rt" id="cgst_rt" class="sc" tabindex="5" readOnly class="sc" onfocus="this.select();"  style="text-align:center">
</td>
<td  align="center">
<input type="text" name="cgst_am" id="cgst_am" class="sc" tabindex="5" class="sc" onfocus="this.select();"  style="text-align:right">
</td>
<td  align="center">
<input type="text" name="sgst_rt" id="sgst_rt" class="sc" tabindex="5" readOnly class="sc" onfocus="this.select();"  style="text-align:center">
</td>
<td  align="center">
<input type="text" name="sgst_am" id="sgst_am" class="sc" tabindex="5" class="sc" onfocus="this.select();"  style="text-align:right">
</td>
<td  align="center">
<input type="text" name="igst_rt" id="igst_rt" class="sc" tabindex="5" readOnly class="sc" onfocus="this.select();"  style="text-align:center">
</td>
<td align="center">
<input type="text" name="igst_am" id="igst_am" class="sc" readOnly tabindex="5" class="sc" onfocus="this.select();"  style="text-align:right">
</td>
<td>
<input type="text" class="sc" id="net_amm" name="net_amm" value="" tabindex="16" readonly  autocomplete="off"  style="text-align:right" size="15"  >
</td>
<td class="upb">
<input type="button" class="btn btn-primary" id="Button1" name="" value="Add"  onclick="add1()" tabindex="16" style="width:100%;padding:2px" >
</td>
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


<tr >


<input type="hidden" name="dis" id="dis"  readOnly onblur="v()" value=""  tabindex="17" class="form-control"  style="text-align:right">
<input type="hidden" name="car" id="car"  readOnly onblur="v()" value=""  tabindex="18" class="form-control"  style="text-align:right">
<input type="hidden" name="vat" id="vat" onblur="v()" readOnly class="form-control"  tabindex="19" style="text-align:right" >
<input type="hidden" name="vatamm" id="vatamm" class="form-control"  tabindex="20" style="background-color:#f3f4f5;text-align:right" readonly="true" >
<td align="left" ><b>Bill Amount :</b><br>
<font >
<b>
<div id="billamm">
<input type="text" name="tamm" id="tamm" class="form-control"  tabindex="21" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 
</div>
</b>
</font>
</td>
<td align="left" ><b>Tax Amount : GST :</b><br>
<div id="gst_am">
<input type="text" name="gst" id="gst"  readOnly  value=""  tabindex="17" class="form-control"  style="text-align:right">
</div>
</td>
<td align="left" ><b>Previou Balance :</b><br>
<font >
<b>

<input type="text" name="pbal" id="pbal" class="form-control"  tabindex="22" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 

</b>
</font>
</td>
<td align="left" ><b>Pay Amount :</b><br>
<font >
<b>

<input type="text" name="pay" id="pay" class="form-control"  tabindex="23" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 

</b>
</font>
</td>
</tr>

	   </table>
</div>
*/?>
 <div class="box box-success" >
  <table border="0" width="860px" class="table table-hover table-striped table-bordered">
 <tr class="odd" >
<td colspan="6" align="right">

<input type="submit" class="btn btn-success btn-sm" id="Button2" onclick="return confirm('Are Yoy Sure To Submit !'); " name="bt1" tabindex="30" value="Update"  >
</td>
</tr>
</table>

<input type="hidden" id="prid"  name="prid" value="<? echo $cid;?>">
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

 $('#prnm').chosen({
no_results_text: "Oops, nothing found!",
});	
$('#cat').chosen({
no_results_text: "Oops, nothing found!",
});		
$('#scat').chosen({
no_results_text: "Oops, nothing found!",
});	

     $('#custnm').chosen({
  no_results_text: "Oops, nothing found!",

  });
       $('#fst').chosen({
  no_results_text: "Oops, nothing found!",
   }); 
      $('#tst').chosen({
  no_results_text: "Oops, nothing found!",
   });
</script>

    </body>

</html>