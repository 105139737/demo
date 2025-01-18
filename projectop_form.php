<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$brncd=$_REQUEST['brncd'] ?? "";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<div class="wrapper row-offcanvas row-offcanvas-left">
		<?php 
		include "left_bar.php";
		?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cupon Entry</title>
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
	color: #000;
	position : absolute;
	left : 350px;
	top : 250px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 13px;
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
   $(document).ready(function()
{
show();
});


 function mnu()
 {
 $('#pmnu').load('mnu.php').fadeIn("slow");
  $('#tmnu').load('mnu2.php').fadeIn("slow");
 }
 function si(val)
 {
	 $('#cs').load('cusi_ledgr.php?val='+val).fadeIn("slow"); 
	 if(val==4)
	 {
		 $('#c').html('Customer :');
	 }
	 else if(val==12)
	 {
		$('#c').html('Supplier :'); 
	 }
	 else
	 {
		 $('#c').html('');
	 }
	 
 }
  function si1(val)
 {
	 
	 $('#cs1').load('cusi_ledgr.php?val='+val).fadeIn("slow"); 
	 if(val==4)
	 {
		 $('#c1').html('Customer :');
	 }
	 else if(val==12)
	 {
		$('#c1').html('Supplier :'); 
	 }
	 else
	 {
		 $('#c1').html('');
	 }
	 
}

 function sfdtl4(sl)
{
	$('#cnt').load('projectop_form_det.php?sl='+sl).fadeIn("fast");
	$('#myModal').modal('show');
}
function title1()
{
var brncd=document.getElementById('brncd').value;
$("#title").load("brncd_name.php?brncd="+brncd).fadeIn('fast');	
}
function show()
{
var brncd=document.getElementById('brncd').value;
var ldgr=document.getElementById('ldgr').value;
var cust=document.getElementById('cust').value;
var sup=document.getElementById('sup').value;
$("#showdiv").load("projectop_form_list.php?brncd="+brncd+"&ldgr="+ldgr+"&cust="+cust+"&sup="+sup).fadeIn('fast');	
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

select.sc {
	width: 430px;
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
input.sc {
	width: 430px;
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
</head>
<body onload="title1()">
 <aside class="right-side">
  <section class="content-header">
                    <h1 align="center">
                 Opening Balance
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Opening Balance</li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="projectop_forms.php" id="Form1">

<div class="box box-success">
<table width="860px" class="table table-hover table-striped table-bordered">
<tr class="even">
<td align="right"><font color="red">*</font><b>Branch:</b></td>
<td align="left">
<select name="brncd" class="form-control" size="1" id="brncd" style="width:380px;" onchange="title1();show()">
<?php 
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
<option value="<?php  echo $slb;?>" <?php if($slb==$brncd){echo 'selected';}?>><?php  echo $bnm;?></option>
<?php 
}
?>
</select>
</td>
<td align="right" width="10%"><font color="red">*</font><b>Project No. :</b></td>
<td align="left" width="40%">
<select  name="proj" id="proj"  class="form-control" style="width:380px;" onchange="si(this.value)">

<option value="0">NA</option>
<?php  
$get1 = mysqli_query($conn,"SELECT * FROM main_project") or die(mysqli_error($conn));
while($row1 = mysqli_fetch_array($get1))
{
?>
<option value="<?php  echo $row1['sl']?>"><?php  echo $row1['nm']?></option>
<?php  
} 
?>
</select>




</td>  

</tr>
    <tr class="odd">
  
	<td align="right" width="10%"><font color="red">*</font><b>Ledger Head :</b></td>
    <td align="left" width="40%">
    <select  name="ldgr" id="ldgr"  class="form-control" style="width:380px;" onchange="si(this.value);show()">
							<option value="">-- Select --</option>
							<?php  
							$get = mysqli_query($conn,"SELECT * FROM main_ledg where sl!='-1' and sl!='4'") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?php  echo $row['sl']?>" ><?php  echo $row['nm']?></option>
							<?php  
							} 
							?>
						</select>
				
						
						
						
	</td>  
<td align="right" width="10%">
<div id="c">
</div>
</td>
 
    <td align="left" width="30%" >
	<div id="cs">
	<input type="hidden" id="cust" value="">

<input type="hidden" id="sup" value="">

	</div>
	</td>	
  </tr>
  
  <tr class="odd">
    <td align="right" width="10%"><font>*</font><b>Amount :</b></td>
    <td align="left" width="30%">
	<font color="red">Rs.</font> <input type="text" name="amm" id="amm" size="16" style="width:200px;" value="" class="sc" >
     <select  name="drcr" id="drcr" style="width:150px" class="sc">
							<option value="">-- Select --</option>
                            <option value="1">Dr.</option>
                            <option value="-1">Cr.</option>
     </select>
	</td>
	<td align="right" width="10%"><font color="red">*</font><b>Narration :</b></td>
    <td align="left" width="40%">
      <input type="text" name="nrtn" id="nrtn" size="40" style="width:280px;" class="form-control">
	</td>   
  </tr>
   
  
  <tr class="even">
    <td colspan="4" align="right">
	<input type="submit" class="btn btn-primary" value="Submit"></td>
  </tr>

</table>
</div>


<div class="box box-success" id="showdiv"></div>


<!-- Modal Box Start-->
<div class="modal" id="myModal">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h4>Opening Balance Edit</h4>
			</div>
			<div class="page" id="cnt" style="overflow: auto;"></div>
			<div id="ammd"></div>
		</div>
	</div>
</div>
<!-- Modal Box End -->

</form>
 </section><!-- /.content -->
 </aside><!-- /.right-side -->
</body>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>

$('#ldgr').chosen({
no_results_text: "Oops, nothing found!",

});
</script>
</div>
</html>