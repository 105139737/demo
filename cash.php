<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
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
 <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<head>
       
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
color:#e53d37;
}
#boxpopup{

left:100%;
position:fixed;
}

select.sc {
	width: 100%;
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
select.rf {
	width: 100px;
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


<script type="text/javascript" src="ajax.js"></script>


<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

   
      <link rel="stylesheet" href="dark-hive/jquery.ui.all.css" type="text/css">
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
   <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
   <script>
  
   function show()
 {
   var fdt= document.getElementById('fdt').value;
   var tdt= document.getElementById('tdt').value;
   var snm= document.getElementById('snm').value;
   var brncd= document.getElementById('brncd').value;
 $('#show').load('cashs.php?fdt='+fdt+'&tdt='+tdt+'&snm='+snm+'&brncd='+brncd).fadeIn('fast');

 }
	
	function excl()
	{
		  var fdt= document.getElementById('fdt').value;
   var tdt= document.getElementById('tdt').value;
   var snm= document.getElementById('snm').value;
   var brncd= document.getElementById('brncd').value;

 document.location='cashs_xls.php?fdt='+fdt+'&tdt='+tdt+'&snm='+snm+'&brncd='+brncd;
 
	}


   </script>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
	</head>
 <body >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Cash-Credit Sale
                        <small> Cash-Credit Sale</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Cash-Credit Sale</li>
                    </ol>
                </section>
                
 					
						
	
					<form name="form1" id="form1" method="post" action="drcr_trns.php">


        <div class="box box-success" >

 <table width="100%" class="advancedtable"  >
		
		  <tr class="odd">
            <td  align="right" >From :</td>
            <td  align="left" >
			<input type="text" class="sc" id="fdt" size="20" name="fdt" value="<?echo $fdt;?>" tabindex="1" placeholder="">
            </td>
       
            <td  align="right" >To :</td>
            <td  align="left">
		<input type="text" class="sc" id="tdt" size="20" name="tdt" value="<?echo date('d-m-Y');?>" tabindex="1" placeholder="">

            </td>
	
<td align="right" >
<b>Shop Name : </b>
</td>
<td align="left">

<select name="snm" class="form-control"  id="snm"   >
<option value="">---All---</option>
<?
$query="Select * from  main_suppl where tp='Debtors' or tp='Both' order by spn";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sid=$R['sl'];
$spn=$R['spn'];
?>
<option value="<? echo $sid;?>"><? echo $spn;?></option>
<?
}
?>
</select>
</td>

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
		 <td   colspan="10" align="left"  >
		 
		   
		   
			<input type="button"  value="Show" class="btn btn-info" onclick="show()" >
			
			<input type="button"  value="Export To Excel" class="btn btn-success" onclick="excl()" >
			
            </td>	
          </tr>
		  
		 
		  
		 		
		  </table>
</div> 
  <div class="box box-success" >
  <div id="show">
 
  
  
  </div>
  </div>
       
</form>


	 
                
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                  
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     

    </body>

 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>

  	  $('#snm').chosen({
  no_results_text: "Oops, nothing found!",

  });
  
</script>

	 </div>
</html>