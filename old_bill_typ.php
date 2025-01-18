<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$fdt=date('Y-m-d');
?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<style type="text/css"> 
th{
text-align:center;
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
<script>
function get_list()
{
	var all= document.getElementById('all').value;
	var tp1= document.getElementById('tp1').value;
	var brand1= document.getElementById('brand1').value;
	var brncd1= document.getElementById('brncd1').value;
	$('#div_list').load('old_billtyp_select.php?all='+encodeURIComponent(all)+'&tp1='+tp1+'&brand1='+brand1+'&brncd1='+brncd1).fadeIn('fast');
}
function submit(sl)
{
document.getElementById('bsl').value=sl;	
document.forms["form1"].submit();
}
</script>
				<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Bill Type (Old Stock)
                        <small>Sale Return</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Bill Type (Old Stock)</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body onload="get_list()">

<form method="post" action="old_billing_gst_ret.php" id="form1" name="form1" target="_BLANK">      
<input type="hidden" class="form-control"  tabindex="1"  name="bsl" id="bsl" >              
<div class="box box-success" >
<table border="0" class="table table-hover table-striped table-bordered">
<tr>
<td  align="left">
<b>Type :</b>
<select name="tp1" id="tp1" class="form-control"  tabindex="1"  >
<option value="">---ALL---</option>		
<option value="1">Retail</option>		
<option value="2">Wholesale</option>		
</select>
</td>
<td>
<b>Brand : </b>
<select name="brand1" id="brand1" class="form-control"  tabindex="1"  >
<option value="">---ALL---</option>
<?php 
$dsql=mysqli_query($conn,"select * from main_catg order by sl") or die (mysqli_error($conn));
while($erow=mysqli_fetch_array($dsql))
{
$bsl=$erow['sl'];
$cnm=$erow['cnm'];
?>
<option value="<?php  echo $bsl;?>"><?php  echo $cnm;?></option>
<?php 
}
?>
</select>
</td>
<td align="left" >
<b>Branch : </b>
<select name="brncd1" class="form-control"  tabindex="1"   size="1" id="brncd1" >
<?php 
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<option value="">---ALL---</option>
<?php 
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
<option value="<?php  echo $sl;?>"><?php  echo $bnm;?></option>
<?php 
}
?>
</select>
</td>
<td  align="left" >
<b>Search :</b>
<input type="text" class="form-control"  tabindex="1"  name="all" id="all" placeholder="Search Here....">
</td>

<td align="left" >
<br>
<input type="button" class="btn btn-info" value="Show" name="B1" onclick="get_list()" >
</td>
</tr>
</table>
<div id="div_list"></div>
</div>	
</form>
                       
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   
</body>