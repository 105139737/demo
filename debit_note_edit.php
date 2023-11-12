<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$tdt = date('d-m-Y');
$fdt3 = date('Y');
$m = date('m');
$fdt="01-04-".$fdt3;
$ssl=$_REQUEST['sl'];
/**/
$data = mysqli_query($conn,"SELECT * FROM  main_cdnr where sl='$ssl'");
while ($row = mysqli_fetch_array($data))
  {
    $sup=$row['sup'];
    $sgstin=$row['sgstin'];
    $name=$row['name'];
    $note_no=$row['note_no'];
    $dt1=$row['dt'];
    $dt=date("d-m-Y", strtotime($dt1));
    $inv=$row['inv'];
    $notetyp=$row['note_typ'];
    $amm=$row['amm'];
    $styp=$row['styp'];
    $invdt1=$row['invdt'];
    $typ=$row['typ'];
    $tax_rate=$row['tax_rate'];
    $tax=$row['tax'];
    $net=$row['net'];
    $refno=$row['refno'];
    $dsl=$row['dsl'];
    $invdt=date("d-m-Y", strtotime($invdt1));
  }
/**/
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
/*function show()
{
var sup=document.getElementById('sup').value;
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
$('#show').load('purchase_list_dnote.php?fdt='+fdt+'&tdt='+tdt+'&sup='+sup).fadeIn('fast');
}*/

function get_gst()
{
sup=document.getElementById('sup').value;	
$('#gst_div').load('get_gst_comp.php?sup='+sup).fadeIn('fast');
}
/*function get_refno()
{
dt=document.getElementById('dt').value;	

$('#refno_div').load('get_refno.php?dt='+dt).fadeIn('fast');
}*/
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
 					
					
					
<form name="form1" id="form1" method="post" action="debit_note_edits.php" onsubmit="return check()">
<input type="hidden" id="sl" name="sl" value="<?=$ssl;?>">
<input type="hidden" name="dsl" value="<?=$dsl;?>">
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
<option value="<?=$row1['sl'];?>" <?if($sup==$row1['sl']){echo "selected";}?>><?=$row1['spn'];?></option>
<?
}
?>
</select>
</td>

<td align="left">
<b>GSTIN  :</b>
<div id="gst_div">
<input type="text" name="sgstin" id="sgstin" class="form-control" value="<?=$sgstin;?>" required>
</div>

</td>
<td align="left" >
<b>Name  :</b>
<input type="text" name="name" id="name" class="form-control" value="<?=$name;?>" required>
</td>
</tr>
<tr>
<td align="left" >
<b>Note No.  :</b>
<input type="text" name="note_no" id="note_no" class="form-control" value="<?=$note_no;?>" required>
</td>

<td align="left">
<b>Note Date  :</b>
<input type="text" name="dt" id="dt" class="form-control" value="<?=$dt;?>" required >
</td>
<td align="left" >
<b>Invoice No.  :</b>
<input type="text" name="inv" id="inv" class="form-control" value="<?=$inv;?>" required>
</td>
</tr>
<tr>
<td align="left" >
<b>Invoice Date  :</b>
<input type="text" name="invdt" id="invdt" class="form-control" value="<?=$invdt;?>" required>
</td>

<td align="left">
<table width="100%">
<tr>
<td style="display:none;">
<b>Refno :</b>
<div id="refno_div"></div>
<input type="text" name="refno" id="refno" class="form-control" value="<?=$refno;?>" readonly required>

</td>
<td width="100%">
<b>Note Type  :</b>
<select name="note_typ"  id="note_typ"  class="form-control"  required>
<option value="" >---Select---</option>
<option value="C" <?if($notetyp=='C'){echo "selected";}?>>Credit</option>
<option value="D" <?if($notetyp=='D'){echo "selected";}?>>Debit</option>
</select>
</td>
</tr>
</table>
</td>
<td align="left" >
<b>Type  :</b>
<select id="typ" name="typ"  class="form-control" tabindex="2" >
<option value="Cash-Discount"<?if($typ=='Cash-Discount'){echo "selected";}?>>Cash-Discount</option>
<option value="Rate-Difference"<?if($typ=='Rate-Difference'){echo "selected";}?>>Rate-Difference</option>
<option value="Scheme"<?if($typ=='Scheme'){echo "selected";}?>>Scheme</option>
<option value="Breakage"<?if($typ=='Breakage'){echo "selected";}?>>Breakage</option>
<option value="Shortage"<?if($typ=='Shortage'){echo "selected";}?>>Shortage</option>
<option value="Return"<?if($typ=='Return'){echo "selected";}?>>Return</option>
</select>
</td>
</tr>
<tr>
<td align="left" >
<b>Supply Type  :</b>
<select name="styp"  id="styp"  class="form-control"  required>
<option value="" >---Select---</option>
<option value="Inter-State" <?if($styp==Inter-State){echo "selected";}?>>Inter-State</option>
<option value="Intra-State" <?if($styp==Inter-State){echo "selected";}?>>Intra-State</option>

</select>
</td>

<td align="left" >
<b>Note Value (Taxable Value ) :</b>
<input type="text" name="amm" id="amm" class="form-control" value="<?=$amm;?>" onblur="cal()" required onkeypress="return isNumber(event)">
</td>
<td align="left">
<table width="100%">
<tr>
<td width="50%">
<b>Tax Rate(%) :</b>
<input type="text" name="tax_rate" id="tax_rate" class="form-control" value="<?=$tax_rate;?>" onkeypress="return isNumber(event)">
</td>
<td  width="50%">
<b>Tax Amount :</b>
<input type="text" name="tax" id="tax" class="form-control" value="<?=$tax;?>" onblur="cal()" required onkeypress="return isNumber(event)">
</td>
</tr>
</table>
</td>
</tr>

<tr>
<td align="left" >
<b>Net Amount :</b>
<input type="text" name="net" id="net" class="form-control" value="<?=$net;?>" onblur="cal()" required onkeypress="return isNumber(event)">
</td>
</tr>

<tr>
<td colspan="3" align="right">
<input type="submit" value="Update" class="btn btn-success">
</td>
</tr>		  
 </table>
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
amm=parseFloat(document.getElementById('amm').value); if(document.getElementById('amm').value==''){amm=0;}
tax=parseFloat(document.getElementById('tax').value);if(document.getElementById('tax').value==''){tax=0;}  
document.getElementById('net').value=amm+tax;
}
</script>
<script>
</div>
</html>