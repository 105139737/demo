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
$(document).ready(function()
{
$('#overlay').fadeOut('fast');
});

function show()
{
var all= document.getElementById('all').value;
var brand= document.getElementById('brand').value;
var typ= document.getElementById('typ').value;
var brncd= document.getElementById('brncd').value;
var sale_per= encodeURIComponent(document.getElementById('sale_per').value);
var gtm= document.getElementById('gtm').value;
var stat= document.getElementById('stat').value;
$('#sgh').load('c_list.php?all='+encodeURIComponent(all)+'&brand='+brand+'&typ='+typ+'&sale_per='+sale_per+'&brncd='+brncd+'&gtm='+gtm+'&stat='+stat).fadeIn('fast');
}

function pagnt(pno)
{
var ps=document.getElementById('ps').value;
var all=document.getElementById('all').value;
var brand= document.getElementById('brand').value;
var typ= document.getElementById('typ').value;
var sale_per= document.getElementById('sale_per').value;
var brncd= document.getElementById('brncd').value;
var gtm= document.getElementById('gtm').value;
var stat= document.getElementById('stat').value;
$('#sgh').load("c_list.php?ps="+ps+"&pno="+pno+"&all="+encodeURIComponent(all)+'&brand='+brand+'&typ='+typ+'&sale_per='+sale_per+'&brncd='+brncd+'&gtm='+gtm+'&stat='+stat).fadeIn('fast');
$('#pgn').val=pno;
}

function pagnt1(pno)
{
pno=document.getElementById('pgn').value;
pagnt(pno);
}


function edit(sl)
{
document.location='c_update.php?sl='+sl;
}
function app_add(sl)
{
$('#sgh').load('app_add.php?sl='+sl).fadeIn('fast');
}
function pin_dis(cont)
{
$('#cnt1').load('pin_dis.php?cont='+cont).fadeIn("fast");
$('#compose-modal').modal('show');	
}
function pin_diss()
{
var cont= document.getElementById('cont').value;
var pin= document.getElementById('pin').value;
var distn= document.getElementById('distn').value;

$('#sgh').load('pin_diss.php?cont='+cont+'&pin='+pin+'&distn='+distn).fadeIn('fast');

}
function tcs1(sl,val)
{
$('#alld').load('tcs_cust.php?sl='+sl+'&val='+val+'&fld=tcs').fadeIn('fast');
}
function fun_stat(sl,val)
{
$('#alld').load('tcs_cust.php?sl='+sl+'&val='+val+'&fld=stat').fadeIn('fast');
}
function ship(sl)
{
window.open('cust_ship.php?cid='+sl,'_blank');
}
</script>
</head>
<body onload="show()" >
<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                Customer
                    </h1>
                    <ol class="breadcrumb">
                       <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Customer</li>
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
    <div id="alld" >
        </div>
<div class="box box-success" >
<table border="0" class="table table-hover table-striped table-bordered">
<tr>
<td width="16%">
<b>Branch:</b><br>
<select name="brncd" class="form-control" size="1" id="brncd"   >

<option value="">---ALL---</option>
<?
$query="Select * from main_branch";$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $sl;?>"<?php if($branch_code==$sl){echo 'selected';}?>><? echo $bnm;?></option>
<?
}
?>
</select>


</td>
<td width="16%">
<b>Brand : </b>
<select name="brand" id="brand" class="form-control">
<option value="">---All---</option>
<?
$dsql=mysqli_query($conn,"select * from main_catg order by sl") or die (mysqli_error($conn));
while($erow=mysqli_fetch_array($dsql))
{
$bsl=$erow['sl'];
$cnm=$erow['cnm'];
?>
<option value="<?php echo $bsl;?>"><?php echo $cnm;?></option>
<?
}
?>
</select>
</td>
<td width="16%">
<b>Type : </b>
<select id="typ" name="typ" class="span2 form-control">
<?
$p=mysqli_query($conn,"select * from main_cus_typ order by sl desc") or die (mysqli_error($conn));
while($rw2=mysqli_fetch_array($p))
{
?>
<option value="<?=$rw2['sl'];?>" ><?=$rw2['tp'];?></option>
<?
}
?>
</select>
</td>      
<td width="16%">
<b>Sales Person : </b>
<select name="sale_per" id="sale_per" class="form-control">
<option value="">---All---</option>
<?
$dsql=mysqli_query($conn,"select * from main_sale_per order by sl") or die (mysqli_error($conn));
while($erow=mysqli_fetch_array($dsql))
{
$bsl=$erow['sl'];
$spid=$erow['spid'];
?>
<option value="<?php echo $spid;?>"><?php echo $spid;?></option>
<?
}
?>
</select>
</td> 
<td align="left"  width="8%">
    <b>GTM Code:</b><br>

	<select name="gtm" class="form-control" size="1" id="gtm" tabindex="8" >
	<Option value="">--- All ---</option>
	<Option value="1">No</option>
	<Option value="0">Yes</option>
	</select>

</td>
<td align="left"  width="8%">
    <b>Status:</b><br>

	<select name="stat" class="form-control" size="1" id="stat" tabindex="8" >
    <Option value="0">Active</option>
	<Option value="1">Deactive</option>
    <Option value="">--- All ---</option>
	</select>

</td>
<td align="left" width="16%">
<b>Search :</b>
<input type="text" name="all" id="all" class="form-control">
</td>
<td align="left" width="16%"><br>
<input type="button" value=" Show " class="btn btn-info" onclick="show()">
</td>
</tr>
</tbody>
</table>
<div id="sgh" style="overflow:scroll;">
</div>
</div>
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true"  >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="cnt1">
			</div>
        </div>
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