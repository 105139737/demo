<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
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
</style> 
 <script>

function show()
{
	var gdn=document.getElementById("gdn").value;
	var prd=document.getElementById("prd").value;
	$("#list").load("reord_vws.php?gdn="+gdn+"&prd="+prd).fadeIn("fast");
}		

 </script>
  <body onload="show()">          <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                    Reorder
                        <small>Level</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Reorder Level</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
					<HR> 	<form method="post" action="reord_entrs.php" id="form1" onSubmit="return check1()" name="form1"  enctype="multipart/form-data">
  <center>
        <div class="box box-success" >
        <table border="0" class="table table-hover table-striped table-bordered">
          <tr>
            <td align="right" width="20%">Godown :</td>
            <td align="left" width="30%">
            <select class="form-control" name="gdn" id="gdn">
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
            <td align="right" width="10%">Product :</td>
            <td align="left" width="30%">
            <select name="prd" id="prd" class="form-control">
			<option value="">-----Select-----</option>
			<?
			$qr=mysqli_query($conn,"select * from main_product order by sl")or die(mysqli_error($conn));
			while($r=mysqli_fetch_array($qr))
			{
					$sl=$r['sl'];	
					$pnm=$r['pnm'];
				?>
				<option value="<?=$sl;?>"><?=$pnm;?></option>
				<?
			}
			?>
			</select>
			</td>

            <td align="left" width="10%">
             <input type="button" value="Show" class="btn btn-primary" name="B1" onclick="show()">
			  </td>
          </tr>
          </table>
  </form>
<div id="list"></div>
  </div>
							<!-- /.box-body -->
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
	<link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>
  <script>

	
		  $('#prd').chosen({
  no_results_text: "Oops, nothing found!",

  });

</script>
</html>