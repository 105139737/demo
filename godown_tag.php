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
	var brncd= document.getElementById('brncd').value;
	var fdt= document.getElementById('fdt').value;
	var tdt= document.getElementById('tdt').value;
	$('#show').load('daily_reports.php?fdt='+fdt+'&tdt='+tdt+'&brncd='+brncd).fadeIn('fast');
	}
	
</script>

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
function show()
{
var brncd=encodeURIComponent(document.getElementById('brncd').value);
var bcd=encodeURIComponent(document.getElementById('bcd').value);
$('#show').load('godown_tag_list.php?brncd='+brncd+'&bcd='+bcd).fadeIn('fast');
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

                        <li class="active">Supplier TAG </li>

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

<body onload="show()">						

<form method="post" action="godown_tags.php" id="form1"  name="form1" >
<center>

  <div class="col-md-12" >
              <div class="box box-success box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title"> Godown Tag</h3>
                  <div class="box-tools pull-right">
				
              </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" >

        <table border="0"   align="center" class="table table-hover table-striped table-bordered">

  <tr>
	<td align="left"  width="33%"><b>Branch : </b>
	<select name="brncd" class="form-control" tabindex="1" id="brncd"  onchange="show()" required>
	    <Option value=""  >---Select---</option>
	<?php 
	
	$query="Select * from main_branch where sl>0";
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
<td align="left" width="20%"><font color="red">*</font><label>Brand :</label>
<select name="brand"  class="form-control" size="1" id="brand" tabindex="8"  >
<Option value=""  >---Select---</option>
<?php 
$data13 = mysqli_query($conn,"Select * from main_catg where sl>0 ");
while ($row13 = mysqli_fetch_array($data13))
{
$sl3=$row13['sl'];
$cnm=$row13['cnm'];
?>
<Option value="<?php  echo $sl3;?>"  ><?php  echo $cnm;?></option>
<?php  
}
?>
</select>
	</td>
<td width="33%">
 <font color="red">*</font><label>Godown :</label>
<select name="bcd" class="form-control" tabindex="10"  size="1" id="bcd" required onchange="show()">
     <Option value=""  >---Select---</option>
<?php 
$geti=mysqli_query($conn,"select * from main_godown order by sl") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
$sl=$rowi['sl'];
$gnm=$rowi['gnm'];
$bnm=$rowi['bnm'];

?>
<option value="<?php  echo $sl;?>"><?php  echo $gnm;?></option>
<?php 
}
?>
</select>
</td>	

<td align="right" width="33%" style="padding-top:30px;">
 <input type="submit" value=" Submit " class="btn btn-success"/>
    </td>
	 </tr>
     </table>

	 

                                </div>

								<div class="box box-success">

<div id="show">
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
$('#sup').chosen({no_results_text: "Oops, nothing found!",});	
$('#brand').chosen({no_results_text: "Oops, nothing found!",});	
$('#brand_chosen').css('width','100%');	
</script>
