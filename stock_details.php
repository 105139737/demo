<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$sa=date('d-m-Y');
$saa="01-".date('m-y');
date_default_timezone_set('Asia/Kolkata');
$tdt = date('Y-m-d');
$fdt3 = date('Y');
$m = date('m');
$fdt=$fdt3."-04-01";

if($m<4)
{
$fdt1=$fdt3-1;	
}
else
{
$fdt1=$fdt3;

}
//echo $fdt1;

 $fdt=date('d-m-Y',strtotime($fdt1."-04-01"));
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

	function show1()
{

 var fdt= document.getElementById('fdt').value;
 var tdt= document.getElementById('tdt').value;
 
 var pnm= document.getElementById('pnm').value;
 var brncd= document.getElementById('brncd').value;
 $('#data8').load('stock_detailss.php?fdt='+fdt+'&tdt='+tdt+'&pnm='+encodeURIComponent(pnm)+'&brncd='+brncd).fadeIn('fast');

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
   </script>

      <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

<link href="advancedtable.css" rel="stylesheet" type="text/css" />

<link href="style.css" rel="stylesheet" type="text/css" />
	</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
               Sale
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Sale</li>
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
                              
							
								



  <center>
        <div class="box box-success" >
     <table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<thead>
<tr  >
<td align="right" style="padding-top:10px">
<b>Godown : </b>
</td>
<td align="left" >

    <select name="brncd" class="form-control" size="1" id="brncd"   >
<?
if($user_current_level<0)
{
	?>
	<option value="">---ALL---</option>
	<?
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
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
</select>

</td>
<td align="right" style="padding-top:15px">
<b>Form : </b>
<td align="left">
<input type="text" id="fdt" name="fdt" size="20" value="<?echo $fdt;?>" readonly class="form-control" placeholder="Please Enter From Date" > </td>

<td align="right" style="padding-top:15px">
<b>To : </b>
</td>
<td align="left">
<input type="text" id="tdt" name="tdt" size="20" value="<?echo $sa;?>" readonly class="form-control" placeholder="Please Enter To Date">
</td>

<td align="right" style="padding-top:15px">
<b>Product Name : </b>
</td>
<td align="left">
<select name="pnm" class="form-control"  id="pnm"   >

<?
$query="Select * from  main_product order by pnm";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$pname=$R['pnm'];
$mnm=$R['mnm'];
$cat=$R['cat'];
$bnm=$R['bnm'];

$cnm="";				
$data11= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{
$cnm=$row1['cnm'];
}
$brand="";
$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$brand=$row1['brand'];
}
?>
<option value="<? echo $sl;?>"><?=$pname;?> - <?=$cnm;?> - <?=$brand;?> - <?=$mnm;?></option>
<?
}?>
</select>

</td>

</tr>
</thead>
<tr>
<td align="right" colspan="8">

<input type="button" class="btn btn-primary" value="Show" onclick="show1()">

</td>
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

     
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>

	
		  $('#pnm').chosen({
  no_results_text: "Oops, nothing found!",

  });
  
  	  $('#snm').chosen({
  no_results_text: "Oops, nothing found!",

  });
</script>
    </body>
</html>