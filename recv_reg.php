<?php
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$brncd=$_REQUEST['brncd'];
$cid=$_REQUEST['cid'];
$bill_typ=$_REQUEST['bsl'];
$get=mysqli_query($conn,"select * from main_billtype where sl='$bill_typ'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$brncds=$row['brncd'];
$typ=$row['inv_typ'];
$tp=$row['tp'];
$brand=$row['brand'];
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
		
		$('#drbl').load('jrnl_form_gtdrvl_blno.php?sl='+sl+'&cid='+cid+'&brncd='+brncd+'&blno='+blno).fadeIn('fast');
		//$('#crbl').load('sale_ser_totalbal.php?pno='+proj).fadeIn('fast');
		$('#totbal').load('recv_totalbal.php?pno='+proj+'&brncd='+brncd+'&cid='+cid).fadeIn('fast');
		
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
	$('#show').load('recv_list.php?pno1='+proj+'&brncd='+brncd+'&custid='+custid+'&fdt='+fdt+'&tdt='+tdt+'&slp='+slp).fadeIn('fast');
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

    $('#show').load("recv_list.php?ps="+ps+"&pnog="+pnog+"&pno1="+proj+'&brncd='+brncd+'&custid='+custid+'&fdt='+fdt+'&tdt='+tdt+'&slp='+slp).fadeIn('fast');
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
window.open('recv_det_new.php?sl='+sl, '_blank');
}
function title1()
{
var brncd=document.getElementById('brncd').value;
$("#title").load("brncd_name.php?brncd="+brncd).fadeIn('fast');	
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
</script>
 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>


<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<?
$query51="select * from ".$DBprefix."drcr order by vno";
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

}
?>
<body onload="sh();title1()">
 <aside class="right-side">
  <section class="content-header">
                    <h1 align="center">
                 Received 
                        <small>Register</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Received Register</li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="jrnl_forms.php" id="Form1" >
<input type="hidden" name="flnm" id="flnm" value="recv_reg.php" >
<input type="hidden" name="proj" id="proj" value="NA" readonly>
<input type="hidden" name="it" id="it" value="NA" readonly >

<input type="hidden" name="flnm1" id="flnm1" value="1" >
<input type="hidden" name="btyp" id="btyp" value="<? echo $typ; ?>" >
<input type="hidden" class="form-control"  value="<?php echo $bill_typ;?>" tabindex="1"  name="bsl" id="bsl" >              

 <div class="box box-success" >
<table  width="860px" class="table table-hover table-striped table-bordered">

<tbody>
<tr class="">
<td align="right" width="15%"><font color="red">*</font><b>Branch :</b></td>
<td align="left" width="35%">
<select name="brncd" class="form-control" size="1" id="brncd"  onchange="get_blno();gtcrvlfi();title1()" >
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
<td align="right" width="15%" ><font color="red">*</font><b>Date :</b></td>
<td align="left" width="35%" >
<input type="text" name="dt" id="dt" class="form-control" value="<? echo date('d-M-Y'); ?>" onchange="chk_dt('<?=date('d-M-Y')?>')">
</td>   
  </tr>
      <input type="hidden" name="vno" class="form-control" id="vno" value="<?echo $vno;?>" readonly style="background :transparent; color : red;">

  
   <tr class="">
    <td align="right" ><font color="red">*</font><b>Customer :</b></td>
    <td align="left" >
	<input type="hidden" value="4" id="cldgr" name="cldgr"/> 
<table width="100%">	
<tr>
<td width="50%">
<select id="cid"  name="cid"   tabindex="2" class="form-control"  onchange="get_blno()">
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
<td width="50%">
<div id="blno_div">
<select id="blno"  name="blno"   tabindex="2" class="form-control"  onchange="gtcrvl1()">
<option value="">---Select---</option>
</select>
</div>
</td>
</tr>
</table>
	</td>
	<td align="right" ><font color="red">*</font><b>Cash Or Bank Ac. :</b></td>
    <td align="left" >
      <select  name="dldgr" id="dldgr" class="form-control"  onchange="gtcrvlfi()">
							<option value="">-- Select --</option>
							<?php 
							$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='1' or gcd='2'") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?=$row['sl']?>" <?=$row['sl'] == '3' ? 'selected' : '' ?>><?=$row['nm']?></option>
							<?php 
							} 
							?>
						</select>
	</td>   
  </tr>
  
  <tr class="">
    
	<td align="right" > <b>Balance :</b></td>
    <td align="left">
	<table border="0">
	
	
	<tr>
	
	<td>
	
	<td><b>Due : </b></td>
	<td>
	<div id="drbl">
	<img src="images\rp.png" height="15px"><input type="text" name="dbal" id="dbal"  value="0.00" style="background :transparent; color : red;width:120px;" readonly>
	</div>
	</td>
	<td>
	<td><b>Total :</b></td>
	<td>
	<div id="totbal">
	<img src="images\rp.png" height="15px"><input type="text" name="dbal" id="dbal"  value="0.00" style="background :transparent; color : red;width:120px;" readonly>
	</div>
	
	</td>
	
	</tr>
	</table>
	</td>
<td align="right" ><b> Balance :</b></td>
    <td align="left" >
	<div id="crbl">
	 <img src="images\rp.png" height="15px">
	 <input type="text" name="cbal" id="cbal"  value="0.00" style="background :transparent; color : red;" readonly>
	</div>
	</td>	
  </tr>
  
  <tr class="">
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
    <td align="right" ><font color="red">*</font><b>Amount :</b></td>
    <td align="left" >

	 <input  type="text" name="amm" id="amm" class="form-control" >
	</td>
		   <td align="right" style="padding-top:15px;" ><b>Discount :</b></td>
    <td align="left" >
<input type="text" name="dis" id="dis" class="form-control">
	</td>   
  </tr>
  
  <tr class="">
    <td align="right" ><font color="red">*</font><b>Sales Person :</b></td>
    <td align="left"  >
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
			<option value="<?=$spid;?>"><?=$spid;?><?=$spnm;?> <?if($rwss['mob']!=""){?>( <?=$rwss['mob'];?> )<?}?></option>
			<?
		}
	?>
	</select>
	</td>
    <td align="right" ><font color="red">*</font><b>Narration :</b></td>
    <td align="left"  >
	<input type="text" name="nrtn" id="nrtn" class="form-control">
	</td>

	 

  </tr>
  
  
  
  
  <tr class="odd">
    <td colspan="4" align="right">
	<input type="button" value="Submit" onclick="submit1()" class="btn bt btn-success">
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
<font size="3"><b>Customer :</b></font><br>
<select id="custid" name="custid" tabindex="1"  class="form-control" >
	<option value="">---ALL---</option>
	<?
		$query2="select * from main_cust WHERE sl>0 order by nm";
		$result2=mysqli_query($conn,$query2);
		while($rw2=mysqli_fetch_array($result2))
		{
			?>
			<option value="<?=$rw2['sl'];?>"><?=$rw2['nm'];?> --  <?=$rw2['cont'];?></option>
			<?
		}
	?>
</select>
</td>
<td align="left" width="15%">
<font size="3"><b>From Date : </b></font>
<input type="text" id="fdt" name="fdt" value="<?=date('01-M-Y');?>" class="form-control" >
</td>
<td align="left" width="15%">
<font size="3"><b>To Date : </b></font>
<input type="text" id="tdt" name="tdt" value="<?=date('d-M-Y');?>" class="form-control" >
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