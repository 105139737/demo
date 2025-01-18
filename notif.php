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
#boxpopup{

left:100%;
position:fixed;
}

select.sc {
	width: 250px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 7px;
}
</style> 

 		





	</head>
 <body >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                Notification
                        <small>Show</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Notification</li>
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
                          
							
							
								 <?php 
				 
				 
  $aa=0;

 $c=mysqli_query($conn,"select * from main_product");
 while($r=mysqli_fetch_array($c))
 {
 $sl=$r['sl'];
 $reo=$r['reo'];
$pname=$r['pname'];
$pkgunt=$r['pkgunt'];
$c2=mysqli_query($conn,"select * from main_stock order by pcd");
while($r6=mysqli_fetch_array($c2))
{
$dtm1=$r6['dtm'];
}
$c1=mysqli_query($conn,"select ((sum(opst)+sum(stin))-sum(stout)) as Z from main_stock where pcd='$sl'");

while($r1=mysqli_fetch_array($c1))
{
$opst=$r1['Z'];
}

if($opst<=$reo)
{

$q12=mysqli_query($conn,"SELECT * FROM ".$DBprefix."unit where sl='$pkgunt'");
while($r12=mysqli_fetch_array($q12))
{
$tunt=$r12['tunt'];
$unitnm=$r12['unitnm'];

$opst1=$opst/$tunt;

}


$aa++;
$dtm[]=$dtm1;
$mm[]=$unitnm;;
$mn[]=$opst1;;
$nn[]=$pname;

 }
 
 
	 }
 

 

 ?>		
					
							
		

				
                  <?php 
				  for($i=0;$i<$aa;$i++)
				  {
				    $m=$i+1;
					echo"<table border=\"0\" width=\"100%\" class=\"table table-hover table-striped table-bordered\">";
				
				  echo "<tr>";
				  echo "<td align=\"center\">You Have $mn[$i] $mm[$i] of $nn[$m] Remaining Left.</td>";
				
				  
				  echo "</tr>";
				
				
				 echo "</table>";
				  }
				  ?>
		
							





                                <div class="box-footer clearfix no-border">
                                
                                </div>
                  
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->
</div>
     

    </body>
</html>