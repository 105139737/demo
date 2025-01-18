<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$fdt=date('Y-m-d');
$typ=$_REQUEST['typ'] ?? "";
$tt=$_REQUEST['tt'] ?? "";
if($typ=='33')
{
	$pg="income.php";
}
if($typ=='44')
{
	$pg="expense.php";
}
if($typ=='J01')
{
	$pg="jrnl_form.php";
}
if($typ=='77')
{
	if($tt=='1')
	{
	$pg="recv_reg.php";	
	}
	else
	{
	$pg="recv_reg_oth.php";	
	}
	
}
if($typ=='88')
{
	$pg="pay_reg.php";
}
if($typ=='C01')
{
	$pg="crdt_note.php";
}
if($typ=='CN01')
{
	$pg="contra.php";
}
if($typ=='CC01')
{
$pg="cust_credit_note.php";
}
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
	 var typ= document.getElementById('typ').value;
	$('#div_list').load('bill_typ_accs.php?all='+encodeURIComponent(all)+'&tp1='+tp1+'&brand1='+brand1+'&brncd1='+brncd1+'&typ='+typ).fadeIn('fast');
}
function submit(sl)
{
document.getElementById('bsl').value=sl;
document.forms["form1"].submit();
}

function sedtt(sl,fn,fv,tblnm)
{
$("#pay").load("gisedts_mod1.php?sl="+sl+"&fn="+fn+"&fv="+encodeURIComponent(fv)+"&tblnm="+tblnm).fadeIn('fast');
}

</script>


   
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Bill Type
                        <small>Select</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Bill Type</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body onload="get_list()">
<form method="post" action="<?php  echo $pg;?>" target="_blank" id="form1" name="form1">      
<input type="hidden" class="form-control"  tabindex="1"  name="bsl" id="bsl" >              
<input type="hidden" class="form-control"  value="<?php  echo $typ;?>" tabindex="1"  name="typ" id="typ" >  
<div id="pay"></div>        
<div class="box box-success" >
<table border="0" class="table table-hover table-striped table-bordered">
<tr>
<td  align="left" width="22%">
<b>Type :</b>
<select name="tp1" id="tp1" class="form-control"  tabindex="1"  >
<option value="">---ALL---</option>		
<option value="1">Retail</option>		
<option value="2">Wholesale</option>		
</select>
</td>
<td  width="22%">
<b>Brand : </b><br>
<select name="brand1" id="brand1" class="form-control"  tabindex="1" onchange="get_list()" >
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
<td align="left"  width="22%">
<b>Branch : </b><br>
<select name="brncd1" class="form-control"  tabindex="1"   size="1" id="brncd1" onchange="get_list()" >
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
<td  align="left"  width="22%">
<b>Search :</b>
<input type="text" class="form-control"  tabindex="1"  name="all" id="all" placeholder="Search Here....">
</td>

<td align="left" width="12%" >
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
<link rel="stylesheet" href="chosen.css">
 
 <script src="chosen.jquery.js" type="text/javascript"></script>
   <script src="prism.js" type="text/javascript" charset="utf-8"></script>
   <script>
    $('#brand1').chosen({no_results_text: "Oops, nothing found!",});
   </script>
</body>