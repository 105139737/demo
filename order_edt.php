<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
include "function.php";
$psl="";

$order_no=$_REQUEST['blno'];
$blno=$_REQUEST['blno'];
$bill_typ=$_REQUEST['bsl'] ?? "" ;


$get=mysqli_query($conn,"select * from main_order where blno='$order_no'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
	$cid=$row['cid'];
	$sale_per=$row['sale_per'];
	$bcd=$row['bcd'];
	$dt=$row['dt'];
	$vstat=$row['vstat'];
}	
 if($vstat==1)
{
	$ckd="checked";

}
 else
{
	$ckd="";
}
/* cid	bcd	cat	scat	prsl	imei	unit	usl	betno	uval	kg	grm	pcs	srt	adp	prc	total	disp	disa	ttl	tamm	fst	tst	cgst_rt	cgst_am	sgst_rt	sgst_am	igst_rt	igst_am	net_am	blno	refno	bill_typ	retno	rate	stk_rate	rdt	dt	cust	eby	rqty 
 */
$qrr=mysqli_query($conn,"delete from main_edt_orderdtls where blno='$blno'")or die (mysqli_error()); 

$query214 = "insert into main_edt_orderdtls (cid,bcd,cat,scat,prsl,imei,unit,usl,betno,uval,kg,grm,pcs,srt,adp,prc,total,disp,disa,ttl,tamm,fst,tst,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,net_am,blno,refno,bill_typ,retno,rate,stk_rate,rdt,dt,cust,eby,rqty )
select cid,bcd,cat,scat,prsl,imei,unit,usl,betno,uval,kg,grm,pcs,srt,adp,prc,total,disp,disa,ttl,tamm,fst,tst,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,net_am,blno,refno,bill_typ,retno,rate,stk_rate,rdt,dt,cust,eby,rqty  from main_orderdtls where blno='$blno' order by sl";
$result214 = mysqli_query($conn,$query214)or die (mysqli_error()); 

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
$("#dt").datepicker(jQueryDatePicker2Opts);
$("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
});
 
</script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
   
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript">

function isNumber(evt) 
{
var iKeyCode = (evt.which) ? evt.which : evt.keyCode
if(iKeyCode < 48 || iKeyCode > 57)
{
return false;
}
return true;
}

function gtt_unt()
 {
	prnm=document.getElementById('prnm').value;
	unit_nm=document.getElementById('unit_nm').value;
	 $("#g_unt").load("get_unt_sale1.php?prnm="+prnm+"&unit_nm="+unit_nm).fadeIn('fast');
 }
function get_betno()
{
prnm=document.getElementById('prnm').value;	
$("#g_betno").load("get_hsn1.php?prnm="+prnm).fadeIn('fast');	
}

function godown()
{
prnm=document.getElementById('prnm').value;	
$("#g_gwn").load("get_gwn_sale1.php?prnm="+prnm).fadeIn('fast');	
}

function temp()
{
blno=document.getElementById('blno').value;	
$('#wb_Text13').load("tmppr_ord.php?blno="+blno).fadeIn('fast');
}
function deltpr(sl)
{
$('#wb_Text13').load("deltpr_ord.php?tsl="+sl).fadeIn('fast');
}


function add1()
{
blno=document.getElementById('blno').value;	

var prnm=document.getElementById('prnm').value;
var bcd=document.getElementById('bcd').value;
var hsn=document.getElementById('hsn').value;
var unit=document.getElementById('unit').value;
var pcs=document.getElementById('pcs').value;
var brncd=document.getElementById('brncd').value;
var tsl=document.getElementById('tsl').value;

if(prnm=='')
{
alert("Product Can't be blank");
}

else
{
$('#wb_Text13').load('adtmppr_ord.php?prnm='+prnm+'&bcd='+bcd+'&hsn='+hsn+'&unit='+unit+'&pcs='+pcs+'&brncd='+brncd+'&tsl='+tsl+'&blno='+blno).fadeIn('fast');
}


}
function reset()
{
document.getElementById('prnm').value="";
$('#prnm').trigger("chosen:updated");
		
document.getElementById('bcd').value="";
$('#bcd').trigger("chosen:updated");		

document.getElementById('hsn').value="";
document.getElementById('unit').value="";
document.getElementById('pcs').value="";
document.getElementById('tsl').value="";

	
$('.upd').html('<input type="button" value="ADD" onclick="add1()" style="padding:2px;width:100%" class="btn btn-primary">');
}
</script>
</head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>

<body onload="temp()">
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
<form method="post" target="" name="form1" id="form1"  action="order_edts.php">
<input type="hidden" class="form-control" value="<?php  echo $order_no;?>"  tabindex="1"  name="order_no" id="order_no" >  							
<input type="hidden" class="form-control" value="<?php  echo $blno;?>"  tabindex="1"  name="blno" id="blno" >  							
<input type="hidden" id="unit_nm" class="sc" name="unit_nm" readonly>
<input type="hidden1" id="tsl" class="sc" name="tsl" readonly>
<div class="box box-success" >
<b>Invoice Details : </b>
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="left" style="padding-top:15px;" width="25%" >
<b>Customer Name: </b>
<select id="cid" name="cid" tabindex="1"  class="form-control"  onchange="adnew()"  >
<option value="">---Select---</option>
<?php 
$query="select * from main_cust WHERE sl>0  order by nm";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$typ1=$rw['typ'];				
?>
<option value="<?php  echo $rw['sl'];?>" <?php  if($cid==$rw['sl']){echo 'selected';} ?>><?php  echo $rw['nm'];?> <?php if($rw['cont']!=""){?>( <?php  echo $rw['cont'];?> )<?php }?> </option>
<?php 
}
?>
</select>
</td>

<td align="left" width="25%" style="padding-top:15px"><b>Branch : </b>
<select name="brncd" class="form-control" tabindex="1" id="brncd"  >
<?php 
$query="Select * from main_branch";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$bsl=$R['sl'];
$bnm=$R['bnm'];
?>
<option value="<?php  echo $bsl;?>" <?php  if($bsl==$bcd){echo 'selected';} ?>><?php  echo $bnm;?></option>
<?php 
}
?>
</select>
</td>
<td align="left" width="25%" style="padding-top:15px;"> <b>Date : </b>
<input type="text" class="form-control"  id="dt"  name="dt" value="<?php  echo date('d-m-Y',strtotime($dt));?>" tabindex="1" size="35" placeholder="Enter Date">
</td>

<td align="left" style="padding-top:15px;" width="25%"><b>Sales Person :</b>
<select id="sale_per" name="sale_per" tabindex="1"  class="form-control">
<option value="">---Select---</option>
<?php 
$queryss="select * from main_sale_per  WHERE sl>0 order by spid";
$resultss=mysqli_query($conn,$queryss);
while($rwss=mysqli_fetch_array($resultss))
{
$spid=$rwss['spid'];
$spnm=$rwss['nm'];
?>
<option value="<?php  echo $spid;?>" <?php if($sale_per==$spid){echo 'selected';}?>><?php  echo $spid?></option>
<?php 
}
?>
</select>
</td>
	
</tr>


</table>
</div>

<table width="800px" class="table table-hover table-striped table-bordered">
<tr>
<td  colspan="19">
<table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td align="left" width="30%"><b>Model</b></td>
<td align="left" width="30%"><b>Godown</b></td>
<td align="center" width="10%"><b>HSN</b></td>
<td align="center" width="10%"><b>Unit</b></td>
<td align="center" width="10%"><b>Quantity</b></td>
<td align="center" width="10%"><b>Action</b></td>
</tr>
<tr>
<td>
<select id="prnm" name="prnm" tabindex="9"  onchange="gtt_unt();godown()"  style="width:100%">
<option value="">---Select---</option>
<?php 
$data1 = mysqli_query($conn,"Select * from main_product order by pnm ");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$pnm=$row1['pnm'];
?>
<Option value="<?php  echo $sl;?>"<?php if($psl==$sl){echo 'selected';}?>><?php echo reformat($pnm);?></option>
<?php }?>
</select>
</td>
<td align="left" >
<div id="g_gwn">
<select name="bcd" class="form-control" tabindex="10"  size="1" id="bcd" onchange="gtt_unt()">
<option value="">---Select---</option>
<?php 
$geti=mysqli_query($conn,"select * from main_godown order by sl") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
$sl=$rowi['sl'];
$gnm=$rowi['gnm'];
$bnm=$rowi['bnm'];

?>
<option value="<?php  echo $sl;?>"><?php  echo $gnm;?></option>
<?php 
}
?>
</select>
</div>
</td>

<td>
<div id="g_betno">
<input type="text" class="sc" autocomplete="off" id="hsn" name="hsn" style="text-align:center"  value="" tabindex="1" size="15" readonly >
</div>
</td>

<td>
<div id="g_unt">
<select id="unit" name="unit" class="sc1" style="width:100%"  tabindex="1" onchange="get_stock()">
<option value="">---Select---</option>
</select>
</div>
</td>

<td>
<input type="text" id="pcs" class="sc" autocomplete="off"  name="pcs" value="1"  style="text-align:center" tabindex="1"  onkeypress="return isNumber(event)">
</td>
<input type="hidden" class="sc" id="adp"  name="adp" value="0"  style="text-align:center" tabindex="1">

<td class="upd">
<input type="button" class="btn btn-primary" id="Button1" name="" value="Add"  onclick="add1()" tabindex="1" style="width:100%;padding:2px" >
</td>
</tr>
</table>
   </td>
	   </tr>
	       <tr height="280px">
	   <td colspan="7">
	<div id="wb_Text13" >

		</div>
	  	</td>
	   </tr>
	   
<tr>
<td colspan="" align="right">
<font color="green"><b>Verify</b>&nbsp;&nbsp;<input type="checkbox" value="1" name="vstat" id="vstat" <?php echo $ckd;?>></font>&nbsp;&nbsp;
<input type="submit" class="btn btn-success btn-sm" id="Button2" name="bt1" tabindex="1" value="Update">
</td>
</tr>
</table>
</form>
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

$('#cid').chosen({
no_results_text: "Oops, nothing found!",

});
$('#bcd').chosen({
no_results_text: "Oops, nothing found!",
}); 

$('#sale_per').chosen({
no_results_text: "Oops, nothing found!",
});
</script>
<script>
function get_data(tsl,bcd,prsl,pcs,hsn,unit)
{ 
document.getElementById('tsl').value=tsl;

/* $('#prnm').append('<option value="'+prsl+'">'+pnm+'</option>');
 */
 document.getElementById('prnm').value=prsl;
$('#prnm').trigger("chosen:updated");		

document.getElementById('bcd').value=bcd;
$('#bcd').trigger("chosen:updated");		

document.getElementById('hsn').value=hsn;

document.getElementById('unit_nm').value=unit;

document.getElementById('pcs').value=pcs;


$('.upd').html('<input type="button" value="Update" onclick="add1()" style="padding:2px;width:100%" class="btn btn-warning">');
gtt_unt();

} 
</script>
    </body>

</html>