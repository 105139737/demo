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

function suggest(inputString){

		if(inputString.length == 0) {

			$('#suggestions').fadeOut();

		} else {

		$('#tp').addClass('load');

			$.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){

				if(data.length >0) {

					$('#suggestions').fadeIn();

					$('#suggestionsList').html(data);

					$('#tp').removeClass('load');

				}

			});

		}

	}
    
	function show1()
	{
	var brncd= document.getElementById('brncd').value;
	var fdt= document.getElementById('fdt').value;
	var tdt= document.getElementById('tdt').value;
	$('#show').load('daily_reports.php?fdt='+fdt+'&tdt='+tdt+'&brncd='+brncd).fadeIn('fast');
	}
	
		function exprt()
	{
	var brncd= document.getElementById('brncd').value;
	var fdt= document.getElementById('fdt').value;
	var tdt= document.getElementById('tdt').value;
	document.location='daily_reports_xls.php?fdt='+fdt+'&tdt='+tdt+'&brncd='+brncd;
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

<form method="post" action="inex_bankxls.php" id="form1"  name="form1">
<center>

  <div class="col-md-12" >
              <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"> Daily Report</h3>
                  <div class="box-tools pull-right">
				
              </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" >

        <table border="0"   align="center" class="table table-hover table-striped table-bordered">
        <tr >
    <td align="right" width="20%"><font color="red">*</font>From :</td>
    <td align="left" width="30%">
	<input type="text" name="fdt" class="form-control" id="fdt" value="<? echo date('01-m-Y'); ?>">
	</td>
	<td align="right" width="20%"><font color="red">*</font>To :</td>
    <td align="left" width="30%">
	<input type="text" name="tdt" class="form-control" id="tdt" value="<? echo date('d-m-Y'); ?>">
    </td>   
  </tr>
  <tr >
  <td align="right" ><font color="red">*</font>Branch :</td>
    <td align="left" >

						
						    <select name="brncd" class="form-control" size="1" id="brncd"   >


<option value="">---ALL---</option>
<?
$query="Select * from main_branch";
 $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$slb=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $slb;?>"><? echo $bnm;?></option>
<?
}
?>
</select>
	</td>
<td align="right" colspan="2" >
	<input type="hidden" name="pno" id="pno" value="">
<!-- <input type="button" value=" Show " onclick="show1()" class="btn btn-primary"/>-->
   <input type="button" value=" Export to Excel " onclick="exprt()"  class="btn btn-info">

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