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
color:#FFF;
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
 var snm= document.getElementById('snm').value;
 var pnm= document.getElementById('pnm').value;

 $('#data8').load('purchase_retn_list.php?fdt='+fdt+'&tdt='+tdt+'&snm='+encodeURIComponent(snm)+'&pnm='+encodeURIComponent(pnm)).fadeIn('fast');

}
function edit(blno)
{


document.location="purchase_edit.php?blno="+blno;


}
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

function view(blno)
{

window.open('pur_bill_new_retn.php?blno='+encodeURIComponent(blno), '_blank');
window.focus();



}
   </script>
      <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
	</head>
 <body onload="show1()">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
               Purchase Return
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Purchase Return</li>
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
                          
							
							
							
							
							
							
					<HR> 	<form method="post" action="dpbills.php" name="form1" onsubmit="return check1()" id="form1">
                              
							
								



  <center>
        <div class="box box-success" >
     <table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<thead>
<tr  >
<td align="right" style="padding-top:15px">
<b>Form : </b>
<td align="left">
<input type="text" id="fdt" name="fdt" size="20" value="<?php echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > </td>

<td align="right" style="padding-top:15px">
<b>To : </b>
</td>
<td align="left">
<input type="text" id="tdt" name="tdt" size="20" value="<?php echo $sa;?>"class="form-control" placeholder="Please Enter To Date">
</td>
<td align="right" style="padding-top:15px">
<b>Company Name : </b>
</td>
<td align="left">

<select name="snm" class="form-control"  id="snm"   >
<option value="">All</option>
<?php 
$query="Select * from  main_suppl order by spn";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sid=$R['sid'];
$spn=$R['spn'];
?>
<option value="<?php  echo $sid;?>"><?php  echo $spn;?></option>
<?php 
}
?>
</select>
</td>
<td align="right" style="padding-top:15px">
<b>Product Name : </b>
</td>
<td align="left">
<select name="pnm" class="form-control"  id="pnm"   >
<option value="">All</option>
<?php 
$query="Select * from  main_product order by pname";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$pname=$R['pname'];
?>
<option value="<?php  echo $sl;?>"><?php  echo $pname;?></option>
<?php 
}
?>
</select>

</td>

</tr>
</thead>
<tr>
<td align="right" colspan="8">
<input type="button" class="btn btn-primary" value="Show" onclick="show1()"></td>
</tr>


</table>
<div id="data8">
</div>
	 
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

     

    </body>
</html>