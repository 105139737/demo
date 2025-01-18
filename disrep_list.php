<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
?>
<html>
<head>

<div class="wrapper row-offcanvas row-offcanvas-left">
<?php 
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
/* $(document).ready(function()
{
$('#overlay').fadeOut('fast');
});
 */
function subm()
{
	var abc= document.getElementById('abc').value;
	$('#sgh').load('rec_subm.php?sl='+encodeURIComponent(abc)).fadeIn('fast');
}

function show()
{
	var typ= document.getElementById('typ').value;
	var blno= document.getElementById('blno').value;
	$('#sgh').load('disrep_lists.php?blno='+encodeURIComponent(blno)+'&typ='+typ).fadeIn('fast');
}

function pagnt(pno)
{
	var typ= document.getElementById('typ').value;
	var blno= document.getElementById('blno').value;
	var ps=document.getElementById('ps').value;
	$('#sgh').load("disrep_lists.php?ps="+ps+"&pno="+pno+"&blno="+encodeURIComponent(blno)+'&typ='+typ).fadeIn('fast');
	$('#pgn').val=pno;
}

function pagnt1(pno)
{
pno=document.getElementById('pgn').value;
pagnt(pno);
}

/* function edit(sl)
{
document.location='c_update.php?sl='+sl;
}
 */
function act(sl,val)
{
	if (confirm("Are You Sure to Cancel?") == true) 
	{
		$('#sgh').load('cancl.php?sl='+sl+'&val='+val).fadeIn('fast');
	}
}


  function checkall(val)
{

	
var j3='';
	var chk = document.getElementsByName('chk[]');
	//alert(chk.length);
	frmlen = chk.length;
	for(i=0;i<frmlen;i++)
	{
		chk[i].checked = val;
		if(i==0)
		{
		j3=chk[i].value;
		}
		else
		{
		 j3=j3+','+chk[i].value;
		
	}

	}
	
	if(!val)
    {
        document.getElementById('abc').value ="";
    }
    else
    {
		 document.getElementById('abc').value =j3;
         }
}

	function ch1()
{
var j3='';
	var chk = document.getElementsByName('chk[]');
	frmlen = chk.length;
	for(i=0;i<frmlen;i++)
	{
		
		if(i==0)
		{
			if(chk[i].checked){
		j3=chk[i].value;
			}
		}
		else
		{
			if(chk[i].checked){
		 j3=j3+','+chk[i].value;
			}}}
	document.getElementById('abc').value =j3;	
}

</script>
</head>
<body onload="show()" >
<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">Discount Report</h1>
                    <ol class="breadcrumb">
                       <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Discount Report</li>
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

<HR> 	
<form method="post" action="rec_subm.php" id="form1" name="form1">
<input type="hidden">
<center>
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="right" width="10%" style="padding-top:15px"> <font size="3"><b>Bill Type :</b></font></td>
<td align="right" width="30%" style="padding-top:15px">
	<select name="typ" id="typ" class="form-control" size="1">
		<option value="0">Unbilled</option>
		<option value="1">Billed</option>
		<option value="2">Cancelled</option>
	</select>
</td>
<td align="right" width="10%" style="padding-top:15px"> <font size="3"><b>Search :</b></font></td>

<td align="left" width="30%">
<input type="text" name="blno" id="blno" class="form-control" placeholder="Search By Bill Number">
</td>
<td align="left" width="10%">
<input type="button" value=" Show " class="btn btn-primary" onclick="show()">
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