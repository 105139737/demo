<?
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

</style>
</style> 
<script>
      function ldgdtls()
   {
        fdt = document.getElementById('fdt').value;
		tdt = document.getElementById('tdt').value;
		ledg = document.getElementById('ledg').value;
		cust = document.getElementById('cust').value;
		sup = document.getElementById('sup').value;
		proj = document.getElementById('proj').value;
		 var brncd= document.getElementById('brncd').value;
	  $('#data').load('tbal_form_det.php?fdt='+fdt+'&tdt='+tdt+'&ledg='+ledg+'&cust='+cust+'&sup='+sup+'&proj='+proj+'&brncd='+brncd).fadeIn('fast');  
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
   
    function sia(val)
 {
	
	 $('#cs').load('cusi_ledgr.php?val='+val).fadeIn('fast'); 
	
	 if(val==4)
	 {
		 $('#c').html('Customer :');
	 }
	 else if(val==12)
	 {
		$('#c').html('Supplier :'); 
	 }
	 else
	 {
		 $('#c').html('');
	 }
	 
 }
</script>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Ledger A/C
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
 	<form method="post" action="tbal_form_xls.php" id="form1"  name="form1">
  <center>
        <div class="box box-success"  >
        <table border="0"   align="center" class="table table-hover table-striped table-bordered">
	<tr >
    <td align="right" style="padding-top:15px;" ><b>Branch :</b></td>
    <td align="left" >
 <select name="brncd" class="form-control" size="1" id="brncd"   >
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
$sl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
</select>
		<input type="hidden" name="proj" class="form-control" id="proj" value="0">
	
  
	</td>
	<td align="right" >
	
	</td>
    <td align="left" >
	
	</td>   
  </tr>
        <tr >
    <td align="right" style="padding-top:15px;"><b>From :</b></td>
    <td align="left" >
	<input type="text" name="fdt" class="form-control" id="fdt" value="<? echo $fdt; ?>">
	</td>
	<td align="right" style="padding-top:15px;"><b>To :</b></td>
    <td align="left" >
	<input type="text" name="tdt" class="form-control" id="tdt" value="<? echo date('d-m-Y'); ?>">
	</td>   
  </tr>
   <tr >
    <td align="right" style="padding-top:15px;" ><b>Ledger Head :</b></td>
<td  align="left" style="width:25%">
	 <select id="ledg" name="ledg" class="form-control"  onchange="sia(this.value)">						
							<?php 
							$get = mysqli_query($conn,"SELECT * FROM main_ledg where bcd='$branch_code' order by nm") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?=$row['sl']?>"><?=$row['nm']?></option>
							<?php 
							} 
							?>
						</select>
	  </td>
	  <td style="padding-top:15px;" align="right">
	  <b>
	  <div id="c">
		</div>
		</b>
	  </td>
	  
	  <td>
	  	<div id="cs">
	<input type="hidden" id="cust" value="">
	<input type="hidden" id="sup" value="">
	</div>
	  </td>
	  

    </tr>
	 <tr >
	  <td colspan="4" align="right">
	 <input type="button" value=" Show " onclick="ldgdtls()" class="btn btn-primary"/>
	  </td>
	  </tr>
    <tr class="odd">
    <td align="center" width="100%" colspan="4">
    <div id="data">
		
    </div>
    </td>
    </tr>
          </table>
                                </div>
								<div class="box box-success"  id="sdtl"  >
								
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
		     <link rel="stylesheet" href="chosen.css">
	<script src="chosen.jquery.js" type="text/javascript"></script>
    <link rel="stylesheet" href="chosen.min.css">
	<script>
	$('#ledg').chosen({
	no_results_text: "Oops, nothing found!",
  });
</script>
		
</html>