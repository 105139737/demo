<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$cy=date('Y');
?>
<html>
<head>
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
</style> 
<link rel="stylesheet" type="text/css" href="style_sedt1.css" />
<script type="text/javascript" src="prdcedt.js"></script>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
 	<script>	

 function show()
 {
 
 var pnm= document.getElementById('pnm').value;

 $('#sgh').load('stock_closings.php?pnm='+pnm).fadeIn('fast');

 }

function exp()
{
	 var pnm= document.getElementById('pnm').value;

	document.location='stock_closing_xls.php?pnm='+pnm;
}


</script>

	</head>
 <body >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Stock Statement
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Stock Statement</li>
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
 	<form method="post" action="brnchs.php" id="form1" onSubmit="return check1()" name="form1">
                              
							
								


<input type="hidden">
  <center>
        <div class="box box-success" >
      <table border="0" width="860px" class="table table-hover table-striped table-bordered">

<tr>

<td align="right" style="padding-top:15px">
<b>Product Name : </b>
</td>
<td align="left">
<select name="pnm" class="form-control"  id="pnm" style="width:300px"  >
<option value="">All</option>
<?
$query="Select * from  main_product order by pname";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$pname=$R['pname'];
?>
<option value="<? echo $sl;?>"><? echo $pname;?></option>
<?
}
?>
</select>

</td>

</tr>
<tr>
<td colspan="8" align="right" style="padding-right:80px">
<input type="button" value=" Export To excel " class="btn btn-info" onclick="exp()">
<input type="button" value=" Show " class="btn btn-success" onclick="show()">
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
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>

	
		  $('#pnm').chosen({
  no_results_text: "Oops, nothing found!",

  });
  

</script>
     

    </body>
</html>