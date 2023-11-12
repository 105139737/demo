<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

   
      <link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
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
   

   </script>

   <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>   
<style type="text/css"> 
th{
text-align:center;
font-weight: 900;
color:#000;
border:1px solid #37880a;

}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
</style> 
<script type="text/javascript" src="prdcedt.js"></script>
<script>	
 function show()
 {
 
 var all= document.getElementById('all').value;
 var cat= document.getElementById('cat').value;

 $('#sgh').load('gst_list.php?all='+encodeURIComponent(all)+'&cat='+cat).fadeIn('fast');

 }


function pagnt(pno){
    var ps=document.getElementById('ps').value;
    var src=document.getElementById('all').value;
    var cat=document.getElementById('cat').value;
    $('#sgh').load("gst_list.php?ps="+ps+"&pno="+pno+"&all="+encodeURIComponent(src)+'&cat='+cat).fadeIn('fast');
	$('#pgn').val=pno;
    }
	function pagnt1(pno){
	pno=document.getElementById('pgn').value;
	pagnt(pno);
	}


function edit(sl)
{
document.location='gst_update.php?sl='+sl;
}

</script>

	</head>
 <body onload="show()" >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 GST View & Edit
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">GST List</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
						
<HR> 	
<form method="post" action="#" id="form1" onSubmit="return check1()" name="form1">
                              
<input type="hidden">
<center>
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="right" style="padding-top:15px"> 
<font size="3"><b>Category :</b></font>
</td>
<td align="left">
<select class="form-control" id="cat"  name="cat">
<option value="">---Select---</option>
<?
$get=mysqli_query($conn,"select * from main_scat order by nm") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
?>
<option value="<?=$row['sl'];?>"><?=$row['nm'];?> (<?=$row['hsn'];?>)</option>
<?
}
?>
</select>
</td>
<td align="right" style="padding-top:15px"> 
<font size="3"><b>Search :</b></font>
</td>
<td align="left">
<input type="text" name="all" id="all" class="form-control">
</td>

<td colspan="" align="left" >
<input type="button" value=" Show " class="btn btn-primary" onclick="show()">
</td>
</tr>
</tbody>
</table>
<div id="sgh">
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

     

    </body>
</html>