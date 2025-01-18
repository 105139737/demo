<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
include "function.php";

$blno=$_REQUEST['blno'];
$data1= mysqli_query($conn,"select * from  main_quo where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$dt=$row1['dt'];
$edt1=$row1['edt'];
$nm=$row1['cust_nm'];
$cont=$row1['cont'];
$adrs=$row1['adrs'];
$dttm=$row1['dttm'];
$payam=$row1['payam'];
$gstin=$row1['gstin'];
$gstam=$row1['gstam'];
$bcd=$row1['bcd'];
$amm=$row1['amm'];
$dt=date('d-m-Y', strtotime($dt));

}

$result2 = mysqli_query($conn,"DELETE FROM main_quo_details_edt WHERE blno='$blno'");

$query214 = "insert into main_quo_details_edt (blno,total,disp,disa,cat,scat,prsl,description,bcd,pcs,prc,ttl,tamm,fst,tst,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,net_am,rate,eby)
select blno,total,disp,disa,cat,scat,prsl,description,bcd,pcs,prc,ttl,tamm,fst,tst,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,net_am,rate,'$user_currently_loged' from main_quo_details where blno = '$blno'";
$result214 = mysqli_query($conn,$query214)or die (mysqli_error($conn)); 

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
});

function isNumber(evt) 
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
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
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
	document.getElementById('sgst_am').value=sgst;
	document.getElementById('cgst_am').value=cgst;
	document.getElementById('igst_am').value=igst;
	
	document.getElementById('total').value=total1;	
	document.getElementById('disa').value=disa1;
	document.getElementById('lttl').value=lttl;
	document.getElementById('net_amm').value=lttl.round(2);	
	

}
	function add()
	{
		var blno=document.getElementById('blno').value;	
		var prnm=document.getElementById('prnm').value;
		var desc=document.getElementById('desc').value;
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
		var fst=document.getElementById('fst').value;
		var tst=document.getElementById('tst').value;
		var net_amm=document.getElementById('net_amm').value;
		var tsl=document.getElementById('tsl').value;
		if(prnm=='')
		{
		alert("Product Can't be blank");
		}
		else
		{
		$('#wb_Text13').load('quo_adtmppr_edt.php?prnm='+prnm+'&desc='+encodeURIComponent(desc)+'&pcs='+pcs+'&prc='+prc+'&total='+total+'&disp='+disp+'&disa='+disa+'&lttl='+lttl+'&brncd='+brncd+'&fst='+fst+'&tst='+tst+'&cgst_rt='+cgst_rt+'&sgst_rt='+sgst_rt+'&igst_rt='+igst_rt+'&cgst_am='+cgst_am+'&sgst_am='+sgst_am+'&igst_am='+igst_am+'&blno='+blno+'&tsl='+tsl).fadeIn('fast');
		}
	
		
	}
	function reset()
	{
		
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
		document.getElementById('desc').value='';
		
		

	}
	
function temp()
	{
var blno=document.getElementById('blno').value;	
		
$('#wb_Text13').load("quo_tmppr_edt.php?blno="+blno).fadeIn('fast');
/*$('#fst_div').load("fst_get1.php").fadeIn('fast');
$('#tst_div').load("tst_get1.php").fadeIn('fast');*/
}
function deltpr(sl)
{
$('#wb_Text13').load("quo_deltpr_edt.php?sl="+sl).fadeIn('fast');
}
function tot()
	{
	var blno=document.getElementById('blno').value;	
	$('#billamm').load('quo_stotal_edt.php?blno='+blno).fadeIn('fast');
	$('#gst_am').load('quo_gst_am_edt.php?blno='+blno).fadeIn('fast');
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


function check()
{	
cust_nm=document.getElementById('cust_nm').value;	
if(cust_nm=='')
{
alert('Please Enter Customer Name....');
}
else
{
if (confirm("Are Sure To Make Quotation ?")) 
{	
document.forms["form1"].submit();
} 
}
}

function get_prc()
{
var prnm=document.getElementById('prnm').value;	
$("#getp").load("quo_getp.php?prnm="+prnm).fadeIn('fast');	
$("#getd").load("quo_getd.php?prnm="+prnm).fadeIn('fast');
get_gstval();
}

function get_scat()  
{
var cat= document.getElementById('cat').value;
$("#scatdiv").load("quo_get_scat.php?cat="+cat).fadeIn('fast');
}

function get_prod()
{
var scat=document.getElementById('scat').value;
var cat=document.getElementById('cat').value;
$("#prod_div").load("quo_get_product.php?cat="+cat+"&scat="+scat).fadeIn('fast');	
} 
</script>
<script>
function get_data(tsl,bcd,prsl,unit,pcs,prc,total,disp,disa,ttl,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,net_am,cat,scat,pnm,desc)
{ 
		document.getElementById('tsl').value=tsl;
		$('#prnm').append('<option value="'+prsl+'">'+pnm+'</option>');
		document.getElementById('cat').value=cat;
		$('#cat').trigger("chosen:updated");
		document.getElementById('scat').value=scat;
		$('#scat').trigger("chosen:updated");	
		document.getElementById('prnm').value=prsl;
		$('#prnm').trigger("chosen:updated");
		document.getElementById('desc').value=desc;		
		document.getElementById('pcs').value=pcs;
		document.getElementById('prc').value=prc;
		document.getElementById('total').value=total;
		document.getElementById('disp').value=disp;
		document.getElementById('disa').value=disa;
		document.getElementById('lttl').value=ttl;
		document.getElementById('cgst_rt').value=cgst_rt;
		document.getElementById('cgst_am').value=cgst_am;
		document.getElementById('sgst_rt').value=sgst_rt;
		document.getElementById('sgst_am').value=sgst_am;
		document.getElementById('igst_rt').value=igst_rt;
		document.getElementById('igst_am').value=igst_am;
		document.getElementById('net_amm').value=net_am;
		
$('.upd').html('<input type="button" value="Update" onclick="add()" style="padding:2px;width:100%" class="btn btn-warning">');
}
</script>
</head>
<body onload="temp()">
<aside class="right-side strech">
<section class="content">
<form method="post" target="" name="form1" id="form1"  action="quotations_edt.php">
<input type="hidden" id="blno" name="blno" value="<?php  echo $blno;?>" >
<div class="box box-success" >
<b>Invoice Details : </b>
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="right" style="padding-top:15px;"><b><font color="red">*</font>Customer Name :</b></td>
<td colspan="">
<input type="text" id="cust_nm" class="form-control" style="font-weight: bold;" name="cust_nm" value="<?php  echo $nm;?>" tabindex="1" placeholder="Please Enter Customer Name" required>
</td>
<td align="right" style="padding-top:15px;"><b>Contact No. :</b></td>
<td colspan="">
<input type="text" id="cont" class="form-control" style="font-weight: bold;" name="cont" value="<?php  echo $cont;?>" tabindex="1" placeholder="Please Enter Contact No." onkeypress="return isNumber(event)" maxlength="10">
</td>
</tr>

<tr>
<td align="right" style="padding-top:15px;"><b>GSTIN No. :</b></td>
<td colspan="">
<input type="text" id="gstin" class="form-control" style="font-weight: bold;" name="gstin" value="<?php  echo $gstin;?>" tabindex="1" placeholder="Please Enter GSTIN No.">
</td>

<td align="right" style="padding-top:15px;"><b><font color="red">*</font>Address :</b></td>
<td colspan="">
<input type="text" id="adrs" class="form-control" style="font-weight: bold;" name="adrs" value="<?php  echo $adrs;?>" tabindex="1" placeholder="Please Enter Address" required>
</td>


</tr>
<tr>
<td align="right" style="padding-top:15px;"> <b>Date : </b>
<td>
<input type="text" class="form-control"  id="dt"  name="dt" value="<?php  echo $dt;?>" tabindex="1" placeholder="Enter Date">
</td>
<td align="right" style="padding-top:15px;"><b>Branch :</b></td>
	<td>
	<select name="brncd" class="form-control" tabindex="1" id="brncd"  >
	<?php 
	$query="Select * from main_branch order by sl";
	$result = mysqli_query($conn,$query);
	while ($R = mysqli_fetch_array ($result))
	{
	$bsl=$R['sl'];
	$bnm=$R['bnm'];

	?>
	<option value="<?php  echo $bsl;?>" <?php  if($bcd==$bsl){echo 'selected';}?>><?php  echo $bnm;?></option>
	<?php 
	}
	?>
	</select>
	</td>
	<td colspan="2"></td>
</tr>
<tr style="display:none;">
<td align="right" style="padding-top:15px;"> <b>From State : </b>

	<div id="fst_div">
	<select id="fst" data-placeholder="Choose Your Supplier" name="fst"  tabindex="1" class="form-control" onchange="get_gst()" >

	<?php 
	$sql="SELECT * FROM main_state WHERE sl>0 ORDER BY sn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($result))
	{
	?>
	<option value="<?php  echo $row['sl'];?>"<?php if($row['sl']=='1'){echo 'selected';}?>><?php  echo $row['sn'];?> - <?php  echo $row['cd'];?></option>
	<?php }?>
	</select>
	</div>
	</td>
	<td align="right" style="padding-top:15px;"> <b>To State : </b>
	<div id="tst_div">
	<select id="tst" data-placeholder="Choose Your Supplier" name="tst"  tabindex="1" class="form-control" onchange="get_gst()"  >

	<?php 
	$sql="SELECT * FROM main_state WHERE sl>0 ORDER BY sn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($result))
	{
	?>
	<option value="<?php  echo $row['sl'];?>"<?php if($row['sl']=='1'){echo 'selected';}?>><?php  echo $row['sn'];?> - <?php  echo $row['cd'];?></option>
	<?php }?>
	</select>
	</div>
	</td>
</tr>
</table>
</div>

<div class="box box-success"><b>Model Details :</b>
<table>
<tr>
<td>

<select name="cat" class="form-control" size="1" id="cat" tabindex="1" onchange="get_scat();get_prod()">
<Option value="">---Brand---</option>
<?php 
$data1 = mysqli_query($conn,"Select * from main_catg where stat='0' order by sl");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$cnm=$row1['cnm'];
echo "<option value='".$sl."'>".$cnm."</option>";
}
?>
</select>
</td>
<td>
<div id="scatdiv">
<select name="scat" class="form-control" size="1" id="scat" tabindex="1" onchange="get_prod()">
<Option value="">---Category---</option>
<?php 
$data2 = mysqli_query($conn,"Select * from main_scat where stat='0' order by sl");
while ($row2 = mysqli_fetch_array($data2))
{
$ssl=$row2['sl'];
$snm=$row2['nm'];
echo "<option value='".$ssl."'>".$snm."</option>";
}
?>
</select>
</div>
</td> 
</tr>
</table>
<input type="hidden" id="tsl" name="tsl" style="text-align:left" tabindex="1">
<table width="800px" class="table table-hover table-striped table-bordered">
<tr>
<td  colspan="16">
<table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td align="left" width="11%"><b>Model</b></td>
<td align="left" width="27%"><b>Description</b></td>
<td align="center" width="3%"><b>Quantity</b></td>
<td align="center" width="4%"><b>Sale Rate</b></td>
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
<td align="center" width="7%"><b>Net Amount</b></td>
<td align="center" width="4%"><b>Action</b></td>
</tr>
<tr>
<td>
<div id="prod_div">
<select id="prnm" name="prnm" class="form-control"  tabindex="1" onchange="get_prc()">
<option value="">---Select---</option>
</select>
</div>
</td>
<td>

<input type="text" class="sc" autocomplete="off" id="desc" name="desc" style="text-align:left" tabindex="1">
</td>
<td>
<input type="text" id="pcs" class="sc" autocomplete="off"  name="pcs" value="1"  style="text-align:center" onblur="cal()" tabindex="1"  onkeypress="return isNumber(event)">
</td>
<td> 
<div id="getp">
<input type="text" class="sc" id="prc"  name="prc" value=""  style="text-align:right" onblur="cal()" tabindex="1" onkeypress="return isNumber(event)">
</div>
</td>
<td> 
<input type="text" class="sc" id="total" readonly name="total" value="" style="text-align:right" tabindex="1" onkeypress="return isNumber(event)">
</td>
<td> 
<div id="getd">
<input type="text" class="sc" id="disp"  name="disp" value="" style="text-align:right" onblur="cal()" tabindex="1" onkeypress="return isNumber(event)">
</div>
</td>
<td> 
<input type="text" class="sc" id="disa"  name="disa" value="" style="text-align:right" tabindex="1" onkeypress="return isNumber(event)">
</td>
<td> 
<input type="text" class="sc" id="lttl"  name="lttl" value=""  style="text-align:right" tabindex="1" readonly onkeypress="return isNumber(event)">
</td>
<td align="center">
<input type="text" name="cgst_rt" id="cgst_rt" class="sc" tabindex="1" readOnly class="sc" onfocus="this.select();"  style="text-align:center">
</td>
<td  align="center">
<input type="text" name="cgst_am" id="cgst_am" class="sc" tabindex="1" class="sc" onfocus="this.select();"  style="text-align:right" onkeypress="return isNumber(event)">
</td>
<td  align="center">
<input type="text" name="sgst_rt" id="sgst_rt" class="sc" tabindex="1" readOnly class="sc" onfocus="this.select();"  style="text-align:center">
</td>
<td  align="center">
<input type="text" name="sgst_am" id="sgst_am" class="sc" tabindex="1" class="sc" onfocus="this.select();"  style="text-align:right" onkeypress="return isNumber(event)">
</td>
<td  align="center">
<input type="text" name="igst_rt" id="igst_rt" class="sc" tabindex="1" readOnly class="sc" onfocus="this.select();"  style="text-align:center">
</td>
<td align="center">
<input type="text" name="igst_am" id="igst_am" class="sc" readOnly tabindex="1" class="sc" onfocus="this.select();"  style="text-align:right">
</td>
<td>
<input type="text" class="sc" id="net_amm" name="net_amm" value="" tabindex="1" readonly  autocomplete="off"  style="text-align:right" size="15" onkeypress="return isNumber(event)" >
</td>
<td class="upd">
<input type="button" class="btn btn-primary" id="Button1" name="" value="Add"  onclick="add()" tabindex="1" style="width:100%;padding:2px" >
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


<tr>

<td align="left" ><b>Bill Amount :</b><br>
<div id="billamm">
<input type="text" name="tamm" id="tamm" class="form-control"  tabindex="1" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true" onkeypress="return isNumber(event)"> 
</div>
</td>
<td align="left" ><b>Tax Amount : GST :</b><br>
<div id="gst_am">
<input type="text" name="tgst" id="tgst"  readOnly  value=""  tabindex="1" class="form-control"  style="text-align:right" onkeypress="return isNumber(event)">
</div>
</td>
<td align="left" ><b>Pay Amount :</b><br>
<input type="text" name="pay" id="pay" class="form-control" readOnly  tabindex="1" style="background-color:#f3f4f5;font-size:13pt;color:blue" onkeypress="return isNumber(event)"> 
</td>
</tr>
<tr>
<td align="center" colspan="3">
<input type="button" class="btn btn-success btn-sm" id="Button2" onclick="check()" name="bt1" tabindex="1" value="Update" style="width:10%;" >
</td>
</tr>
</table>
</div>


<div class="box-footer clearfix no-border">

</div>
<div id="adpnm"></div>
<div id="adcnm"></div>
	<!-- Light Box -->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true"  >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="cnt1">
			</div>
        </div>
    </div>
</div>
<div class="modal fade" id="compose-modal1" tabindex="-1" role="dialog" aria-hidden="true"  >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="cnt11">
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
$('#bcd').chosen({no_results_text: "Oops, nothing found!",}); 
$('#cat').chosen({no_results_text: "Oops, nothing found!",});
$('#scat').chosen({no_results_text: "Oops, nothing found!",});

</script>

    </body>

</html>