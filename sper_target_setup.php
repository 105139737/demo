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


function getbrnd()
{
var sper= document.getElementById('sper').value;
$('#branddiv').load('get_brand.php?sper='+sper).fadeIn('fast');
}
function show()
{
var sper=encodeURIComponent(document.getElementById('sper').value);
var brand=document.getElementById("brand").value;
$('#sdtl').load('sper_targets.php?brand='+brand+'&sper='+sper).fadeIn('fast');
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

<form method="post" action="sper_target_setups.php" id="form1"  name="form1">
<center>

  <div class="col-md-12" >
              <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"> Sales Person Target Setup</h3>
                  <div class="box-tools pull-right">
				
              </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" >

        <table border="0"   align="center" class="table table-hover table-striped table-bordered">

  <tr>
<td align="left" style="width:55%;"><font color="red">*</font><label>Sales Person :</label>
  
<select name="sper" class="form-control" size="1" id="sper"  onchange="getbrnd();show()">
<option value="">---ALL---</option>
<?php  
$query="Select * from main_sale_per";
 $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$spid=$R['spid'];
$spnm=$R['nm'];

?>
<option value="<?php  echo $spid;?>"><?php  echo $spid;?> ( <?php  echo $spnm;?> )</option>
<?php 
}
?>
</select>
	</td>
	
	  <td align="left" style="width:35%;"><font color="red">*</font><label>Brand :</label>
		<div id="branddiv">
		<select name="brand" class="form-control" size="1" id="brand" onchange="show()"  >
		<option value="">---ALL---</option>

		</select>
		</div>
	</td>

<td align="right" style="padding-top:30px;">
 <input type="button" value=" Show " onclick="show()" class="btn btn-primary"/>
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
$('#sper').chosen({no_results_text: "Oops, nothing found!",});	
$('#brand').chosen({no_results_text: "Oops, nothing found!",});	
$('#brand_chosen').css('width','100%');	
</script>
