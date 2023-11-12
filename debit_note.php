<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$tdt = date('d-m-Y');
$fdt3 = date('Y');
$m = date('m');
$fdt="01-04-".$fdt3;

if($m<4)
{
$fdt1=$fdt3-1;	
}
else
{
$fdt1=$fdt3;

}
//echo $fdt1;

$fdt="01-04-".$fdt1;
?>
<html>
 <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<head>
       
<style type="text/css"> 


input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
color:red;
}
#boxpopup{

left:100%;
position:fixed;
}

select.sc {
	width: 450px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 5px;
}
select.rf {
	width: 100px;
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


<script type="text/javascript" src="ajax.js"></script>


<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

   
      <link rel="stylesheet" href="dark-hive/jquery.ui.all.css" type="text/css">
<style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
/* Show in default resolution screen*/
#container2 {
width: 960px;
position: relative;
margin:0 auto;
line-height: 1.4em;
}

/* If in mobile screen with maximum width 479px. The iPhone screen resolution is 320x480 px (except iPhone4, 640x960) */    
@media only screen and (max-width: 479px){
    #container2 { width: 90%; }
}
</style>



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
   
   $("#fdt").datepicker(jQueryDatePicker2Opts);
   $("#fdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
   $("#tdt").datepicker(jQueryDatePicker2Opts);
   $("#tdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
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
function show()
{
var sup=document.getElementById('sup').value;
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
$('#show').load('purchase_list_dnote.php?fdt='+fdt+'&tdt='+tdt+'&sup='+sup).fadeIn('fast');
}

function get_gst()
{
sup=document.getElementById('sup').value;	
$('#gst_div').load('get_gst_comp.php?sup='+sup).fadeIn('fast');
}
function get_refno()
{
dt=document.getElementById('dt').value;	

$('#refno_div').load('get_refno.php?dt='+dt).fadeIn('fast');
}
   </script>
   <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="chosen.css">
	</head>
 <body  >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                Debit Note
                        
                    </h1>
					
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Debit Note</li>
                    </ol>
                </section>
                 <section class="content">
 					
<?
$dt=date('Y-m-d');
$m=date('m', strtotime($dt));
$y=date('y', strtotime($dt));;
if($m>=4)
{
$yy=$y."-".($y+1)."/";	
	
}
elseif($m<=3)
{
$yy=($y-1)."-".$y."/";	
}
$yy1="CD".$yy."%";
$query51="select * from main_cdnr where refno!='' and refno like '$yy1' order by sl";
$result51 = mysqli_query($conn,$query51);
while($rows=mysqli_fetch_array($result51))
{	
$vnos=$rows['refno'];
}	
$vid1=substr($vnos,8,5);	
$count6=5;
while($count6>0)
{
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);
$refno="CD".$yy.$vnoc;
$query5="select * from main_cdnr where refno='$refno'";
$result5 = mysqli_query($conn,$query5);
$count6=mysqli_num_rows($result5);
}
?>					
					
<form name="form1" id="form1" method="post" action="debit_notes.php" onsubmit="return check()">
<input type="hidden" id="abc" name="abc" value=""size="150">
        <div class="box box-success" >

<table class="table table-hover table-striped table-bordered" >
<tr>
<td align="left" width="33%">
<b>Supplier :</b>
<br>
<select id="sup" data-placeholder="Choose Your Supplier" name="sup"  class="form-control" tabindex="2" style="width:100%" onchange="get_gst()">
<option value="">---Select---</option>
<?
$sql1="SELECT * FROM main_suppl ORDER BY spn";
$result1 = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($result1))
{
?>
<option value="<?=$row1['sl'];?>"><?=$row1['spn'];?></option>
<?
}
?>
</select>
</td>
<td align="left" width="33%">
<b>From  :</b>
<input type="text" name="fdt" id="fdt" class="form-control" value="<?=$fdt;?>" >
</td>

<td align="left" width="33%">
<b>To  :</b>
<input type="text" name="tdt" id="tdt" class="form-control" value="<?=$tdt;?>" >
</td>
</tr>
<tr>
<td align="left">
<b>GSTIN  :</b>
<div id="gst_div">
<input type="text" name="sgstin" id="sgstin" class="form-control" value="" required>
</div>

</td>
<td align="left" >
<b>Name  :</b>
<input type="text" name="name" id="name" class="form-control" value="" required>
</td>
<td align="left" >
<b>Note No.  :</b>
<input type="text" name="note_no" id="note_no" class="form-control" value="" required>
</td>
</tr>
<tr>
<td align="left">
<b>Note Date  :</b>
<input type="text" name="dt" id="dt" class="form-control" value="<?=date('d-m-Y');?>" required onchange="get_refno()">
</td>
<td align="left" >
<b>Invoice No.  :</b>
<input type="text" name="inv" id="inv" class="form-control" value="" required>
</td>
<td align="left" >
<b>Invoice Date  :</b>
<input type="text" name="invdt" id="invdt" class="form-control" value="" required>
</td>
</tr>

<tr>
<td align="left">
<table width="100%">
<tr>
<td style="display:none;">
<b>Refno :</b>
<div id="refno_div">
<input type="text" name="refno" id="refno" class="form-control" value="<?=$refno;?>" readonly required>
</div>
</td>
<td width="100%">
<b>Note Type  :</b>
<select name="note_typ"  id="note_typ"  class="form-control"  required>
<option value="" >---Select---</option>
<option value="C">Credit</option>
<option value="D">Debit</option>
</select>
</td>
</tr>
</table>
</td>
<td align="left" >
<b>Type  :</b>
<select id="typ" name="typ"  class="form-control" tabindex="2" >
<option value="Cash-Discount">Cash-Discount</option>
<option value="Rate-Difference">Rate-Difference</option>
<option value="Scheme">Scheme</option>
<option value="Breakage">Breakage</option>
<option value="Shortage">Shortage</option>
<option value="Return">Return</option>
</select>
</td>
<td align="left" >
<b>Supply Type  :</b>
<select name="styp"  id="styp"  class="form-control"  required>
<option value="" >---Select---</option>
<option value="Inter-State">Inter-State</option>
<option value="Intra-State">Intra-State</option>

</select>
</td>
</tr>

<tr>
<td align="left" >
<b>Note Value (Taxable Value ) :</b>
<input type="text" name="amm" id="amm" class="form-control" value="" onblur="cal()" required onkeypress="return isNumber(event)">
</td>
<td align="left">
<table width="100%">
<tr>
<td width="50%">
<b>Tax Rate(%) :</b>
<input type="text" name="tax_rate" id="tax_rate" class="form-control" onblur="cal()" value="" onkeypress="return isNumber(event)">
</td>
<td  width="50%">
<b>Tax Amount :</b>
<input type="text" name="tax" id="tax" class="form-control" value=""  required onkeypress="return isNumber(event)">
</td>
</tr>
</table>
</td>

<td align="left" >
<b>Net Amount :</b>
<input type="text" name="net" id="net" class="form-control" value=""  required onkeypress="return isNumber(event)" >
</td>
</tr>

<tr>
<td colspan="3" align="right">
<input type="button" value="Show" class="btn btn-info" onclick="show()">
<input type="submit" value="Submit" class="btn btn-success">
</td>
</tr>		  


 </table>
</div> 

  <div class="box box-success" id="show" >
 
  
  </div>

  
       
</form>


	 
                               
						
							
                               
                  
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->
 </section><!-- /.content -->
                
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     

    </body>
	
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>
$('#sup').chosen({
no_results_text: "Oops, nothing found!",
});
$('#dldgr').chosen({
no_results_text: "Oops, nothing found!",
});
function cal()
{
into=0;  
net=0;  
amm=parseFloat(document.getElementById('amm').value); if(document.getElementById('amm').value==''){amm=0;}
tax=parseFloat(document.getElementById('tax').value); if(document.getElementById('tax').value==''){tax=0;}
tax_rate=parseFloat(document.getElementById('tax_rate').value); if(document.getElementById('tax_rate').value==''){tax=0;}  

into=(amm*tax_rate)/100;
net=into+amm;

if(!isNaN(net))
  {document.getElementById('net').value=net;}
if(!isNaN(into))
  {document.getElementById('tax').value=into;}
}
</script>
<script>
</div>
</html>