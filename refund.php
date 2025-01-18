<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
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
	font-size: 14px;
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
sl = document.getElementById('cldgr').value;
var brncd= document.getElementById('brncd').value;

$('#drbl').load('jrnl_form_gtdrvl_refund.php?sl='+sl+'&brncd='+brncd).fadeIn('fast');
}
			
			function gtcrvlfi()
	{	
		sl = document.getElementById('dldgr').value;
		cid = document.getElementById('cid').value;
		var brncd= document.getElementById('brncd').value;
		var blno= document.getElementById('blno').value;
		$('#crbl').load('jrnl_form_gtdrvl_refund_cust.php?sl='+sl+'&cid='+cid+'&brncd='+brncd+'&blno='+blno).fadeIn('fast');
	
	}
	
function sh()
{
	var brncd= document.getElementById('bcd').value;
	var custid= document.getElementById('custid').value;
	var fdt= document.getElementById('fdt').value;
	var tdt= document.getElementById('tdt').value;
$('#show').load('refund_list.php?brncd='+brncd+'&custid='+custid+'&fdt='+fdt+'&tdt='+tdt).fadeIn('fast');
}
			
	function pagnt(pnog){
	var brncd= document.getElementById('bcd').value;
	var custid= document.getElementById('custid').value;
	var fdt= document.getElementById('fdt').value;
	var tdt= document.getElementById('tdt').value;
	var ps=document.getElementById('ps').value;
      
    $('#show').load('refund_list.php?ps='+ps+'&pnog='+pnog+'&brncd='+brncd+'&custid='+custid+'&fdt='+fdt+'&tdt='+tdt).fadeIn('fast');
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
			
		//document.getElementById('dt').value=cdt;	
		alert('You Have No Permission For Entry Date.');
		}
  
}); 


}

 function sfdtlrecvrefund(sl)
{
	$('#cnt').load('refund_det.php?sl='+sl).fadeIn("fast");
	$('#myModal').modal('show');
}

function get_blno()
{
var brncd= document.getElementById('brncd').value;
var sl = document.getElementById('dldgr').value;
var cid = document.getElementById('cid').value;
$('#blno_div').load('get_blno_ref_refund.php?sl='+sl+'&cid='+cid+'&brncd='+brncd).fadeIn('fast');	
 
}

function get_blno_edt(blno)
{
var brncd= document.getElementById('brncd1').value;
var sl = document.getElementById('dldgr1').value;
var cid = document.getElementById('cid1').value;
$('#blno_div_edt').load('get_blno_ref_edt_refund.php?sl='+sl+'&cid='+cid+'&brncd='+brncd+'&blno='+blno).fadeIn('fast');	
 
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
                 Refund 
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Refund</li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="jrnl_forms.php" id="Form1">
<input type="hidden" name="flnm" id="flnm" value="refund.php" >

 <div class="box box-success" >
          <table width="860px" class="table table-hover table-striped table-bordered">

        
  <tr >

    <td align="left" width="50%" >
	<font color="red">*</font>Date :<br>
	<input type="text" name="dt" class="form-control" id="dt" value="<?php  echo date('d-M-Y'); ?>" onchange="chk_dt('<?php echo date('d-M-Y')?>')"> 
	</td>
<td align="left" width="50%" >	
<font color="red">*</font>Branch  :	<br>				
<select name="brncd" class="form-control" size="1" id="brncd"  onchange="gtcrvl1();get_blno();" >
<?php 
if($user_current_level<0)
{
?>
<option value="">---Select---</option>
<?php 
}
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
$slb=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<?php  echo $slb;?>"><?php  echo $bnm;?></option>
<?php 
}
?>
</select>
	</td>
  </tr>
  
   <tr >
    <td align="left" >
	<font color="red">*</font>Cash Or Bank Ac. :
      <select  name="cldgr" id="cldgr" class="form-control" onchange="gtcrvl1()"  >
							<option value="">-- Select --</option>
							<?php  
							$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='1' or gcd='2' or gcd='22'") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?php  echo $row['sl']?>" ><?php  echo $row['nm']?></option>
							<?php  
							} 
							?>
						</select>
	</td>  
   
     

    <td align="left" >
	<font color="red">*</font>Customer :
	<input type="text" id="cs" name="cs" size="40" value="" onkeyup="get_cust_by_cs('cust_src',this.value,'cid','get_blno','cs')"  placeholder="Enter 3 Digit Name / 10 Digit Mobile No.">

	<input type="hidden" value="4" id="dldgr" name="dldgr"/> 
<table width="100%">	
<tr>
<td width="50%">
<div id="cust_src">
<select id="cid"  name="cid"   tabindex="2" class="form-control"  onchange="get_blno()">
<option value="">---Select---</option>
<?php /*
$query="select * from main_cust  WHERE sl>0 order by nm";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sid=$R['sl'];
$spn=$R['nm'];
$cont=$R['cont'];
$addr=$R['addr'];
?>
<option value="<?php  echo $sid;?>" <?php if($cid==$sid){?> selected <?php  } ?> ><?php  echo $spn;?>  - <?php  echo $cont;?></option>
<?php 
}*/
?>
</select>
</div>
</td>
<td width="50%">
<div id="blno_div">
<select id="blno"  name="blno"   tabindex="2" class="form-control"  onchange="gtcrvlfi()">
<option value="">---Select---</option>
</select>
</div>
</td>
</tr>
</table>
	</td>
 
 
  </tr>
  
  <tr >

    <td align="left" >
	Balance :
     <div id="drbl">
	 <img src="images\rp.png" height="15px"><input type="text" name="dbal" id="dbal" size="35" value="0.00" style="background :transparent; color : red;" readonly>
	</div>
	</td>
    <td align="left" >
	Balance :
	<div id="crbl">
	 <img src="images\rp.png" height="15px"><input type="text" name="cbal" id="cbal" size="35" value="0.00" style="background :transparent; color : red;" readonly>
	</div>
	</td>	
  </tr>
  
  <tr >
    <td align="left" >
	<font color="red">*</font>Payment Mode :
	 <select  name="paymtd" id="paymtd" class="form-control">
							<option value="">-- Select --</option>
							<?php  
							$get = mysqli_query($conn,"SELECT * FROM ac_paymtd") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?php  echo $row['sl']?>" ><?php  echo $row['mtd']?></option>
							<?php  
							} 
							?>
						</select>
	</td>
    <td align="left" >
	Ref. No. :
       <input type="text" name="refno" class="form-control" id="refno" size="40">
	</td>   
  </tr>
  <tr >
    <td align="left" >
	<font color="red">*</font>Ammount :
	 <input type="text" name="amm" id="amm" class="form-control" >
	</td>
    <td align="left"  colspan="3" >
	<font color="red">*</font>Narration :
	<input type="text" name="nrtn" class="form-control" id="nrtn" size="100">
	</td>
  </tr>
  

  
  
  
  
  <tr >
    <td colspan="4" align="right"><input type="submit" class="btn btn-success" value="Submit"></td>
  </tr>
 
</table>
</div>
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="left" width="20%">
<font size="3"><b>Branch :</b></font><br>
<select name="bcd" class="form-control" size="1" id="bcd" >
<?php 
if($user_current_level<0)
{
?>
<option value="">---ALL---</option>
<?php 
}
if($user_current_level<0)
{
$query="Select * from main_branch";
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
$result1 = mysqli_query($conn,$query);
while ($R1 = mysqli_fetch_array ($result1))
{
$slb1=$R1['sl'];
$bnm1=$R1['bnm'];
?>
<option value="<?php  echo $slb1;?>"><?php  echo $bnm1;?></option>
<?php 
}
?>
</select>
</td>


<td align="left" width="25%">
<font size="3"><b>Customer :</b></font>
<input type="text" id="cs2" name="cs2" size="40" value="" onkeyup="get_cust_by_cs('cust_src_serch',this.value,'custid','','cs2')"  placeholder="Enter 3 Digit Name / 10 Digit Mobile No.">

<br>
<div id="cust_src_serch">
<select id="custid" name="custid" tabindex="1"  class="form-control" >
	<option value="">---ALL---</option>
	<?php /*
		$query2="select * from main_cust WHERE sl>0  and typ='1' order by nm";
		$result2=mysqli_query($conn,$query2);
		while($rw2=mysqli_fetch_array($result2))
		{
			?>
			<option value="<?php  echo $rw2['sl'];?>"><?php  echo $rw2['nm'];?> --  <?php  echo $rw2['cont'];?></option>
			<?php 
		}*/
	?>
</select>
</div>
</td>
<td align="left" width="15%">
<font size="3"><b>From Date : </b></font>
<input type="text" id="fdt" name="fdt" value="<?php echo date('01-M-Y');?>" class="form-control" >
</td>
<td align="left" width="15%">
<font size="3"><b>To Date : </b></font>
<input type="text" id="tdt" name="tdt" value="<?php echo date('d-M-Y');?>" class="form-control" >
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

<!-- Modal Box Start-->
<div class="modal" id="myModal">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h4>Income Update</h4>
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
  $('#cid').chosen({
  no_results_text: "Oops, nothing found!",
  
  });
  $('#custid').chosen({
  no_results_text: "Oops, nothing found!",
  
  });



  </script>

</div>
</html>