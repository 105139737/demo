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

select.sc1 {

	width: 300px;

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

#result {

	height:20px;

	font-size:16px;

	font-family:Arial, Helvetica, sans-serif;

	color:#333;

	padding:5px;

	margin-bottom:10px;

	background-color:#FFFF99;

}

#tp{

	padding:3px;

	border:1px #CCC solid;

	font-size:17px;

}

.suggestionsBox {

	position: absolute;

	left: 0px;

	top:10px;

	margin: 26px 0px 0px 0px;

	width: 300px;

	padding:0px;

	background-color: #9F1301;

	border-top: 3px solid #FFFF66;

	color: #fff;

}

.suggestionList {

	margin: 0px;

	padding: 0px;

}

.suggestionList ul li {

	list-style:none;

	margin: 0px;

	padding: 6px;

	border-bottom:1px dotted #666;

	cursor: pointer;

}

.suggestionList ul li:hover {

	background-color: #FC3;

	color:#000;

}

.ul1 {

	font-family:Arial, Helvetica, sans-serif;

	font-size:18px;

	color:#FFF;

	padding:0;

	margin:0;

}



.load{

background-image:url(loader.gif);

background-position:right;

background-repeat:no-repeat;

}



#suggest {

	position:relative;

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
	padding: 7px;
}

</style>



</style> 

<script>

    
	function show1()
	{
	var fdt= document.getElementById('fdt').value;
	var tdt= document.getElementById('tdt').value;
	var brand=document.getElementById("brand").value;
	var spid=document.getElementById("spid").value;
	var yr=document.getElementById("yr").value;
	var mnth=document.getElementById("mnth").value;

	$('#sdtl').load('sales_person_target_reports_brek.php?fdt='+fdt+'&tdt='+tdt+'&brand='+brand+'&spid='+spid+'&yr='+yr+'&mnth='+mnth).fadeIn('fast');
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

   

   $("#fdt").datepicker(jQueryDatePicker2Opts);

  $("#fdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

   $("#tdt").datepicker(jQueryDatePicker2Opts);
  $("#tdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
 
   });


function getbrnd()
{
var sper= document.getElementById('sper').value;
$('#branddiv').load('get_brand.php?sper='+sper).fadeIn('fast');
}
function get_scat(brnd)  
{
$("#catdiv").load("get_sub_cat.php?cat="+brnd).fadeIn('fast');
}
</script>

 

            <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">

                <!-- Content Header (Page header) -->

                <section class="content-header">

                    <h1 align="center">
               
                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>

                        <li class="active">Account Group </li>

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

<form method="post" action="sales_person_target_reports_brek_xls.php" id="form1"  name="form1">
<center>

  <div class="col-md-12" >
              <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"> Sales Person Target Report</h3>
                  <div class="box-tools pull-right">
				
              </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" >

        <table border="0"   align="center" class="table table-hover table-striped table-bordered">
        <tr  hidden>
    <td align="right" width="20%"><font color="red">*</font><b>From :</b></td>
    <td align="left" width="30%">
	<input type="text" name="fdt" class="form-control" id="fdt" value="<? echo date('01-m-Y');?>">
	</td>
	<td align="right" width="20%"><font color="red">*</font><b>To :</b></td>
    <td align="left" width="30%">
	<input type="text" name="tdt" class="form-control" id="tdt" value="<? echo date('d-m-Y'); ?>">
    </td>   
  </tr>
  <tr>


						
		    <td align="right" width="20%"  style="padding-top:15px;" ><b>Brand :</b></td>
            <td  align="left"  width="30%">
				<div id="branddiv">
					<select name="brand"  class="form-control" size="1" id="brand" tabindex="8" >
					
					<?php
					$data13 = mysqli_query($conn,"Select * from main_catg where sl>0 ");
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
				</div>
			</td>
<td align="right"  style="padding-top:15px;"  width="20%"><b>Sales Person :</b></td>      
<td align="left"  width="30%">
<select id="spid" name="spid" tabindex="1"  class="form-control">

<?
$queryss="select * from main_sale_per  WHERE sl>0 order by spid";
$resultss=mysqli_query($conn,$queryss);
while($rwss=mysqli_fetch_array($resultss))
{
$spid=$rwss['spid'];
$spnm=$rwss['nm'];
?>
<option value="<?=$spid;?>" ><?=$spid?></option>
<?
}
?>
</select>

</td>						
	</tr> 
<tr>
<td align="right"  style="padding-top:15px;" ><b> Year :</b></td>
<td align="left" width="" >


<select id="yr" data-placeholder="Choose Report Month" name="yr" class="form-control" tabindex="2" onchange="handleSelect(this.value)"  >

<?
for($i=2017;$i<=date('Y')+1; $i++)
{
?>
<option value="<?=$i;?>"><?=$i;?></option>
<?
}	
?>
</select>
</td>
<td align="right"  style="padding-top:15px;" ><b> Month :</b></td>
<td align="left" width=""  >
<select id="mnth" data-placeholder="Choose Report Month" name="mnth" class="form-control" tabindex="2"  >

<option value="1">January</option>
<option value="2">February</option>
<option value="3">March</option>
<option value="4">April</option>
<option value="5">May</option>
<option value="6">June</option>
<option value="7">July</option>
<option value="8">August</option>
<option value="9">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
</td>
</tr>
	<tr>
<td align="right" colspan="4" >
	<input type="hidden" name="pno" id="pno" value="">
 <input type="button" value=" Show " onclick="show1()" class="btn btn-primary"/>
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
$('#scat').chosen({no_results_text: "Oops, nothing found!",});
$('#spid').chosen({no_results_text: "Oops, nothing found!",});
</script>