<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$fdt=date('Y-m-d');
$sls = $_REQUEST['sl'];
$get=mysqli_query($conn,"select * from main_billtype where sl='$sls'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
	
	$ssl=$row['sl'];
	$als=$row['als'];
	$tpa=$row['tp'];
	$adrs=$row['adrs'];
	$ssn=$row['ssn'];
	$brand=$row['brand'];
	$brncd=$row['brncd'];
	$start_no=$row['start_no'];
	$inv_typ=$row['inv_typ'];
	

}

$get1=mysqli_query($conn,"select * from main_billing where bill_typ='$ssl'") or die(mysqli_error($conn));
$countt=mysqli_num_rows($get1);

if($countt==0){
$get1=mysqli_query($conn,"select * from main_drcr where bill_typ='$ssl'") or die(mysqli_error($conn));
$countt=mysqli_num_rows($get1);
}

?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<style type="text/css"> 
th{
text-align:center;
color:#000;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
#sfdtl
{
	border : none;
	border-radius: 3px;
	background-image: url(images/bg1.png);
	width : 195px;
	
	display : none;
	color: #fff;
	position : absolute;
	left : 6%;
	top : 46%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	z-index:1000;
}
</style> 
<script>
</script>
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
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
<script type="text/javascript" language="javascript">
$(document).ready(function()
{
var jQueryDatePicker2Opts =
{
dateFormat: 'yy-mm-dd',
changeMonth: true,
changeYear: true,
showButtonPanel: false,
showAnim: 'show'
};
$("#fdt").datepicker(jQueryDatePicker2Opts);
$("#fdt").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
});
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
</script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>      
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Bill Type
                        <small>Update</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Bill Type Update</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body>
<div class="box box-success">
<form method="post" action="billtyp_edts.php" id="form1" name="form1">  
<input type="hidden" class="form-control" name="ssl" id="ssl" value="<?php  echo $ssl;?>">                  
<table border="0" class="table table-hover table-striped table-bordered">

<tr>
<td align="left" >
<b>Branch : </b>
<select name="brncd" class="form-control" tabindex="1"  size="1" id="brncd" >
<?php 
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<option value="">---Select---</option>
<?php 
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<?php  echo $sl;?>"<?php  if($sl == $brncd){echo 'selected';}?>><?php  echo $bnm;?></option>
<?php 
}
?>
</select>

</td>
<td  align="left">
<b>Address :</b>
<textarea class="form-control" name="adrs" id="adrs" required placeholder="Enter Address...."><?php  echo $adrs;?></textarea>
</td>
</tr>
<tr>
<td  align="left" >
<b>Type :</b>
<select name="tp" id="tp" class="form-control" required>
<option value="">--Select--</option>          		
<option value="1"<?php  if($tpa == '1'){echo 'selected';}?>>Retail</option>
<option value="2"<?php  if($tpa == '2'){echo 'selected';}?>>Wholesale</option>           		   
</select>
</td>
<td>
<b>Brand : </b>
<select name="brand[]" id="brand" class="form-control"  tabindex="1"  multiple>
<?php 
$dsql=mysqli_query($conn,"select * from main_catg where sl>0 and find_in_set(sl,'$brand')>0 order by sl") or die (mysqli_error($conn));
while($erow=mysqli_fetch_array($dsql))
{
$bsl=$erow['sl'];
$cnm=$erow['cnm'];
?>
<option value="<?php  echo $bsl;?>" selected><?php  echo $cnm;?></option>
<?php 
}
$dsql1=mysqli_query($conn,"select * from main_catg where sl>0 and find_in_set(sl,'$brand')=0 order by sl") or die (mysqli_error($conn));
while($erow1=mysqli_fetch_array($dsql1))
{
$bsl1=$erow1['sl'];
$cnm1=$erow1['cnm'];
?>
<option value="<?php  echo $bsl1;?>"><?php  echo $cnm1;?></option>
<?php 
}
?>
</select>
</td>
</tr>
<tr>
<td  align="left"  width="50%">
<b>Alise :</b>
<input type="text" class="form-control" name="als" id="als" <?php  if($countt>0){?> readonly <?php  } ?> required value="<?php  echo $als;?>" placeholder="Enter Alise....">
</td>
<td  align="left" width="50%">
<b>Session :</b>
<input type="text" class="form-control" name="ssn" required <?php  if($countt>0){?> readonly <?php  } ?> value="<?php  echo $ssn;?>" id="ssn" placeholder="Enter Session....">
</td>
</tr>
<tr>
<td  align="left" width="50%">
<b>Starting No. :</b>
<input type="text" class="form-control" name="start_no" id="start_no" value="<?php  echo $start_no;?>" required  tabindex="1"  onkeypress="return check(event)" placeholder="Enter Starting No. ....">
</td>
<td  align="left" width="50%">
<b>Invoice Type :</b>
<select name="inv_typ" id="inv_typ" class="form-control"  tabindex="1" required >
<option value="0" <?php  if($inv_typ == '0'){echo 'selected';}?>>Invoice</option>		
<option value="1" <?php  if($inv_typ == '1'){echo 'selected';}?>>Return</option>		
<option value="2" <?php  if($inv_typ == '2'){echo 'selected';}?>>Service</option>		
<option value="33" <?php  if($inv_typ == '33'){echo 'selected';}?>>Income</option>		
<option value="44" <?php  if($inv_typ == '44'){echo 'selected';}?>>Expense</option>		
<option value="J01" <?php  if($inv_typ == 'J01'){echo 'selected';}?>>Journal</option>		
<option value="CN01" <?php  if($inv_typ == 'CN01'){echo 'selected';}?>>Contra</option>		
<option value="77" <?php  if($inv_typ == '77'){echo 'selected';}?>>Customer Received</option>		
<option value="88" <?php  if($inv_typ == '88'){echo 'selected';}?>>Supplier Payment</option>		
<option value="C01" <?php  if($inv_typ == 'C01'){echo 'selected';}?>>Debit Note</option>		
<option value="CC01" <?php  if($inv_typ == 'CC01'){echo 'selected';}?>>Customer Credit Note</option>		

</select>
</td>
</tr>


<tr>
<td align="right" colspan="4" width="30%">
<input type="submit" class="btn btn-success" value="Update" name="B1" >
</td>
</tr>
</table>
      
   </div>



</form>

                       
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
 <link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>

$('#brand').chosen({
no_results_text: "Oops, nothing found!",
});
</script>   
</body>