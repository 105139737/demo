<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";
?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<style type="text/css"> 
th{
text-align:center;
color:red;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
</style> 
<script>

</script>
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
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
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

$("#fdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#tdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

$("#fdt").datepicker(jQueryDatePicker2Opts);
$("#tdt").datepicker(jQueryDatePicker2Opts);
});
</script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>


	</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                    LG/Haier Sync Details
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">LG/Haier Sync Details</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">			
<form method="post" action="lg_sale_xml_custom.php" name="form1"  id="form1">
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="left"  ><b>Sync Status:</b><br>
<select name="stat" class="form-control" size="1" id="stat">
<option value="">---All---</option>
<option value="0" selected>Pending</option>
<option value="1">Done</option>
</select>
</td>
<td  align="left">
<b>Brand :</b><br>
<select name="cat" class="form-control" size="1" id="cat" tabindex="8">
<?php 
$data11 = mysqli_query($conn,"Select * from main_catg where sl=2 or sl=1 order by sl");
while ($row11 = mysqli_fetch_array($data11))
{
$bsl=$row11['sl'];
$brnm=$row11['cnm'];
echo "<option value='".$bsl."'>".$brnm."</option>";
}
?>
</select>
</td>
<td align="left"  ><b>Branch:</b><br>
<select name="brncd" class="form-control" size="1" id="brncd"   >
<?php 
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<option value="">---All---</option>
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
<option value="<?php  echo $sl;?>"><?php  echo $bnm;?></option>
<?php 
}
?>
</select>
</td>
<td align="left" >
<b>Bill No :</b>
<input type="text" id="blno" name="blno" class="form-control" >
</td>
<td align="left" >
<b>Serial No. :</b>
<input type="text" id="betno" name="betno" class="form-control" >
</td>
<td align="left" ><b>Form:</b><br>
<input type="text" id="fdt" name="fdt" size="13" value="<?php echo date('d-m-Y');?>" class="form-control" placeholder="Please Enter From Date" > </td>
<td align="left" ><b>To:</b><br>
<input type="text" id="tdt" name="tdt" size="13" value="<?php echo date('d-m-Y');?>" class="form-control" placeholder="Please Enter To Date">
</td>

</tr>
<tr>
<td colspan="7" align="right" style="padding-right:80px">
<input type="button" value=" Show " class="btn btn-success" onclick="show()">
<input type="button" value=" Export To Excel " class="btn btn-info" onclick="xls()">
<input type="submit" value=" LG Sale Sync Now " class="btn btn-success" >
<?php  if(strtoupper($user_currently_loged)=='ADMIN' OR strtoupper($user_currently_loged)=='HDADMIN')
{?>
<input type="button" class="btn btn-danger" value="LG Stock Sync Now" onclick="stk_xml()">
<input type="button" class="btn btn-info" value="LG Shoppe Stock Sync Now" onclick="stk_xml_shoppe()">
<?php  }?>
<input type="button" class="btn btn-danger" value="Reset" onclick="resets()">
</td>
</tr>


</tbody>
</table>
<div id="data8" style="overflow-x:auto;">
</div>
<div id="can88"></div>
	 
                                </div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                       
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>


function show()
{
var blno=encodeURIComponent(document.getElementById('blno').value);
var betno=encodeURIComponent(document.getElementById('betno').value);
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var brncd= document.getElementById('brncd').value;
var stat= document.getElementById('stat').value;
var cat= document.getElementById('cat').value;
$('#data8').load('lg_syncs.php?blno='+blno+'&fdt='+fdt+'&tdt='+tdt+'&brncd='+brncd+'&betno='+betno+'&stat='+stat+'&cat='+cat).fadeIn('fast');
}

function xls()
{
var blno=encodeURIComponent(document.getElementById('blno').value);
var betno=encodeURIComponent(document.getElementById('betno').value);
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var brncd= document.getElementById('brncd').value;
var stat= document.getElementById('stat').value;
var cat= document.getElementById('cat').value;
window.open('lg_sync_xls.php?blno='+blno+'&fdt='+fdt+'&tdt='+tdt+'&brncd='+brncd+'&betno='+betno+'&stat='+stat+'&cat='+cat,'_blank');
}




function stk_xml()
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
if(fdt=="" || tdt==""){alert("Please select date");return;}
window.open('lg_stock_xml.php?fdt='+fdt+'&tdt='+tdt, '_blank');    
}

function stk_xml_shoppe()
{
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
if(fdt=="" || tdt==""){alert("Please select date");return;}
window.open('lg_stock_xml_shoppe.php?fdt='+fdt+'&tdt='+tdt, '_blank');    
}
function resets()
{
var blno=encodeURIComponent(document.getElementById('blno').value);
var betno=encodeURIComponent(document.getElementById('betno').value);
if(blno=="" && betno=="")
{
    alert("PLease Enter Bill No/Serial No");
    return;
}
$('#data8').load('lg_sync_reset.php?blno='+blno+'&betno='+betno).fadeIn('fast');
}
</script>
    </body>
</html>