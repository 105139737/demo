<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";

$sa=date('d-m-Y');
$saa=date('d-m-Y');
?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
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
                    Bill History
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Bill History</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">			
<form method="post" action="sale_xls.php" name="form1"  id="form1">
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="left"  ><b>Branch:</b><br>
<select name="brncd" class="form-control" size="1" id="brncd"   >
<?
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<option value="">---All---</option>
<?
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
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
</select>
</td>
<td align="left" width="25%"><b>Form:</b><br>
<input type="text" id="fdt" name="fdt" size="13" value="<?echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > </td>
<td align="left" width="25%"><b>To:</b><br>
<input type="text" id="tdt" name="tdt" size="13" value="<?echo $sa;?>" class="form-control" placeholder="Please Enter To Date">
</td>
<td align="left" width="20%">
<b>Bill No :</b>
<input type="text" id="blno" name="blno" class="form-control" >
</td>
</tr>
<tr>
<td colspan="5" align="right" style="padding-right:80px">
<input type="button" value=" Show " class="btn btn-info" onclick="show()">

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
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
var brncd= document.getElementById('brncd').value;
$('#data8').load('bill_history_list.php?blno='+blno+'&fdt='+fdt+'&tdt='+tdt+'&brncd='+brncd).fadeIn('fast');
}
</script>
    </body>
</html>