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
$('#sgh').load('cust_w_list.php?all='+encodeURIComponent(all)+'&brand='+brand+'&typ='+typ+'&sale_per='+sale_per+'&brncd='+brncd).fadeIn('fast');
}

function pagnt(pno)
{
var ps=document.getElementById('ps').value;
var all=document.getElementById('all').value;
var brand= document.getElementById('brand').value;
var typ= document.getElementById('typ').value;
var sale_per= document.getElementById('sale_per').value;
var brncd= document.getElementById('brncd').value;
$('#sgh').load("cust_w_list.php?ps="+ps+"&pno="+pno+"&all="+encodeURIComponent(all)+'&brand='+brand+'&typ='+typ+'&sale_per='+sale_per+'&brncd='+brncd).fadeIn('fast');
$('#pgn').val=pno;
}

function excl()
{
var all= document.getElementById('all').value;
var brand= document.getElementById('brand').value;
var typ= document.getElementById('typ').value;
var brncd= document.getElementById('brncd').value;
var sale_per= encodeURIComponent(document.getElementById('sale_per').value);
document.location='cust_w_list_exl.php?all='+encodeURIComponent(all)+'&brand='+brand+'&typ='+typ+'&sale_per='+sale_per+'&brncd='+brncd;	
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
<div class="box box-success" >
<table border="0" class="table table-hover table-striped table-bordered">
<tr>
<td width="16%">
<b>Branch:</b><br>
<select name="brncd" class="form-control" size="1" id="brncd"   >
<?
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<option value="">---Select---</option>
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
<td width="16%" hidden>
<b>Type : </b>
<input type="hidden" id="typ" name="typ" value="<?php echo "2";?>">
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

<td align="left" width="30%">
<b>Search :</b>
<input type="text" name="all" id="all" class="form-control">
</td>
</tr><tr>

<td align="right" colspan="5"><br>
<input type="button" value=" Excel Export " class="btn btn-success" onclick="excl()">&nbsp;&nbsp;
<input type="button" value=" Show " class="btn btn-info" onclick="show()">
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