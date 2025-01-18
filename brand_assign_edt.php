<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$slp=$_REQUEST['tm']??"";

$data= mysqli_query($conn,"select * from  main_slp_brnd where sl='$slp'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$x=$row['sl'];
$spsl=$row['spsl'];
$catsl=$row['catsl'];
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


</script>


            <!-- Right side column. Contains the navbar and content of the page -->
           
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Brand Asign
                        <small>Edit</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Brand Asign</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body >
 	<div class="box box-success " >
<form method="post" action="brand_assigns_edt.php" id="form1" onSubmit="return check1()" name="form1">                    
<table border="0" class="table table-hover table-striped table-bordered" >

	<input type="hidden" value="<?php echo $x;?>" name="sl" id="sl" class="form-control"  readonly >


            <tr>
			
					    <td align="right" width="13%" style="padding-top:15px;" ><b>User Name  :</b></td>
            <td  align="left" width="35%">
            <select name="slp" class="form-control" size="1" id="slp" tabindex="8"  required >
<Option value="">---Select---</option>
<?php 
$data1 = mysqli_query($conn,"Select * from main_sale_per order by spid");

		while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$spid=$row1['spid'];
?>
<Option value="<?php  echo $spid;?>" <?php if($spsl==$spid){echo 'Selected';}?>><?php  echo $spid;?></option>
	<?php }?>
</select>
			</td>
			
			
			
			
		    <td align="right" width="11%" style="padding-top:15px;" ><b>Brand :</b></td>
            <td  align="left" width="">
            <select name="cat[]" multiple class="form-control" size="1" id="cat" tabindex="8" >
			<Option value="ALL">ALL</option>
<?php 
$data13 = mysqli_query($conn,"Select * from main_catg where sl>0 and find_in_set(sl,'$catsl')>0 ");

		while ($row13 = mysqli_fetch_array($data13))
	{
	$sl3=$row13['sl'];
	$cnm=$row13['cnm'];
?>
<Option value="<?php  echo $sl3;?>" selected ><?php  echo $cnm;?></option>
	<?php }?>
	<?php 
$data2 = mysqli_query($conn,"Select * from main_catg where sl>0 and find_in_set(sl,'$catsl')=0 ");
while ($row1 = mysqli_fetch_array($data2))
{
$sl3=$row1['sl'];
$cnm=$row1['cnm'];
?>
<option value="<?php  echo $sl3;?>"><?php  echo $cnm;?></option>
<?php 
}?>	
	
	
</select>
			</td>

			
		</tr><tr>
			
		    <td align="right" colspan="4">
		    <input type="submit" class="btn btn-primary" value="Update" name="B1" >
		    </td>
		    </tr>
	
</table>
      
   </div>



</form>
<div class="box box-success" >
</div>	

</body>


     <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>
$('#slp').chosen({no_results_text: "Oops, nothing found!",});	
$('#cat').chosen({no_results_text: "Oops, nothing found!",});	
</script>

