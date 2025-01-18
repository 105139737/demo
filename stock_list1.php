<?php 
$reqlevel = 3;
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

 		




	<script src="jquery.cookie.js" type="text/javascript"></script>
	<script src="jquery.treeview.js" type="text/javascript"></script>
	<script type="text/javascript" src="demo.js"></script>
	<link rel="stylesheet" href="jquery.treeview.css" />
	</head>
<body >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
               Stock View
                    
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Stock</li>
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
                          
							
							
							
							
							
							
					<HR> 	<form method="post" action="#" id="form1" name="form1"   style="position:relative;">
                              
							
								



  <center>
        <div class="box box-success" >

<div id="treecontrol" align="left">
		<a title="Collapse the entire tree below" href="#">Collapse All</a> | 
		<a title="Expand the entire tree below" href="#"> Expand All</a> | 
		<a title="Toggle the tree below" href="#"> Toggle All</a>
	</div>


<ul id="red" class="treeview-red">
<p align="left"><b>Product List</b></p>
<?php 
$data= mysqli_query($conn,"select * from  main_stock where sl>0 and bcd='$branch_code' group by pcd")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	$c3++;
$pcd=$row['pcd'];






 $query = "SELECT * FROM ".$DBprefix."product where sl='$pcd'";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$pcd=$R['sl'];
$b=$R['pname'];
$c=$R['pkgunt'];
$tech=$R['tech'];
$co=$R['co'];
$catg=$R['catg'];
}
$query1="Select * from ".$DBprefix."unit where sl='$c'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$punt=$R1['pkgunt'];
$upkg=$R1['untpkg'];
$ptu=$R1['tunt'];
}
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and bcd='$branch_code'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
$stkf=$stck/$ptu;



?>
<li align="left"><span><b> <font size="4"><?php  echo $b;?></font></b> (Category : <?php  echo $catg;?>) (Stock : <b><font size="3"><?php  echo $stkf."</font></b> ".$punt;?>) (Tech : <?php  echo $tech;?>) (Comp : <?php  echo $co;?>)</span>
<ul>

<?php 
$to=0;
 $query3="Select * from ".$DBprefix."stock where pcd='$pcd' and bcd='$branch_code' group by betno order by expdt";
$result3 = mysqli_query($conn,$query3);
  while ($R3 = mysqli_fetch_array ($result3))
{
$sl=$R3['sl'];
$betno=$R3['betno'];
$ret=$R3['ret'];
$expdt=$R3['expdt'];

 $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and betno='$betno' and bcd='$branch_code' group by betno";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck1=$R4['stck1'];
$stkf1=$stck1/$ptu;
$ret1=$ret*$ptu;
}
$sv=$stkf1*$ret1;
$to=$to+$sv;
?>
<li><span><b> <font size="3">Batch No. <?php  echo $betno;?></font></b> (<?php  echo $expdt;?>) (Stock : <b><font size="3"><?php  echo $stkf1."</font></b> ".$punt;?>) ( MRP Rs. <b><?php  echo $ret1."</b> /".$punt;?>)  (Stock Value : <b><?php  echo $sv;?></b> )</span></li>


<?php 	
}
?>

</ul>

</li>
<p align="left">Total Stock Value : <b>Rs.<?php echo number_format($to,2);?> </b></p>
<?php 
}
?>	

</ul>
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