<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$sa=date('d-m-Y');
$saa="01-".date('m-y');
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

	function show1()
{

 var fdt= document.getElementById('fdt').value;
 var tdt= document.getElementById('tdt').value;
 var cno= document.getElementById('cno').value;
 var dnm= document.getElementById('dnm').value;
  var brncd= document.getElementById('brncd').value;

 $('#data8').load('challan_list.php?fdt='+fdt+'&tdt='+tdt+'&cno='+encodeURIComponent(cno)+'&dnm='+encodeURIComponent(dnm)+'&brncd='+brncd).fadeIn('fast');

}
function view(blno)
{

window.open('bill_new_challan.php?blno='+encodeURIComponent(blno), '_blank');
window.focus();



}
</script>
   <link rel="stylesheet" href="dark-hive/jquery.ui.all.css" type="text/css">
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

function ddet()
{
		cno=document.getElementById('cno').value;
		$('#dirver').load("dirver_src.php?cno="+cno).fadeIn('fast');
}
function bill(blno)
{
document.location="challan_billing.php?blno="+blno;
}
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
           Road Challan To Invoice
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Road Challan To Invoice</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                   

                   

                    <!-- Main row -->
                    
                        <!-- Left col -->
                       
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        
                           

                            <!-- Chat box -->
					
                     <!-- /.box (chat box) -->

                            <!-- TO DO List -->
                          
							
	<form method="post" action="#" name="form1" onsubmit="return check1()" id="form1">

        <div class="box box-success" >
     <table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<thead>
<tr  >
<td align="right" style="padding-top:15px">
<b>Form : </b>
<td align="left">
<input type="text" id="fdt" name="fdt" value="<?php echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > </td>

<td align="right" style="padding-top:15px">
<b>To : </b>
</td>
<td align="left">
<input type="text" id="tdt" name="tdt" value="<?php echo $sa;?>"class="form-control" placeholder="Please Enter To Date">
</td>
<td align="right" style="padding-top:10px">
<b>Car No : </b>
</td>
<td align="left">

<select name="cno" class="form-control"  id="cno" onchange="ddet()"  >
<option value="">All</option>
<?php 
 $data= mysqli_query($conn,"select * from main_dirver group by cno")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{
$cno=$row['cno'];
?>
<option value="<?php  echo $cno;?>"><?php  echo $cno;?></option>
<?php 
}
?>
</select>
</td>
<td align="right" style="padding-top:10px">
<b>Driver Name : </b>
</td>
<td align="left" >
<div id="dirver" >
<select name="dnm" class="form-control"  id="dnm"   >
<option value="">---Select---</option>

</select>
</div>
</td>

<td align="right" style="padding-top:10px">
<b>Godown : </b>
</td>
<td align="left" >

    <select name="brncd" class="form-control" size="1" id="brncd"   >
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
</tr>
</thead>
<tr>
<td align="right" colspan="10">
<input type="button" class="btn btn-info" value="Show" onclick="show1()"></td>
</tr>


</table>
          </div>
<div id="data8" class="box box-success">
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

  
  	  $('#cno').chosen({
  no_results_text: "Oops, nothing found!",

  });
</script>
    </body>
</html>