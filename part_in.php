<?php 
$reqlevel = 3;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$dt=date('d-M-Y');
include "header.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />

<style type="text/css"> 
a
{
   color: black;
   outline: none;
   text-decoration: none;
   
}
</style>
<link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

   
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
   $("#idt").datepicker(jQueryDatePicker1Opts);
});


</script>
 <script>
 function check(evt)
{
evt =(evt) ? evt : window.event;
var charCode = (evt.which) ? evt.which : evt.keyCode;						// ONLY NUMBER FOR NUMBER FIELD
if(charCode > 31 && (charCode < 48 || charCode > 57))
{
return false;
}
 return true;	
}
 function check2(evt)
{
	evt =(evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if(charCode > 31 && (charCode < 48 || charCode > 57) && (charCode > 46 || charCode <46 ))
	{
		return false;
	}
	return true;	
}

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
				var stra = str.split("@")
				var fstr1 = stra.shift()
				var addr = stra.shift()  
                var mob = stra.shift() 
                var mail = stra.shift() 
    $('#addr').val(addr);
    $('#mob').val(mob);
    $('#mail').val(mail);
     
}); 

	}
}

function addspnm()
{
	var snm=encodeURIComponent(document.getElementById('snm').value);
	var pnm=encodeURIComponent(document.getElementById('cpnm').value);
	var addr=encodeURIComponent(document.getElementById('addr1').value);
	var email=encodeURIComponent(document.getElementById('email').value);
	var mob1=encodeURIComponent(document.getElementById('mob1').value);
	var mob2=encodeURIComponent(document.getElementById('mob2').value);

	
	$('#adpnm').load("adsups.php?snm="+snm+"&pnm="+pnm+"&addr="+addr+"&email="+email+"&mob2="+mob2+"&mob1="+mob1).fadeIn('fast');

}



	function add()
	{
		pnm=document.getElementById('pnm').value;
		qnty=document.getElementById('qnty').value;
		prate=document.getElementById('prate').value;
		betno=encodeURIComponent(document.getElementById('betno').value);
		iwa=document.getElementById('iwa').value;
		owa=document.getElementById('owa').value;
		$('#wb_Text13').load("paadtmppr.php?pnm="+pnm+"&qnty="+qnty+"&prate="+prate+'&betno='+betno+'&iwa='+iwa+'&owa='+owa).fadeIn('fast');
		$('#pnm').trigger('chosen:open');
		document.getElementById('qnty').value='';
		document.getElementById('prate').value='';
		document.getElementById('betno').value='';
		document.getElementById('iwa').value='';
		document.getElementById('owa').value='';
		
	}

function deltpr(tsl)
	{
		
		
	$('#wb_Text13').load("padeltpr.php?tsl="+tsl).fadeIn('fast');
	}
		function tmppr1()
	{
		
		$('#wb_Text13').load("patmppr.php").fadeIn('fast');
			
		
	}

	function check1()
	{
	if(document.form1.dt.value=='')
		{
			alert("Please Select Date !!");
			document.form1.dt.focus();
			return false;
		}
			if(document.form1.rmk.value=='')
		{
			alert("Please Enter Remark !!");
			document.form1.rmk.focus();
			return false;
		}
else
	{
   document.forms["form1"].submit();
	}}

	
	function cal()
{  
	var prate=document.getElementById('prate').value;
  var qnty=document.getElementById('qnty').value;
	var lttl=qnty*prate;
	$('#lttl').val(lttl);
 
}


	function pmod(mdt)
	{
	if(mdt=="1")
	{ 
		document.getElementById('gtdl1').style.display='none';
		document.getElementById('crfno').value='';
		document.getElementById('idt').value='';
		document.getElementById('cbnm').value='';
    }
	else
	{
	  document.getElementById('gtdl1').style.display='table-row';
	}
	}
		function v()
	{
	var lcd=document.getElementById('lcd').value;
	var lfr=document.getElementById('lfr').value;
	var vat=document.getElementById('vat').value;
	var lfr=document.getElementById('lfr').value;
	var tamm1=parseFloat(document.getElementById('tamm1').value);
	
	var vatamm=(tamm1*vat)/100;
	document.getElementById('vatamm').value=vatamm;
	document.getElementById('tamm').value=(tamm1+vatamm)-lcd-lfr;
		
	}
	function t()
{

	$('#pay').load('parttl.php').fadeIn('fast');
}
  
 </script>
</head>
<body onload="tmppr1()" >
 <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Part Purchase
                        <small>Purchase</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Part Purchase</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<form name="form1" method="post" action="part_ins.php" id="form1" onsubmit="return check1()" enctype="multipart/form-data" >
<input type="hidden" name="flnm" id="flnm" value="income.php" >
 <div class="box box-success" >
<table border="0"   align="center" class="table table-hover table-striped table-bordered">
<tr>
  <td align="right" style="padding-top:15px;" width="20%"><b>Company Name :</b>
  </td>
  <td colspan="3" > 
  
  <select id="sup" name="sup" tabindex="1"  class="form-control" onchange="gtid()" >
	<option value="">---Select---</option>
	<option value="Add">---Add New---</option>
	<?php 
		$query="select * from main_suppl  WHERE sl>0 order by nm";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
			?>
			<option value="<?php  echo $rw['sl'];?>"><?php  echo $rw['spn'];?> <?php if($rw['nm']!=""){?>( <?php  echo $rw['nm'];?> )<?php }?></option>
			<?php 
		}
	?>
	</select>
	
  </td>

  </tr>
  <tr>
   <td align="right" style="padding-top:15px;"><b>Address : </b></td>

<td >
 <input type="tex"  class="form-control" style="font-weight: bold;" id="addr" readonly="true" name="addr" value=""  placeholder="Customer Address">
 </td>
   <td align="right" style="padding-top:15px;"><b>Contact No. :</b></td>

<td>
<input type="text" id="mob" class="form-control" style="font-weight: bold;" readonly="true" name="mob" value="" size="35" placeholder="Customer Contact No.">
 </td>
  </tr>
  <tr>

   <td align="right" style="padding-top:15px;"><b>E-Mail :</b></td>

<td>
<input type="text" id="mail" class="form-control" style="font-weight: bold;" readonly="true" name="mail" value=""  size="35" placeholder="Customer E-Mail">
 </td>



		 
			<td  align="right" style="padding-top:17px" width="20%"><b>Godown :</b></td>
            <td  align="left" width="30%">
		<select name="branch" class="form-control" size="1" id="branch" tabindex="8"  required>
				
<?php 
if($user_current_level<0)
{
$data2 = mysqli_query($conn,"Select * from main_branch order by sl");
}
else
{$data2 = mysqli_query($conn,"Select * from main_branch where sl='$branch_code'");}
		while ($row1 = mysqli_fetch_array($data2))
	{
	$sl=$row1['sl'];
	$bnm=$row1['bnm'];
	echo "<option value='".$sl."'>".$bnm."</option>";
	}
	
 

?>
</select>
            </td></tr>
			<tr>

<td align="right" style="padding-top:15px;"> <b>Invoice No. : </b></td>
  <td>
  <input type="text" class="form-control"  id="inv"  name="inv" value="" size="35" placeholder="Enter Invoice No...">
  </td>
			
		
			    <td align="right"  width="15%" style="padding-top:15px;"><font color="red">* </font><b>Date :</b></td>
            <td align="left" width="30%" >
            <input type="text" class="span2 form-control" name="dt" id="dt" size="20" value="<?php  echo $dt;?>" required >
			</td>
			
		
          </tr>
          <tr>
		  	<td align="right" style="padding-top:15px;" ><font color="red">* </font><b>Remark :</b></td>
            <td align="left" colspan="3"  >
            <input type="text" class="span2 form-control" name="rmk" id="rmk" size="20"  >
			</td>
          </tr>
		  </table>

<div class="box-body" >
</div> 
<table border="0" width="100%" class="advancedtable">
	
	  <table width="100%" class="table table-hover table-striped table-bordered">
	   <tr>
	   <td colspan='10'>
 <table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td  align="left" width="15%"><b>Particulars</b></td>
<td align="center" width="15%" ><b>Part Code</b></td>
<td align="center" width="12%" ><b>Quantity</b></td>
<td align="center" width="12%" ><b>Purchase Rate</b></td>
<td align="center" width="12%" ><b>In Warranty Amount</b></td>
<td align="center" width="12%" ><b>Out Warranty Amount </b></td>
<td align="center" width="12%" ><b>Total</b></td>
<td align="center" width="10%"><b>Action</b></td>
</tr>


<tr>
<td > 
<select id="pnm" style="width:100%;" name="pnm" class="sc1"  tabindex="1">
		<option value="">---Select---</option>
		<?php 

   $result56 = mysqli_query($conn,"Select * from ".$DBprefix."parts");
while ($R56 = mysqli_fetch_array ($result56))
{
$psl=$R56['sl'];
$pnm=$R56['pnm'];
$bnm=$R56['bnm'];
$cat=$R56['cat'];
$cnm="";
$data1= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$cnm=$row1['cnm'];
}
$brand="";
$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$brand=$row1['brand'];
}

?>

<option value="<?php  echo $psl?>"><?php  echo $pnm?> - <?php  echo $cnm?> - <?php  echo $brand?></option>
<?php }?>
			</select>
</td>
<td>
<input type="text" id="betno" class="sc"  tabindex="2"  name="betno" value=""  >
</td>
<td>
<input type="text" id="qnty" class="sc" autocomplete="off" tabindex="2" onblur="cal()" name="qnty" value="" onkeypress="return check(event)" style="text-align:center">
</td>
<td>
<input type="text" id="prate" class="sc" autocomplete="off" tabindex="3"  onblur="cal()" name="prate" value="" onkeypress="return check2(event)" style="text-align:center">
 </td>
 <td>
<input type="text" id="iwa" class="sc" autocomplete="off" tabindex="3"   name="iwa" value="" onkeypress="return check2(event)" style="text-align:center">
 </td>
 <td>
<input type="text" id="owa" class="sc" autocomplete="off" tabindex="3" name="owa" value="" onkeypress="return check2(event)" style="text-align:center">
 </td>
<td>
<input type="text" id="lttl" class="sc" autocomplete="off" tabindex="4" name="lttl"  readonly value=""  style="text-align:center">
 </td>
 



<td>
<input type="button" class="btn btn-primary btn-xs" id="Button1" name="" tabindex="5" value="Add"  onclick="add()" style="width:100%;" >
</td>
</tr>
</table>
 </td>
	   </tr>
	       <tr height="230px">
	   <td colspan='10'>
	<div id="wb_Text13" >

		</div>
	  	</td>
	   </tr>
	   	   
<tr>

<td align="right" style="padding-top:15px;" ><b>
Less Cash Discount :</b>
</td>
<td align="left"  >
<input type="text" name="lcd" id="lcd"  class="form-control" style="text-align:right"  value="" onblur="v()">
</td>
<td align="right" style="padding-top:15px;" ><b>
Less Fright :</b>
</td>
<td align="left" >
<input type="text" name="lfr" id="lfr" class="form-control" style="text-align:right" onblur="v()" >

</td>

<td align="right"  style="padding-top:15px">
<b>Vat.(%) :</b>
</td>
<td align="left" >
<input type="text" name="vat" id="vat" onblur="v()" class="form-control"  style="text-align:right" >

</td>
<td align="right"  style="padding-top:15px">
<b>Vat Amount :</b>
</td>
<td align="left" >
<input type="text" name="vatamm" id="vatamm" class="form-control" style="background-color:#f3f4f5;text-align:right" readonly="true" >

</td>


<td  align="right" style="padding-top:15px;" >
<b>Pay Amount :</b>
</td>
<td align="center" >
<font size="3">
<b>
<div id="pay">
<input type="text" name="tamm" id="tamm" class="form-control" style="background-color:#f3f4f5;" readonly="true"> 
</div>
</b>
</font>
</td>


</tr>
<tr>
<td align="right" style="padding-top:15px"><font color="red">*</font><b>Cash Or Bank Ac. :</b></td>
    <td align="left" >
	
		 <select  name="dldgr" id="dldgr"   class="form-control">
							<?php  
							$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='1' or gcd='2'") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?php  echo $row['sl']?>"<?php  echo $row['sl'] == '3' ? 'selected' : '' ?>><?php  echo $row['nm']?></option>
							<?php  
							} 
							?>
						</select>
	</td>
<td align="right" style="padding-top:15px;"> <b>Payment Mode: </b></td>
<td><select name="mdt" size="1" id="mdt" tabindex="10" onchange="pmod(this.value)" class="form-control">

<?php 
if($user_current_level!=-1)
							{
							$query1="select * from ac_paymtd where sl='1'";
							}
							else
							{
							$query1="select * from ac_paymtd";
							}
$data2 = mysqli_query($conn,$query1);

		while ($row2 = mysqli_fetch_array($data2))
	{
	$mtd = $row2['mtd'];
	$msl = $row2['sl'];
	echo "<option value='".$msl."'>".$mtd."</option>";
	}
	?>
</select>
 </td>
<td align="right" style="padding-top:15px;"><b>Payment Amount:</b> </td>
<td><input type="text"  class="form-control" id="pamm" name="pamm" value="" <?php if($user_current_level!=-1){echo 'readonly';}?>  placeholder="<?php if($user_current_level!=-1){echo 'Cash Sale Only';}else{echo 'Enter Payment Amount';}?>" size="25"></td>

</tr>
<tr id="gtdl1" style="display:none">
<td align="right" style="padding-top:15px;"> <b>Reference No: </b></td>
<td>
<input type="text" class="form-control" id="crfno"  name="crfno" value="" >
</td>
<td align="right" style="padding-top:15px;"> <b>Date: </b></td>
<td>
<input type="text" class="form-control" id="idt" name="idt" value="" readonly >
</td>
<td align="right" style="padding-top:15px;"> <b>Issued By:</b></td>
<td>
<input type="text" class="form-control" id="cbnm"  name="cbnm" value="" >
</td>

</tr>


 <tr class="odd" >
<td colspan="10" align="right">
<input type="submit" class="btn btn-success btn-sm" id="Button1" onclick="return confirm('Are Yoy Sure To Submit !'); " name="bt1" tabindex="15" value="Submit"  >
</td>
</tr>
	   </table>


				

		</div>
 </div><!-- /.box-body -->
      
			<div class="col-md-3" >
</div>
</div>


</form>
 </section><!-- /.content -->
 </aside><!-- /.right-side -->
 
 
 
 

	<!-- Light Box -->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true"  >
	<div class="modal-dialog"  style="width:700px;;">
		<div class="modal-content">
		 <div id="adpnm"></div>
			<div class="modal-body" id="cnt1">
			
			
			</div>
        </div>
    </div>
</div>
<!-- End -->
 
 
</body>
</div>


	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>
$('#sup').chosen({no_results_text: "Oops, nothing found!",});
$('#pnm').chosen({no_results_text: "Oops, nothing found!",});
</script>

	
	</html>

