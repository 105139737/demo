<?php
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$brncd=$_REQUEST['brncd'];
$cid=$_REQUEST['cid'];
$bill_typ=$_REQUEST['bsl'];

$blno_ref=$_REQUEST['blno'];
$data1=mysqli_query($conn,"SELECT * FROM main_recv_credit_note where blno='$blno_ref'")or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($data1))
{
$sln++;
$sl=$row1['sl'];
$blno=$row1['blno'];
$dt=$row1['dt'];
$nrtn=$row1['nrtn'];
$tamm=$row1['tamm'];
$refno=$row1['refno'];
$paymtd=$row1['paymtd'];
$dldgr=$row1['dldgr'];
$sman1=$row1['spid'];
$cid=$row1['cid'];
$cstat=$row1['stat'];
$bcd=$row1['bcd'];
$bill_typ=$row1['bill_type'];
$vno=$row1['vno'];
$blnon=$row1['blnon'];
}

$get=mysqli_query($conn,"select * from main_billtype where sl='$bill_typ'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$brncds=$row['brncd'];
$typ=$row['inv_typ'];
$tp=$row['tp'];
$brand=$row['brand'];
}
//echo "DELETE FROM main_credit_note_temp WHERE eby='$user_currently_loged' and cid='$cid' and brncd='$bcd' and app_ref='$blno'";
$result2 = mysqli_query($conn,"DELETE FROM main_credit_note_temp WHERE eby='$user_currently_loged' and cid='$cid' and brncd='$bcd' and app_ref='$blno'");

$query100 = "SELECT * FROM main_recv_dtl_credit_note where  ref='$blno_ref' order by sl";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$bill_no=$R100['blno'];
$amm=$R100['amm'];
$cldgr=$R100['cldgr'];
$disl=$R100['disl'];
$damm=$R100['damm'];
$remk=$R100['remk'];
$cid=$R100['cid'];
$brncd=$R100['brncd'];
$err=0;
$T=0;
$t1=0;
$t2=0;

if($err==0)
{
$query21 = "INSERT INTO main_credit_note_temp (blno,amm,sman,cid,eby,brncd,disl,damm,remk,app_ref)
VALUES ('$bill_no','$amm','$sman','$cid','$user_currently_loged','$brncd','$disl','$damm','$remk','$blno_ref')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));		
}

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
	gtcrvlfi();
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
	var	proj = document.getElementById('proj').value;
	var	sl = document.getElementById('cldgr').value;
	var	cid = document.getElementById('cid').value;
	var	blno = document.getElementById('blno').value;
		
		$('#drbl').load('jrnl_form_gtdrvl_blno_credit.php?sl='+sl+'&cid='+cid+'&brncd='+brncd+'&blno='+blno).fadeIn('fast');
		//$('#crbl').load('sale_ser_totalbal.php?pno='+proj).fadeIn('fast');
		$('#totbal').load('recv_totbal_credit_note.php?pno='+proj+'&brncd='+brncd+'&cid='+cid).fadeIn('fast');
		
			}
			
			function gtcrvlfi()
	{	
		proj = document.getElementById('proj').value;
		sl = document.getElementById('dldgr').value;
		var brncd= document.getElementById('brncd').value;
		
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
function reset()
{
$('#blno').trigger('chosen:open');
document.getElementById('amm').value='';

}
function temp()
{
	
var cid=document.getElementById('cid').value;	
var brncd=document.getElementById('brncd').value;	
var tamm=document.getElementById('tamm').value;	



$('#wb_Text').load("credit_note_tempsh.php?cid="+cid+"&brncd="+brncd+"&tamm="+tamm).fadeIn('fast');	
}
function deltpr(sl)
{
$('#wb_Text').load("deltpr_credit_note.php?sl="+sl).fadeIn('fast');
}



function get_blno()
{
var brncd= document.getElementById('brncd').value;
var proj = document.getElementById('proj').value;
var sl = document.getElementById('cldgr').value;
var cid = document.getElementById('cid').value;
$('#blno_div').load('get_blno.php?sl='+sl+'&cid='+cid+'&brncd='+brncd).fadeIn('fast');	

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
  
    $('#sman').val(sale_per);
	$('#sman').trigger('chosen:updated');
    
}); 

}


function submit1()
{
var ramm=document.getElementById('ramm').value;
var tamm=document.getElementById('tamm').value;
var dldgr=document.getElementById('dldgr').value;
var blno=document.getElementById("blno").value;
if(blno=='')
{
alert('Please Select Invoice No....')
return false;	
}
else if(tamm<1)
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
	document.forms["form11"].submit();
}	
}
 
}



function add()
{
	var cid=encodeURIComponent(document.getElementById('cid').value);
	var brncd=encodeURIComponent(document.getElementById('brncd').value);
	var blno=encodeURIComponent(document.getElementById('blno').value);
	var amm=encodeURIComponent(document.getElementById('amm').value);
	var sman=encodeURIComponent(document.getElementById('sman').value);

	var ramm=encodeURIComponent(document.getElementById('ramm').value);
	var due=encodeURIComponent(document.getElementById('dbal2').value);
	
	
	
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
		
		else
		{
		$('#wb_Text').load('credit_note_temp.php?blno='+blno+'&amm='+amm+'&sman='+sman+'&cid='+cid+'&brncd='+brncd+'&ramm='+ramm+'&due='+due).fadeIn('fast');
		}
}

setTimeout(function(){ temp(); }, 300);


</script>
 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>


<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
</head>

<body onload="sh();">
 <aside class="right-side">
  <section class="content-header">
                    <h1 align="center">
                 Credit Note Edit
               
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Credit Note Edit</li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="credit_note_updates.php" id="Form1" >
<input type="hidden" name="flnm" id="flnm" value="cust_credit_note.php" >
<input type="hidden" name="proj" id="proj" value="NA" readonly>
<input type="hidden" name="it" id="it" value="NA" readonly >
<input type="hidden" name="blno1" id="blno1" value="<?echo $blno_ref;?>" readonly >
<input type="hidden" name="vno" id="vno" value="<?echo $blno_ref;?>" readonly >
<input type="hidden" name="blnon" id="blnon" value="<?echo $blnon;?>" readonly >

<input type="hidden" name="flnm1" id="flnm1" value="1" >
<input type="hidden" name="btyp" id="btyp" value="<? echo $typ; ?>" >
<input type="hidden" class="form-control"  value="<?php echo $bill_typ;?>" tabindex="1"  name="bsl" id="bsl" >              

 <div class="box box-success" >
<table  width="860px" class="table table-hover table-striped table-bordered">

<tbody>
<tr class="">
<td align="right" width="15%"><font color="red">*</font><b>Branch :</b></td>
<td align="left" width="35%">
<select name="brncd" class="form-control" size="1" id="brncd"  onchange="get_blno();gtcrvlfi()" >
<?
if($user_current_level<0)
{

}
if($user_current_level<0)
{
$query="Select * from main_branch where sl='$bcd'";
}
else
{
$query="Select * from main_branch where sl='$bcd'";
}
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$slb=$R['sl'];
$bnm=$R['bnm'];
?>
<option value="<? echo $slb;?>" <?if($slb==$bcd){echo 'selected';}?>><? echo $bnm;?></option>
<?
}
?>
</select>
</td>
<td align="right" width="15%" ><font color="red">*</font><b>Date :</b></td>
<td align="left" width="35%" >
<input type="text" name="dt" id="dt" class="form-control" value="<? echo date('d-M-Y',strtotime($dt)); ?>" onchange="chk_dt('<?=date('d-M-Y')?>')">
</td>   
  </tr>
   
  
   <tr class="">
    <td align="right" ><font color="red">*</font><b>Customer :</b></td>
    <td align="left" >
	<input type="hidden" value="4" id="cldgr" name="cldgr"/> 
<table width="100%">	
<tr>
<td width="50%">
<select id="cid"  name="cid"   tabindex="2" class="form-control"  onchange="get_blno(),temp();">
<option value="">---Select---</option>

<?
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
<option value="<? echo $sid;?>" <?if($cid==$sid){?> selected <? } ?> ><? echo $spn;?> - <? echo $cont; if($addr!=""){?> - - <? echo $addr; }?></option>
<?
}
?>
</select>
</td>

</tr>
</table>
	</td>
	<td align="right" ><font color="red">*</font><b>Ledger Name :</b></td>
    <td align="left" >
      <select  name="dldgr" id="dldgr" class="form-control"  onchange="gtcrvlfi()" required>
							<option value="">-- Select --</option>
							<?php 
							$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='17'") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?=$row['sl']?>"<?if($dldgr==$row['sl']){echo "selected";}?>><?=$row['nm']?></option>
							<?php 
							} 
							?>
						</select>
	</td>   
  </tr>
  
  <tr class="">
    
	<td align="right" ><font color="red" size="3"> <b>Total DUE :</b></font></td>
   
	<td>
	<div id="totbal">
	<img src="images\rp.png" height="15px"><input type="text" name="dbal1" id="dbal1"  value="0.00" style="background :transparent; color : red;width:120px;" readonly>
	</div>
	
	</td>
	
	</td>
<td align="right" ><b> Balance :</b></td>
    <td align="left" >
	<div id="crbl">
	 <img src="images\rp.png" height="15px">
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
    <td align="right" ><font color="red"><b>Total Credit Note Amount :</b></td>
    <td align="left" >

	 <input  type="text" name="tamm" id="tamm" class="form-control" value="<?echo $tamm;?>" onblur="temp()">
	</td>
	<td align="right"><font color="red" size="3"><b>Rest Amount :</font></b></td>
<td>
<input  type="text" name="ramm" readonly id="ramm" class="form-control" onkeypress="return isNumber1(event)">
</td>
</tr>

  
  <tr class="">
    <td align="right" ><font color="red">*</font><b>Sales Person :</b></td>
    <td align="left"  >
	<select id="sman" name="sman" tabindex="1"  class="form-control">
	<option value="">---Select---</option>
	<?
		$queryss="select * from main_sale_per    WHERE sl>0  order by spid";
		$resultss=mysqli_query($conn,$queryss);
		while($rwss=mysqli_fetch_array($resultss))
		{
			$spid11=$rwss['spid'];
			$spnm=$rwss['nm'];
		?>
			<option value="<?=$spid11;?>"<?if($spid11==$sman1){echo "selected";}?>><?=$spid11;?> --- <?=$spnm;?> <?if($rwss['mob']!=""){?>( <?=$rwss['mob'];?> )<?}?></option>
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
  <tr>
	
	<td align="right" style="padding-top:15px;" ><b>Narration :</b></td>
    <td align="left" >
<input type="text" name="nrtn" id="nrtn" value="<?echo $nrtn;?>" class="form-control">
	</td>   
  </tr>
  </table>
  <div class="box box-success"><b>Received Details :</b>
<table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td align="left" width="3%"><b>Sl. </b></td>
<td align="left" width="20%"><b>Bill No. </b></td>
<td align="left"  width="12%"><b>Due</b></td>
<td align="center" width="12%" ><b>Amount</b></td>
<td align="center" width="5%" ><b>Action</b></td>
</tr>
<tr>
<td>
<input type="text" name="sll" id="sll" class="sc" readonly>
</td>
<td>
<div id="blno_div">
<select id="blno"  name="blno"   tabindex="1" class="sc1"  onchange="gtcrvl1()" style="width:98%;">
<option value="">---Select---</option>
</select>
</div>
</td>
<td>
<div id="drbl">
<input type="text" name="dbal2" id="dbal2" class="sc" value="0.00" style="background :transparent; color : red;" readonly>
</div>
</td>
<td align="left">
<input  type="text" name="amm" id="amm" class="sc" onkeypress="return isNumber1(event)">
</td>



<td>
<input type="button" class="btn btn-info" id="Button1" name="" value="Add"  onclick="add()" tabindex="1" style="width:100%;padding:2px" >
</td>
</tr>
<tr height="180px">
<td colspan="9" valign="top">
<div id="wb_Text" >

</div>
</td>
</tr>

</table>
  <table>
  <tr class="odd">
    <td colspan="4" align="right">
	<input type="submit" value="Submit" onclick="submit1()" class="btn bt btn-success">
	</td>
  </tr>

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


</div></div></div></div>
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