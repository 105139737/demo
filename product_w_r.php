<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$sa=date('d-m-Y');
$saa="01-".date('m-y');
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
 $('#data8').load('product_w_rs.php?fdt='+fdt+'&tdt='+tdt+'&pnm='+encodeURIComponent(pnm)+'&brncd='+brncd).fadeIn('fast');

}
function view(blno)
{

window.open('bill_new.php?blno='+encodeURIComponent(blno), '_blank');
window.focus();



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


	</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
               Product Wise Transfer Report
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Product Wise Transfer Report</li>
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
<td align="right" style="padding-top:15px" width="8%">
<b>Form </b>
<td align="left"  width="12%">
<input type="text" id="fdt" name="fdt" size="20" value="<?echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > </td>

<td align="right" style="padding-top:15px"  width="5%">
<b>To </b>
</td>
<td align="left"  width="12%">
<input type="text" id="tdt" name="tdt" size="20" value="<?echo $sa;?>"class="form-control" placeholder="Please Enter To Date">
</td>

<td align="right" style="padding-top:15px"  width="11%"> 
<b>Product Name </b>
</td>
<td align="left"  width="30%">

<select id="pnm" name="pnm" class="form-control" >
		<option value="">---Select---</option>
		<?
			$query6="select * from  ".$DBprefix."product order by pnm";
			$result5 = mysqli_query($conn,$query6);
			while($row=mysqli_fetch_array($result5))
				{
					$pnm=$row['pnm'];
					$cat=$row['cat'];
					$bnm=$row['bnm'];
					$mnm=$row['mnm'];
$cnm="";				
$data1= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
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
			<option value="<?=$row['sl'];?>"><?=$pnm;?> - <?=$cnm;?> - <?=$brand;?> - <?=$mnm;?></option>
				<?
				}
				?>
			</select>
</td>
<td align="right" style="padding-top:10px"  width="8%">
<b>Branch </b>
</td>
<td align="left"  width="15%" >

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
</tr>
</thead>
<tr>
<td align="right" colspan="10">
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