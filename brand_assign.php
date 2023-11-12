<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
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
var slp= document.getElementById('slp').value;
$('#sgh').load('brnd_assign_list.php?slp='+encodeURIComponent(slp)).fadeIn('fast');
}
function pagnt(pno){
var ps=document.getElementById('ps').value;
var slp=document.getElementById('slp').value;
$('#sgh').load("brnd_assign_list.php?ps="+ps+"&pno="+pno+"&slp="+encodeURIComponent(slp)).fadeIn('fast');
$('#pgn').val=pno;
}
function pagnt1(pno){
pno=document.getElementById('pgn').value;
pagnt(pno);
}

function edit(sl)
{
document.location='brand_assign_edt.php?tm='+sl;
}
 

</script>


            <!-- Right side column. Contains the navbar and content of the page -->
           
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Brand Asign 
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Brand Asign </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body onload="show()">
 	<div class="box box-success " >
<form method="post" action="brand_assigns.php" id="form1" onSubmit="return check1()" name="form1">                    
<table border="0" class="table table-hover table-striped table-bordered" >
            <tr>
			
					    <td align="right" width="13%" style="padding-top:15px;" ><b>User Name  :</b></td>
            <td  align="left" width="35%">
            <select name="slp" class="form-control" size="1" id="slp" tabindex="8"  required onchange="show()">
<Option value="">---Select---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_sale_per order by spid");

		while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$spid=$row1['spid'];
?>
<Option value="<?=$spid;?>"><?=$spid;?></option>
	<?}?>
</select>
			</td>
			
			
			
			
		    <td align="right" width="11%" style="padding-top:15px;" ><b>Brand :</b></td>
            <td  align="left" width="">
            <select name="cat[]" multiple class="form-control" size="1" id="cat" tabindex="8"  required>
<Option value="ALL">ALL</option>
<?
$data13 = mysqli_query($conn,"Select * from main_catg");

		while ($row13 = mysqli_fetch_array($data13))
	{
	$sl3=$row13['sl'];
	$cnm=$row13['cnm'];
?>
<Option value="<?=$sl3;?>"><?=$cnm;?></option>
	<?}?>
</select>
			</td>

			
		</tr><tr>
			
		    <td align="right" colspan="4">
		    <input type="submit" class="btn btn-success" value="Submit" name="B1" >
		    </td>
		    </tr>
	
</table>
      
   </div>



</form>
<div class="box box-success" id="sgh">
</div>	
</body>


     <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>
$('#slp').chosen({no_results_text: "Oops, nothing found!",});	
$('#cat').chosen({no_results_text: "Oops, nothing found!",});	
</script>

