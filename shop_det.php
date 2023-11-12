<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$data1= mysqli_query($conn,"select * from  main_cnm") or die(mysqli_error($conn));
while ($row11 = mysqli_fetch_array($data1))
{
$cnm=$row11['cnm'];
$addr=$row11['addr'];
$plicno=$row11['plicno'];
$sl=$row11['sl'];
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
<aside class="right-side">
 <section class="content-header">

                    <h1 align="center">

                    Shop Details

                        <small>View</small>

                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>

                        <li class="active">Shop Details</li>

                    </ol>

                </section>
<section class="content">

<HR> 	<form method="post" action="brnchs.php" id="form1" onSubmit="return check1()" name="form1">
<center>

        <div class="box box-success" >

        <table border="0"  width="1000px"  align="center" class="table table-hover table-striped table-bordered">
<tr>
<td align="right" >Shop Name :</td>

            <td align="left" >
				<div id="cnm1<?=$sl;?>">
<a  onclick="sedt('<?echo $sl;?>','cnm','<?echo $cnm;?>','cnm1<?=$sl;?>','main_cnm')"><b><? echo $cnm;?></font></b></a>
 </div> 
			</td>
<td align="right" >Shop Address :</td>
 <td align="left" >
 		<div id="addr<?=$sl;?>">
<a  onclick="sedt('<?echo $sl;?>','addr','<?echo $addr;?>','addr<?=$sl;?>','main_cnm')"><b><? echo $addr;?></font></b></a>
 </div> 
</td>
<td align="right" >VAT No :</td>
<td align="left" >
	<div id="plicno<?=$sl;?>">
<a  onclick="sedt('<?echo $sl;?>','plicno','<?echo $plicno;?>','plicno<?=$sl;?>','main_cnm')"><b><? echo $plicno;?></font></b></a>
 </div>
</td>
			</tr>
</table>
</div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
</div>
                            </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
 </body>
 	<script>
function sedt(sl,fn,fv,div,tblnm)
{
$("#"+div).load("gisedt.php?sl="+sl+"&fn="+fn+"&fv="+encodeURI(fv)+"&div="+div+"&tblnm="+tblnm).fadeIn('fast');
}
function edt1(sl,fn,fv,div,tblnm)
{
	

$("#"+div).load("gisedts.php?sl="+sl+"&fn="+fn+"&fv="+encodeURI(fv)+"&div="+div+"&tblnm="+tblnm).fadeIn('fast');
}

</script>
</html>