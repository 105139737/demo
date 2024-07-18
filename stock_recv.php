<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";

?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<style type="text/css"> 


a{
cursor:pointer;
}
</style> 

 		


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
      <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" language="javascript">
   $(document).ready(function()
{

   var jQueryDatePicker2Opts =
   {
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
   
   $("#fdt").datepicker(jQueryDatePicker2Opts);
   $("#fdt").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
   $("#tdt").datepicker(jQueryDatePicker2Opts);
   $("#tdt").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
      	
   });
   



 
  function show()
 {
	   var stat=document.getElementById('stat').value; 
	   var fdt=document.getElementById('fdt').value; 
	   var tdt=document.getElementById('tdt').value; 
	    var bcd=document.getElementById('bcd').value; 

 $('#sgh').load('stock_recvs.php?stat='+stat+'&fdt='+fdt+'&tdt='+tdt+'&bcd='+bcd).fadeIn('fast');

 }
 
 




function pagnt(pno){
        var ps=document.getElementById('ps').value;
      	   var stat=document.getElementById('stat').value; 
	   var fdt=document.getElementById('fdt').value; 
	   var tdt=document.getElementById('tdt').value; 
	   var bcd=document.getElementById('bcd').value;
	   
    $('#sgh').load("stock_recvs.php?ps="+ps+"&pno="+pno+'&stat='+stat+'&fdt='+fdt+'&tdt='+tdt+'&bcd='+bcd).fadeIn('fast');
	$('#pgn').val=pno;
    }
	function pagnt1(pno){
	pno=document.getElementById('pgn').value;
	pagnt(pno);
	}
    
function recieve(blno)
{
//document.location = 'stock_recv_view.php?blno='+blno;
window.open('stock_recv_view.php?blno='+blno,'_blank');
}
function edit(blno)
{
//document.location = 'trnsfer_edt.php?blno='+blno;
window.open('trnsfer_edt.php?blno='+blno,'_blank');
}

function update_vno(val,sl)
{
$('#vvno').load('update_vno_trn.php?val='+val+'&sl='+sl).fadeIn("fast");

}	
	

    </script>

	</head>
<body onload="show()" >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
               Stock Transfer List
                    
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Stock Transfer List</li>
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
                          
 	<form method="post" action="#" id="form1" name="form1"   style="position:relative;">
                              
							
								



  <center>
        <div id="vvno" ></div>
        <div class="box box-success" >
 <table width="100%" class="table table-hover table-striped table-bordered"  >
		
				  <tr class="odd">
<td align="right" style="padding-top:15px"> 
<font size="3">
<b>Status :</b>
</font>
</td>
<td align="left">
		<select id="stat"  name="stat"  tabindex="2" class="form-control" >
		<option value="0">Pending</option>
		<option value="1">Receive</option>
		

</select>
</td>
<td align="right" style="padding-top:15px"> 
<font size="3">
<b>To Godown :</b>
</font>
</td>
<td align="left"   >
<select name="bcd" class="form-control" tabindex="10"  size="1" id="bcd" >
 <option value="">---All---</option>   
<?
$geti=mysqli_query($conn,"select * from main_godown order by gnm") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
$sl=$rowi['sl'];
$gnm=$rowi['gnm'];

?>
<option value="<? echo $sl;?>"><? echo $gnm;?> </option>
<?


}
?>
</select>
</td>
        

<td align="right" style="padding-top:15px"> 
<font size="3">
<b>From  :</b>
</font>
</td>
<td align="left">
<input type="text" name="fdt" id="fdt" class="form-control" value="<?=$fdt;?>" >
</td>
<td align="right" style="padding-top:15px"> 
<font size="3">
<b>To  :</b>
</font>
</td>
<td align="left">
<input type="text" name="tdt" id="tdt" class="form-control" value="<?=$tdt;?>" >
</td>
</tr>
		  

		  
		  <tr class="odd">
		   <td   colspan="8" align="right" style="padding-right:155px" >
			<input type="button"  value="Show" onclick="show()" class="btn btn-success" >

            </td>
		  </tr>
		  
		 		
		  </table>

<div id="sgh">
<div id="lo">

</div>
</div>
  </div>
								</form><!-- /.box-body -->
                                           </section><!-- /.content -->
            </aside><!-- /.right-side -->     
    </body>            
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

      
   

        <!-- add new calendar event modal -->

     


</html>