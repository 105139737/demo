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
 	<script>	

 function show()
 {
 
 var pnm= document.getElementById('pnm').value;
  var y= document.getElementById('y').value;
    var m= document.getElementById('m').value;
	 var brncd= document.getElementById('brncd').value;
 $('#sgh').load('stock_sts.php?pnm='+pnm+'&y='+y+'&m='+m+'&brncd='+brncd).fadeIn('fast');

 }

function exp()
{
	 var pnm= document.getElementById('pnm').value;
  var y= document.getElementById('y').value;
    var m= document.getElementById('m').value;
		 var brncd= document.getElementById('brncd').value;
	document.location='stock_sts_xls.php?pnm='+pnm+'&y='+y+'&m='+m+'&brncd='+brncd;
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
<b>Year : </b>
<td align="left">
            <select  id="y" name="y" class="form-control">
		<?
			for($i=2013; $i<=$cy+1;$i++)
			{
			?>
<option value="<?=$i;?>" <?=$i==$cy ? 'selected' : ''?> ><?=$i;?></option>
<?
}
?>					
</select>
</td>
<td align="right" style="padding-top:15px">
<b>Month : </b>
</td>
<td align="left">

  <select name="m" id="m" value="" class="form-control">
	  <option value="">---Select---</option>
	  <option value="01" <?='01'==date('m') ? 'selected' : ''?>>January</option>
	  <option value="02"<?='02'==date('m') ? 'selected' : ''?>>February</option>
	  <option value="03"<?='03'==date('m') ? 'selected' : ''?>>March</option>
	  <option value="04"<?='04'==date('m') ? 'selected' : ''?>>April</option>
	  <option value="05"<?='05'==date('m') ? 'selected' : ''?>>May</option>
	  <option value="06"<?='06'==date('m') ? 'selected' : ''?>>June</option>
	  <option value="07"<?='07'==date('m') ? 'selected' : ''?>>July</option>
	  <option value="08"<?='08'==date('m') ? 'selected' : ''?>>August</option>
	  <option value="09"<?='09'==date('m') ? 'selected' : ''?>>September</option>
	  <option value="10"<?='10'==date('m') ? 'selected' : ''?>>October</option>
	  <option value="11"<?='11'==date('m') ? 'selected' : ''?>>November</option>
	  <option value="12"<?='12'==date('m') ? 'selected' : ''?>>December</option>
	  </select>
</td>
<td align="right" style="padding-top:15px">
<b>Product Name : </b>
</td>
<td align="left">
<select name="pnm" class="form-control"  id="pnm" style="width:300px"  >
<option value="">All</option>
<?
$query="Select * from  main_product order by pnm";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$pname=$R['pnm'];
$mnm=$R['mnm'];
?>
<option value="<? echo $sl;?>"><? echo $pname;?> - <? echo $mnm;?></option>
<?
}
?>
</select>

</td>
<td align="right" style="padding-top:10px">
<b>Branch : </b>
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