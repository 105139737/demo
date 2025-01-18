<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');

$yy=date('Y');
$dt1 = date('m');
$dt12 = date('m-Y');
$tto = $yy."-03-31";

$dt2=$yy-1;

$frm2=$dt2.'-04-01';
$frm=date('d-m-Y', strtotime($frm2));
$to=date('d-m-Y', strtotime($tto));
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
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

<script type="text/javascript" language="javascript">
   $(document).ready(function()
{
$("#fdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#tdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

});
 

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
   $("#tdt").datepicker(jQueryDatePicker2Opts);
   });

</script>
<link rel="stylesheet" type="text/css" href="style_sedt1.css" />
<script type="text/javascript" src="prdcedt.js"></script>
 	<script>	

 function show()
 {
 var fdt= document.getElementById('fdt').value;
 var tdt= document.getElementById('tdt').value;
 var pnm= document.getElementById('pnm').value;
 var brncd= document.getElementById('brncd').value;
 $('#sgh').load('stock_st1_lst.php?fdt='+fdt+'&tdt='+tdt+'&pnm='+pnm+'&brncd='+brncd).fadeIn('fast');

 }

function exp()
{
	 var fdt= document.getElementById('fdt').value;
	 var tdt= document.getElementById('tdt').value;
	 var pnm= document.getElementById('pnm').value;
	 var brncd= document.getElementById('brncd').value;
	document.location='stock_sts1_xls.php?fdt='+fdt+'&tdt='+tdt+'&pnm='+pnm+'&brncd='+brncd;
}

	


</script>

	</head>
 <body >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Stock Statement Year
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Stock Statement Year</li>
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
 	<form method="post" action="brnchs.php" id="form1" onSubmit="return check1()" name="form1">
                              
							
								


<input type="hidden">
  <center>
        <div class="box box-success" >
      <table border="0" width="860px" class="table table-hover table-striped table-bordered">

<tr>
<td align="right" style="padding-top:15px">
<b>From : </b>
<td align="left">
<input type="text" id="fdt" name="fdt" value="<?php  echo $frm;?>" class="form-control" placeholder="From Date.."></td>
<td align="right" style="padding-top:15px">
<b>To : </b>
</td>
<td align="left">

<input type="text" id="tdt" name="tdt" value="<?php  echo $to;?>" class="form-control" placeholder="To Date.."></td>
</td>
<td align="right" style="padding-top:15px">
<b>Product Name : </b>
</td>
<td align="left">
<select name="pnm" class="form-control"  id="pnm" style="width:200px"  >
<option value="">All</option>
<?php 
$query="Select * from  main_product order by pnm";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$pname=$R['pnm'];
$mnm=$R['mnm'];
?>
<option value="<?php  echo $sl;?>"><?php  echo $pname;?> - <?php  echo $mnm;?></option>
<?php 
}
?>
</select>

</td>
<td align="right" style="padding-top:10px">
<b>Branch : </b>
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
<tr>
<td colspan="8" align="right" style="padding-right:80px">
<input type="button" value=" Export To excel " class="btn btn-info" onclick="exp()">
<input type="button" value=" Show " class="btn btn-success" onclick="show()">
</td>
</tr>


</tbody>
</table>
<div id="sgh">
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
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>

	
		  $('#pnm').chosen({
  no_results_text: "Oops, nothing found!",

  });
  

</script>
     

    </body>
</html>