<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$brncd=$_REQUEST['brncd'] ?? "";

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
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
   $("#fdt").datepicker(jQueryDatePicker1Opts);
   $("#tdt").datepicker(jQueryDatePicker1Opts);
});

	
function sh()
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var dldgr= document.getElementById('dldgr').value;
var brsdt= document.getElementById('brsdt').value;
$('#show').load('brs_list.php?fdt='+fdt+'&tdt='+tdt+'&dldgr='+dldgr+'&brsdt='+brsdt).fadeIn('fast');

}
function xls()
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var dldgr= document.getElementById('dldgr').value;
var brsdt= document.getElementById('brsdt').value;

window.open('brs_xls.php?fdt='+fdt+'&tdt='+tdt+'&dldgr='+dldgr+'&brsdt='+brsdt);
}
	
function ttl()
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var dldgr= document.getElementById('dldgr').value;
var countt= document.getElementById('countt').value;
var brsdt= document.getElementById('brsdt').value;
//$('#tdv').load('brs_list_total.php?fdt='+fdt+'&tdt='+tdt+'&ldgr='+ldgr).fadeIn('fast');

    $.get('brs_list_total.php?fdt='+fdt+'&tdt='+tdt+'&ldgr='+dldgr+'&brsdt='+brsdt, function(data) {
        
                var str= data;
				var stra = str.split("@@")
				var total_dr = stra.shift()
				var total_cr = stra.shift() 
				var total_bal = stra.shift() 
				var bank_bal = stra.shift() 

				$('#total_cr').html(total_cr);
				$('#total_dr').html(total_dr);
				$('#total_cr1').html(total_cr);
				$('#total_dr1').html(total_dr);
				$('#total_bal').html(total_bal);				
				$('#total_bal1').html(total_bal);
				$('#bank_bal').val(bank_bal);
				for(i=1;i<=countt;i++)
				{
				$('#bank_st'+i).html(total_bal);	
				}
sys_bal=document.getElementById('sys_bal').value;
$('#total_bal_ac11').html((sys_bal-bank_bal).round(2));
			
}); 


}

function sedtt(sl,fn,fv,tblnm,div,dt,ldgr)
{
$("#brr"+div).load("gisedts_mod.php?sl="+encodeURIComponent(sl)+"&fn="+fn+"&fv="+encodeURIComponent(fv)+"&tblnm="+tblnm+"&dt="+dt+"&ldgr="+ldgr).fadeIn('fast');
}

   Number.prototype.round = function(places) {
  return +(Math.round(this + "e+" + places)  + "e-" + places);
}
</script>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
</head>

<body onload="sh()">
 <aside class="right-side">
  <section class="content-header">
                    <h1 align="center">
                 BRS
                        <small> Report</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">BRS Report</li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="jrnl_forms.php" id="Form1" >
<input type="hidden" name="proj" id="proj" value="NA" readonly>
<input type="hidden" name="it" id="it" value="NA" readonly >

<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="left" width="20%">
<font size="3"><b>From Date : </b></font>
<input type="text" id="fdt" name="fdt" value="<?php echo date('01-m-Y');?>" class="form-control" >
</td>
<td align="left" width="20%">
<font size="3"><b>To Date : </b></font>
<input type="text" id="tdt" name="tdt" value="<?php echo date('d-m-Y');?>" class="form-control" >
</td>
<td align="left" width="20%"><font size="3"></font><b>Cash Or Bank Ac. :</b></font>
<select  name="dldgr" id="dldgr" class="form-control">
<option value="">-- Select --</option>
<?php  
$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='1' or gcd='22'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?php  echo $row['sl']?>" ><?php  echo $row['nm']?></option>
<?php  
} 
?>
</select>
</td>
</td>
<td align="left" width="20%"><font size="3"></font><b>BRS Date :</b></font>
<select  name="brsdt" id="brsdt" class="form-control">
<option value="">-- ALL --</option>
<option value="YES">YES</option>
<option value="NO">NO</option>

</select>
</td>

<td align="center" width="20%"><br>
<input type="button" value=" Show " class="btn btn-info" onclick="sh()">
<input type="button" value=" Export To Excel " class="btn btn-success" onclick="xls()">
</td>
</tr>
</tbody>
</table>
</div>

<div class="box box-success" >
<div id="show">
</div>
<div id="pay">
</div>

</div>
											         <!-- COMPOSE MESSAGE MODAL -->
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
</div>
<script>
$('#dldgr').chosen({no_results_text: "Oops, nothing found!",});	
</script>

</html>