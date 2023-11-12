<?php
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$sl=$_REQUEST[sl];		
$data= mysqli_query($conn,"SELECT * FROM main_drcr where sl='$sl'");
while ($row = mysqli_fetch_array($data))
{
$dt= $row['dt'];
$pno= $row['pno'];
$vno= $row['vno'];
$cldgr= $row['cldgr'];
$dldgr= $row['dldgr'];
$mtd= $row['mtd'];
$mtddtl= $row['mtddtl'];
$amm= $row['amm'];
$nrtn= $row['nrtn'];
$it= $row['it'];
$cid= $row['cid'];
$brncd= $row['brncd'];
$cbill= $row['cbill'];
$sman= $row['sman'];
$bill_typ= $row['bill_typ'];
}
$dt=date('d-M-Y', strtotime($dt));
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
		proj = document.getElementById('proj').value;
		sl = document.getElementById('cldgr').value;
		cid = document.getElementById('cid').value;
		blno = document.getElementById('blno').value;
		
		$('#drbl').load('jrnl_form_gtdrvl_blno.php?sl='+sl+'&cid='+cid+'&brncd='+brncd+'&blno='+blno).fadeIn('fast');
		//$('#crbl').load('sale_ser_totalbal.php?pno='+proj).fadeIn('fast');
		
			}
			
			function gtcrvlfi()
	{	
		proj = document.getElementById('proj').value;
		sl = document.getElementById('dldgr').value;
		var brncd= document.getElementById('brncd').value;
		
		$('#crbl').load('jrnl_form_gtdrvl.php?sl='+sl+'&pno='+proj+'&brncd='+brncd).fadeIn('fast');
		sh();
	}
	
	function sh()
			{
				proj = document.getElementById('proj').value;
				var brncd= document.getElementById('brncd').value;
				$('#show').load('recv_list.php?pno1='+proj+'&brncd='+brncd).fadeIn('fast');
				
			}
			
	function pagnt(pnog){
		proj = document.getElementById('proj').value;
		var ps=document.getElementById('ps').value;
      	var brncd= document.getElementById('brncd').value;
    $('#show').load("recv_list.php?ps="+ps+"&pnog="+pnog+"&pno1="+proj+'&brncd='+brncd).fadeIn('fast');
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


function get_blno()
{
var brncd= document.getElementById('brncd').value;
proj = document.getElementById('proj').value;
sl = document.getElementById('cldgr').value;
cid = document.getElementById('cid').value;
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
function submit()
{
var blno=document.getElementById("blno").value;
if(blno=='')
{
alert('Please Select Invoice No.')
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

<body >
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
<form name="Form1" method="post" action="jrnl_forms.php" id="Form1" onsubmit="return submit()">
<input type="hidden" name="flnm" id="flnm" value="oth_recv_reg_list.php" >
<input type="hidden" name="proj" id="proj" value="NA" readonly>
<input type="hidden" name="it" id="it" value="NA" readonly >
<input type="hidden" name="updt" id="updt" value="<?php echo $sl;?>">
<input type="hidden" class="form-control"  value="<?php echo $bill_typ;?>" tabindex="1"  name="bsl" id="bsl" >              

 <div class="box box-success" >
<table  width="860px" class="table table-hover table-striped table-bordered">

<tbody>
<tr >
<td align="right" width="20%"><font color="red">*</font><b>Branch :</b></td>
<td align="left" width="30%">
<select name="brncd" class="form-control" size="1" id="brncd"  onchange="get_blno();gtcrvlfi();title1()" >
<?
$query="Select * from main_branch where sl='$brncd'";

$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$slb=$R['sl'];
$bnm=$R['bnm'];
?>
<option value="<? echo $slb;?>"<?php echo $R['sl'] == $brncd ? 'selected' : '' ?> ><? echo $bnm;?></option>
<?
}
?>
</select>
</td>
<td align="right" width="20%" ><font color="red">*</font><b>Date :</b></td>
<td align="left" width="30%" >
<input type="text" name="dt" id="dt" class="form-control" value="<? echo $dt; ?>" >
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
$query="Select * from  main_cust order by nm";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sid=$R['sl'];
$spn=$R['nm'];
$cont=$R['cont'];
?>
<option value="<? echo $sid;?>"<?php echo $R['sl'] == $cid ? 'selected' : '' ?>><? echo $spn;?> - <? echo $cont;?></option>
<?
}
?>
</select>
</td>
<td width="50%">
<div id="blno_div">
<select id="blno"  name="blno"   tabindex="2" class="form-control"  onchange="gtcrvl1()">
<?

$invto="";
$data2= mysqli_query($conn,"select * from  main_billing where blno='$cbill'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$invto=$row2['invto'];
$sfno=$row2['sfno'];
}
$nm="";
$query="select * from main_cust  WHERE sl='$invto'";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$nm=$rw['nm'];
}
$T=0;
$t1=0;
$t2=0;
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and cbill='$cbill'".$cid1.$brncd1.$dld);
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1' and cbill='$cbill'".$cid1.$brncd1.$cld);
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=$t1-$t2;
?>
<option value="<? echo $cbill;?>"><? echo $cbill;?> <?=$nm;?> <?=$sfno;?> Due Am. : <?=round($T,2)?>/- (Date : <?=$dt;?>) </option>


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
								<option value="<?=$row['sl']?>" <?php echo $row['sl'] == $dldgr ? 'selected' : '' ?>><?=$row['nm']?></option>
							<?php 
							} 
							?>
						</select>
	</td>   
  </tr>
  
  <tr style="display:none">
    
	<td align="right" > <b>Balance :</b></td>
    <td align="left" >
     <div id="drbl">
	 <img src="images\rp.png" height="15px"><input type="text" name="dbal" id="dbal"  value="0.00" style="background :transparent; color : red;" readonly>
	</div>
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
								<option value="<?=$row['sl']?>" <?php echo $row['sl'] == $mtd ? 'selected' : '' ?>><?=$row['mtd']?></option>
							<?php 
							} 
							?>
						</select>
	</td>
	<td align="right" ><b>Ref. No. :</b></td>
    <td align="left" >
       <input type="text" name="refno" class="form-control"  id="refno" value="<?php echo $mtddtl;?>">
	</td>   
  </tr>
  <tr class="">
    <td align="right" ><font color="red">*</font><b>Amount :</b></td>
    <td align="left" >

	 <input  type="text" name="amm" id="amm" class="form-control"  value="<?php echo $amm;?>">
	</td>
    <td align="right" ><font color="red">*</font><b>Narration :</b></td>
    <td align="left">
	<input type="text" name="nrtn" id="nrtn" class="form-control" value="<?php echo $nrtn;?>">
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
			<option value="<?=$spid;?>"<?if($spid==$sman){echo 'selected';}?>><?=$spid;?> </option>
			<?
		}
	?>
	</select>
	</td>
    <td align="right" ><b></b></td>
    <td align="left"  >

	</td>

	 

  </tr>   
<tr class="odd">
<td colspan="4" align="right">
<input type="submit" value="Update" class="btn btn-success">
</td>
  </tr>

</table>
</div>
										         <!-- COMPOSE MESSAGE MODAL -->

<!-- Modal Box Start-->

<!-- Modal Box End -->
</form>
 </section><!-- /.content -->
 </aside><!-- /.right-side -->

</body>


<script type="text/javascript">
  $('#cid').chosen({no_results_text: "Oops, nothing found!",});
  $('#custid').chosen({no_results_text: "Oops, nothing found!",});
  $('#sman').chosen({no_results_text: "Oops, nothing found!",});
   $('#blno').chosen({
  no_results_text: "Oops, nothing found!",
  
  });
</script>

</div>
</html>