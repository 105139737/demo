<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$brncd=$_REQUEST['brncd'];
$dsl=$_REQUEST['sl'];
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

document.getElementById('amm').value='';
document.getElementById('nrtn').value='';

$('#drcr').val('');
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
	$('#cnt').load('op_cust_det.php?sl='+sl).fadeIn("fast");
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
$("#showdiv").load("op_cust_list.php?brncd="+brncd+"&ldgr="+ldgr+"&cust="+cust).fadeIn('fast');	
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
                 Customer Opening Balance
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Customer Opening Balance</li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="op_custs.php" id="Form1">
<input type="hidden" id="proj" name="proj" value="0">
<input type="hidden" id="ldgr" name="ldgr" value="4">
<div class="box box-success">
<table width="860px" class="table table-hover table-striped table-bordered">
<tr class="even">
<td align="left" width="40%">
<font color="red">*</font><b>Branch :</b>
<select name="brncd" class="form-control" size="1" id="brncd"  onchange="title1();show()">
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
<td width="60%">
<font color="red">*</font><b>Customer :</b><br>
<select id="cust"  name="cust"  tabindex="1"  onchange="show()"  class="form-control" >
<option value="">---Select---</option>
<?php 
$query6="select * from  main_cust order by nm ";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
?>
<option value="<?php  echo $row['sl'];?>"><?php  echo $row['nm'];?> ( <?php  echo $row['cont']?> ) - <?php  echo $row['addr']?></option>
<?php }?>
</select>
</td>

</tr>

  <tr class="odd">

    <td align="left">
	<font>*</font><b>Amount :</b> <font color="red">Rs.</font><br>
	 <input type="text" name="amm" id="amm" size="16" style="width:250px;" value="" class="sc" >
<select  name="drcr" id="drcr" style="width:150px" class="sc">
<option value="">-- Select --</option>
<option value="1">Dr.</option>
<option value="-1">Cr.</option>
</select>
	</td>
    <td align="left" >
	<font color="red">*</font><b>Narration :</b>
      <input type="text" name="nrtn" id="nrtn" size="40"  class="form-control">
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
<script type="text/javascript">
 $('#cust').chosen({
  no_results_text: "Oops, nothing found!",
  });

  </script>
  <?php 
  if($dsl!='')
{
?>
<script>
sfdtl4('<?php  echo $dsl;?>');
</script>
<?php 	
}
?>
</div>
</html>