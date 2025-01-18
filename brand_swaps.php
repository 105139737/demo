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

</script>
            <!-- Right side column. Contains the navbar and content of the page -->
           
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Brand
                        <small>Swap</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Brand Swap</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body>
 <div class="box box-success " >
<form method="post" action="brand_swapss.php" id="form1" name="form1">                    
<table border="0" class="table table-hover table-striped table-bordered" >
            <tr>
		    <td align="right" width="10%" style="padding-top:15px;" ><b>From Brand :</b></td>
            <td  align="left" width="30%">         
			<select name="fbnd" id="fbnd" class="form-control">
			<option value="">---Select---</option>
			<?php  
			$sqls  = mysqli_query($conn,"select * from main_catg") or die(mysqli_error($conn));
			while($rr = mysqli_fetch_array($sqls))
			{
				$catsl = $rr['sl'];
				$cnms = $rr['cnm'];
				?>
				<option value="<?php  echo catsl;?>"><?php  echo $cnms; ?></option>
				<?php 
			}
			?>
			</select>
			</td>
			 <td align="right" width="10%" style="padding-top:15px;" ><b>To Brand :</b></td>
            <td  align="left" width="30%">
            <select name="tbnd" id="tbnd" class="form-control">
			<option value="">---Select---</option>
			<?php  
			$sqlss  = mysqli_query($conn,"select * from main_catg") or die(mysqli_error($conn));
			while($rrr = mysqli_fetch_array($sqlss))
			{
				$catsls = $rrr['sl'];
				$cnmss = $rrr['cnm'];
				?>
				<option value="<?php  echo catsls;?>"><?php  echo $cnmss; ?></option>
				<?php 
			}
			?>
			</select>
			</td>
			<td align="center" width="20%">
		    <input type="submit" class="btn btn-success" value="Swap" name="B1" >
			
		    </td>
		    </tr>
</table>
</div>
</form>	
</body>
