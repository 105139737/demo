<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');

$sl=$_REQUEST['sl'];
$data=mysqli_query($conn,"select * from main_reorder where sl='$sl'")or die(mysqli_error($conn));
while($row = mysqli_fetch_array($data))
{
$gdn= $row['bcd'];
$prd= $row['pcd'];
$reord= $row['re'];
}
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
 function check1()
{
 if(document.form1.gdn.value=='')
{
alert("Please Select Godown !");
document.form1.gdn.focus();
 return false;
	  }
 if(document.form1.prd.value=='')
{
alert("Please Select Product !");
document.form1.prd.focus();
 return false;
	  }
	   if(document.form1.reord.value=='')
{
alert("Please Enter Reorder Level !");
document.form1.reord.focus();
 return false;
	  }

else
{
 document.forms["form1"].submit();
}
}

function check(evt)
{
evt =(evt) ? evt : window.event;
var charCode = (evt.which) ? evt.which : evt.keyCode;						// ONLY NUMBER FOR NUMBER FIELD
if(charCode > 31 && (charCode < 48 || charCode > 57))
{
return false;
}
 return true;	
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
					<HR> 	<form method="post" action="reord_edits.php" id="form1" onSubmit="return check1()" name="form1"  enctype="multipart/form-data">
  <center>
        <div class="box box-success" >
        <table border="0" class="table table-hover table-striped table-bordered">
          <tr>
            <td align="right" >Godown :</td>
            <td align="left" >
            <select class="form-control" name="gdn" id="gdn">
			<option value="">-----Select-----</option>
			<?
			$qr1=mysqli_query($conn,"select * from main_branch order by bnm")or die(mysqli_error($conn));
			while($r1=mysqli_fetch_array($qr1))
			{
					$sl1=$r1['sl'];	
					$bnm=$r1['bnm'];
				?>
				<option value="<?=$sl1;?>"<?if($gdn==$sl1) {echo 'selected';}?>><?=$bnm;?></option>
				<?
			}
			?>
			</select>
			</td>
            <td align="right" >Product :</td>
            <td align="left" >
            <select name="prd" id="prd" class="form-control">
			<option value="">-----Select-----</option>
			<?
			$qr=mysqli_query($conn,"select * from main_product order by pnm")or die(mysqli_error($conn));
			while($r=mysqli_fetch_array($qr))
			{
					$sl2=$r['sl'];	
					$pnm=$r['pnm'];
				?>
				<option value="<?=$sl2;?>"<?if($prd==$sl2) {echo 'selected';}?>><?=$pnm;?></option>
				<?
			}
			?>
			</select>
			</td>
		  </tr>
     <tr>
	             <td align="right" >Reorder :</td>
            <td align="left" >
            <input type="text" name="reord" id="reord" value="<?=$reord;?>" class="form-control" onkeypress="return check(event)" placeholder="Enter Reorder"></td>
			</td>

            <td colspan="4" align="right"  style="padding-right: 8px;">
             <input type="submit" value="Update" class="btn btn-primary" name="B1">
			  </td>
          </tr>
          </table>
		  <input type="hidden" name="sl0" id="sl0" value="<?=$sl;?>" >
  </form>
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
</html>