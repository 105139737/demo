<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$fy=date('Y');
$fm=date('m');
if($fm<4)
{$fy--;
}
$fdt="01-04-".$fy;
?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
 
            <?php 
            include "left_bar.php";
            ?>

<style type="text/css"> 

th{
border:1px solid #37880a;

}

input:focus{



background-color:Aqua;

}

a{

cursor:pointer;

}
</style>



</style> 

<script>

    
	function show1()
	{

	var dt= document.getElementById('dt').value;
	var brand=document.getElementById("brand").value;

	$('#sdtl').load('invests.php?dt='+dt+'&brand='+brand).fadeIn('fast');
	}

</script>

<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>

<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>

<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

<link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">


   <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

<link href="advancedtable.css" rel="stylesheet" type="text/css" />

<link href="style.css" rel="stylesheet" type="text/css" />


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
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
     // yearRange: '1950:2019',
      showButtonPanel: false,
      showAnim: 'show'
      
   };

   $("#dt").datepicker(jQueryDatePicker2Opts);
  $("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
 
   });

</script>

 

            <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">

                <!-- Content Header (Page header) -->

                <section class="content-header">

                    <h1 align="center">
               
                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>

                        <li class="active">Invest </li>

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

<body >						

<form method="GET" action="invests_xls.php" id="form1"  name="form1">
<center>

  <div class="col-md-12" >
              <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"> Invest</h3>
                  <div class="box-tools pull-right">
				
              </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" >

        <table border="0"   align="center" class="table table-hover table-striped table-bordered">
        <tr >
	<td align="right" width="20%"><font color="red">*</font><b>Date :</b></td>
    <td align="left" width="30%">
	<input type="text" name="dt" class="form-control" id="dt" value="<? echo date('d-m-Y'); ?>">
    </td>  
    <td align="right"  style="padding-top:15px;" ><b>Brand :</b></td>
            <td  align="left" width="">
				<?php
				$brand=array();
				$data13 = mysqli_query($conn,"Select * from main_supplier_tag where sl>0 ");
				while ($row13 = mysqli_fetch_array($data13))
					{
					$brand[]=$row13['brand'];
					}
				$brand=implode(',',$brand);
				?>
					<select name="brand"  class="form-control" size="1" id="brand" tabindex="8"  >
					<option value="">---ALL---</option>
					<?php
					$data13 = mysqli_query($conn,"Select * from main_catg where sl>0 and FIND_IN_SET(sl, '$brand')>0 ");
					while ($row13 = mysqli_fetch_array($data13))
					{
					$sl3=$row13['sl'];
					$cnm=$row13['cnm'];
					?>
					<option value="<?php echo $sl3;?>"  ><?php echo $cnm;?></option>
					<?php 
					}
					?>
					</select>
				
			</td>	
  </tr>

	<tr>
<td align="right" colspan="4" >
	<input type="hidden" name="pno" id="pno" value="">
 <!--<input type="button" value=" Show " onclick="show1()" class="btn btn-primary"/>-->
  <input type="submit" value=" Export to Excel " class="btn btn-info">

    </td>
	 </tr>

 
    <tr >
    <td align="center" width="100%" colspan="4">
    <div id="show">
    </div>
    </td>
    </tr>
     

		




          </table>

	 

                                </div>

								<div class="box box-success">

								<div id="sdtl">

								

								</div>

								</div>

								<input type="hidden" id="edtbx"/>

								</form><!-- /.box-body -->.

								    </body>

                                <div class="box-footer clearfix no-border">

                                

                                </div>

                            </div>
                            </div>

							

							

							<!-- /.box -->



                        <!-- right col -->

                   <!-- /.row (main row) -->



                </section><!-- /.content -->

            </aside><!-- /.right-side -->

   



        <!-- add new calendar event modal -->



     





</html>
     <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>
$('#brand').chosen({no_results_text: "Oops, nothing found!",});	
$('#brand_chosen').css('width','100%');	
$('#sper').chosen({no_results_text: "Oops, nothing found!",});	
$('#sper_chosen').css('width','100%');	
</script>