<?$reqlevel = 3;include("membersonly.inc.php");include "header.php";$sa=date('d-m-Y');$saa="01-".date('m-Y');?><html><head><div class="wrapper row-offcanvas row-offcanvas-left"> <?include "left_bar.php"; ?>
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
</style> 
<script>

function show1(){ var fdt= document.getElementById('fdt').value; var tdt= document.getElementById('tdt').value; var snm= document.getElementById('snm').value; var brncd= document.getElementById('brncd').value;$('#data8').load('purchase_list_gst.php?fdt='+fdt+'&tdt='+tdt+'&snm='+encodeURIComponent(snm)+'&brncd='+brncd).fadeIn('fast');}function edit(blno){document.location="purchase_edit.php?blno="+blno;}function xls(){ var fdt= document.getElementById('fdt').value; var tdt= document.getElementById('tdt').value; var snm= document.getElementById('snm').value; var brncd= document.getElementById('brncd').value;document.location='purchase_list_gst_xls.php?fdt='+fdt+'&tdt='+tdt+'&snm='+encodeURIComponent(snm)+'&brncd='+brncd;}
</script>
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
 <body onload="show1()">
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
               Purchase
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Purchase</li>
                    </ol>
                </section>
                <section class="content">
                            <!-- TO DO List --><form method="post" action="dpbills.php" name="form1" onsubmit="return check1()" id="form1"> <center><div class="box box-success" ><table border="0" width="860px"  class="table table-hover table-striped table-bordered"><thead><tr  ><td align="right" style="padding-top:15px"><b>Form : </b><td align="left" ><input type="text" id="fdt" name="fdt" size="20" value="<?echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > </td><td align="right" style="padding-top:15px" ><b>To : </b></td><td align="left"  ><input type="text" id="tdt" name="tdt" size="20" value="<?echo $sa;?>"class="form-control" placeholder="Please Enter To Date"></td><td align="right" style="padding-top:15px"  width="13%"><b>Company Name : </b></td><td align="left"  ><select name="snm" class="form-control"  id="snm"   ><option value="">---All---</option><?		$query="select * from main_suppl  WHERE sl>0 order by nm";		$result=mysqli_query($conn,$query);		while($rw=mysqli_fetch_array($result))		{			?>			<option value="<?=$rw['sl'];?>"><?=$rw['spn'];?> <?if($rw['nm']!=""){?>( <?=$rw['nm'];?> )<?}?></option>			<?		}	?>
</select>
</td>
<td align="right" style="padding-top:10px"><b>Branch:</b></td><td align="left">	<select name="brncd" class="form-control" size="1" id="brncd">	<?if($user_current_level<0){$query="Select * from main_branch";}else{$query="Select * from main_branch where sl='$branch_code'";}   $result = mysqli_query($conn,$query);while ($R = mysqli_fetch_array ($result)){$sl=$R['sl'];$bnm=$R['bnm'];?><option value="<? echo $sl;?>"><? echo $bnm;?></option><?}?></select></td>
</tr>
</thead>
<tr>
<td align="right" colspan="10"><input type="button" class="btn btn-primary" value="Show" onclick="show1()"><input type="button" class="btn btn-info" value="Excel Export" onclick="xls()">
</td>
</tr>


</table>
<div style="overflow-x:auto;" id="data8">
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
	 <link rel="stylesheet" href="chosen.css"> <script src="chosen.jquery.js" type="text/javascript"></script>  <script src="prism.js" type="text/javascript" charset="utf-8"></script><script>			  $('#pnm').chosen({  no_results_text: "Oops, nothing found!",  });		  $('#snm').chosen({  no_results_text: "Oops, nothing found!",  });  </script>
     

    </body>
</html>