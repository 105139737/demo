<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
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
#sfdtl
{
	border : none;
	border-radius: 3px;
	background-image: url(images/bg1.png);
	width : 195px;
	
	display : none;
	color: #fff;
	position : absolute;
	left : 6%;
	top : 46%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	z-index:1000;
}
</style> 
<script>
function show()
{
var spid= document.getElementById('spid').value;
var custm= document.getElementById('custm').value;
$('#sgh').load('cust_assign_list.php?spid='+encodeURIComponent(spid)+'&custm='+custm).fadeIn('fast');
}
function pagnt(pno){
var ps=document.getElementById('ps').value;
var spid=document.getElementById('spid').value;
var custm= document.getElementById('custm').value;
$('#sgh').load("cust_assign_list.php?ps="+ps+"&pno="+pno+"&spid="+encodeURIComponent(spid)+'&custm='+custm).fadeIn('fast');
$('#pgn').val=pno;
}
function pagnt1(pno){
pno=document.getElementById('pgn').value;
pagnt(pno);
}

function edit(sl)
{
document.location='cust_assign_edt.php?tm='+sl;
}

function credit(sl)
{
$('#cnt').load('credit_limit.php?sl='+sl).fadeIn('fast');
$('#myModal').modal('show');	
}
function credits()
{
var cust_sl= document.getElementById('cust_sl').value;
var credit_limit= document.getElementById('credit_limit').value;
$('#sgh').load('credit_limits.php?cust_sl='+cust_sl+'&credit_limit='+credit_limit).fadeIn('fast');	
}
</script>


            <!-- Right side column. Contains the navbar and content of the page -->
           
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Customer Asign 
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Customer Asign </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body >
<div class="box box-success " >
<form method="post" action="cust_assigns.php" id="form1" onSubmit="return check1()" name="form1">                    
<table border="0" class="table table-hover table-striped table-bordered" >
<tr>
<td align="right" width="13%" style="padding-top:15px;" ><b>Sales Person :</b></td>
<td  align="left" width="35%">
<select name="spid" class="form-control" size="1" id="spid" tabindex="8"  required onchange="show()">
<Option value="">---Select---</option>
<?php 
$data1 = mysqli_query($conn,"Select * from main_sale_per order by spid");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$spid=$row1['spid'];
?>
<Option value="<?php  echo $spid;?>"><?php  echo $spid;?></option>
<?php }?>
</select>
</td>
<td align="right" width="11%" style="padding-top:15px;" ><b>Customer :</b></td>
<td  align="left" width="">
<select name="cust[]" multiple class="form-control" size="1" id="cust" tabindex="8"  required>
<?php 
$data13 = mysqli_query($conn,"Select * from main_cust where typ='2'");
while ($row13 = mysqli_fetch_array($data13))
{
$sl3=$row13['sl'];
$cnm=$row13['nm'];
?>
<Option value="<?php  echo $sl3;?>"><?php  echo $cnm;?></option>
<?php }?>
</select>
</td>			
</tr>
<tr>
<td align="right" colspan="4">
<input type="submit" class="btn btn-success" value="Submit" name="B1" >
</td>
</tr>
<tr>
<td align="right"><b>Customer:</b></td>
<td  align="left" width="">
	<input type="text" name="custid_" id="custid_" class="datalist form-control" list="datalist" onchange="show()" onkeyup="datalist(this.value,'custm')">
	<input type="hidden" name="custm" id="custm">


</td>
</tr>
<tr>
<td align="right" colspan="2">
<input type="button" class="btn btn-success" value="Show" onclick="show()" name="B1" >
</td>
</tr>
</table>
</div>
</form>
<div class="box box-success" id="sgh">
</div>	
</body>
<div class="modal" id="myModal">
	<div class="modal-dialog modal-md" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h4>Customer Credit Limit</h4>
			</div>
			<div class="page" id="cnt" ></div>
		</div>
	</div>
</div>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script src="jquery-json-to-datalist.js"></script>
<script>
function datalist(str,fld)
{
	if(str.length>2)
	{
		$('.datalist').jsonToDatalist({ jsonPath:'gen_cust_json.php?str='+encodeURIComponent(str)+'&fld='+fld });
	}
}

$('#spid').chosen({no_results_text: "Oops, nothing found!",});	
$('#cust').chosen({no_results_text: "Oops, nothing found!",});	
//$('#custm').chosen({no_results_text: "Oops, nothing found!",});	
</script>