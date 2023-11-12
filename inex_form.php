<?

$reqlevel = 1;

include("membersonly.inc.php");

include "header.php";

?>

        <div class="wrapper row-offcanvas row-offcanvas-left">

            <?

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



</style>



</style> 

<script type="text/javascript" src="validate.js"></script>



<script type="text/javascript" src="prdcedt.js"></script>

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
    
      function inexdtls()

   {
	   var brncd= document.getElementById('brncd').value;
        fdt = document.getElementById('fdt').value;
		tdt = document.getElementById('tdt').value;
		pno = document.getElementById('pno').value;
	  $('#data').load('inex_form_det.php?fdt='+fdt+'&tdt='+tdt+'&pno='+pno+'&brncd='+brncd).fadeIn('fast');  

   }
   
   function show3(cc,dt,dt1,pno)
	{var brncd= document.getElementById('brncd').value;
	   $('#'+cc).load('inex_form_det_sw1.php?cc='+cc+'&dt='+dt+'&dt1='+dt1+'&pno='+pno+'&brncd='+brncd).fadeIn('fast');
    }
	
	function show4(cc,dt,dt1,pno)
	{	var brncd= document.getElementById('brncd').value;
		$('#'+cc).load('inex_form_det_sw2.php?cc='+cc+'&dt='+dt+'&dt1='+dt1+'&pno='+pno+'&brncd='+brncd).fadeIn('fast');
		
	}

</script>

<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>

<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>

<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

<link rel="stylesheet" href="dark-hive/jquery.ui.all.css" type="text/css">


   <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>


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

                 Income & Expenditure A/c

   
                    </h1>
                    <ol class="breadcrumb">

                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>

                        <li class="active">Account Group </li>

                    </ol>

                </section>
                <section class="content">
<body >						

 	<form method="post" action="inex_xls.php" id="form1"  name="form1">
 <center>

        <div class="box box-success"  >

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
<tr>
<td align="right" ><font color="red">*</font>Branch:</td>
<td align="left">
<select name="brncd" class="form-control" size="1" id="brncd">
<?
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<option value="">---ALL---</option>
<?
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
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
<td align="right" width="20%"><font color="red">*</font>Project :</td>
<td align="left" width="30%">
<select  name="pno" id="pno" class="form-control" onchange="gtcrvl1();gtcrvlfi()">

<option value="0"> NA </option>
<?php 
$get = mysqli_query($conn,"SELECT * FROM main_project") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?=$row['sl']?>"><?=$row['nm']?></option>
<?php 
} 
?>
</select>
</td>
</tr>
  <tr>
    <td align="right" width="50%" colspan="4">
   <input type="button" value=" Show " onclick="inexdtls()" class="btn btn-info"/>
    </td>
    </tr>
 
    <tr class="odd">
    <td align="center" width="100%" colspan="4">
    <div id="data" class="box box-success">
    </div>
    </td>
    </tr>
     

		




          </table>

	 

                                </div>

								<div  style="width:900px"  >

								<div id="sdtl">

								

								</div>

								</div>

								<input type="hidden" id="edtbx"/>

								</form><!-- /.box-body -->.

								    </body>

                                <div class="box-footer clearfix no-border">

                                

                                </div>

                            </div>

							

							

							<!-- /.box -->



                        <!-- right col -->

                   <!-- /.row (main row) -->



                </section><!-- /.content -->

            </aside><!-- /.right-side -->

   



        <!-- add new calendar event modal -->



     





</html>