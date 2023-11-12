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
                Message
                        <small>Show</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Message</li>
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
                          
							
							
								 <?
				 
				 
$aa=0;
if($user_current_level<0)
{




$ms=mysqli_query($conn,"select * from main_trn where sl>0 order by sl desc");
}
else
{
$ms=mysqli_query($conn,"select * from main_trn where sl>0 and bcd='$branch_code' order by sl desc");
}
 while ($row = mysqli_fetch_array($ms))
{
$aa++;
  $sl3=$row['sl'];
  $stsl=$row['stsl'];
  $bcd=$row['bcd'];
 $q111=mysqli_query($conn,"SELECT * FROM ".$DBprefix."branch where sl='$bcd'");
while($r111=mysqli_fetch_array($q111))
{
$bnm[]=$r111['bnm'];

}

  $queryw1 = "SELECT * FROM ".$DBprefix."stock where sl='$stsl'";
   $resultw1 = mysqli_query($conn,$queryw1);
while ($Rw1 = mysqli_fetch_array ($resultw1))
{
$stin=$Rw1['stin'];
$opst=$Rw1['opst'];
$pcd=$Rw1['pcd'];
$dt=$Rw1['dt'];

$stout=$Rw1['stout'];
$dtm=$Rw1['dtm'];
$dtm1[]=$dtm;
$bcdf=$Rw1['bcd'];
 $q1111=mysqli_query($conn,"SELECT * FROM ".$DBprefix."branch where sl='$bcdf'");
while($r1111=mysqli_fetch_array($q1111))
{
$bnmf[]=$r1111['bnm'];

}
$q1=mysqli_query($conn,"SELECT * FROM ".$DBprefix."product where sl='$pcd'");
while($r11=mysqli_fetch_array($q1))
{
$pname=$r11['pname'];
$pname1[]=$pname;
$pkgunt=$r11['pkgunt'];

}



$q12=mysqli_query($conn,"SELECT * FROM ".$DBprefix."unit where sl='$pkgunt'");
while($r123=mysqli_fetch_array($q12))
{
$tunt=$r123['tunt'];
$unitnm=$r123['unitnm'];

$stout1=$stout/$tunt;
$stout3[]=$stout1;
$unitnm1[]=$unitnm;

}

$sl4[]=$sl3;
}

$rec="Tranfers";
$br="Branch";
$to="To";
}


?>
    <?
	
	
		echo"<table border=\"0\" width=\"100%\" class=\"table table-hover table-striped table-bordered\">";
				  echo "<tr>";
				  			  echo "<td align=\"center\">Message</td>";
					echo "<td align=\"center\">Date And Time</td>";
				  
				  
				   echo "</tr>";
				  for($i=0;$i<$aa;$i++)
				  {
			
				
				  echo "<tr>";
				  echo "<td align=\"center\"><a href=\"msg.php?sl=$sl4[$i]\">$bnmf[$i]  $br  $rec$stout3[$i] $unitnm1[$i] $pname1[$i] $to $bnm[$i]</a></td>";
					echo "<td align=\"center\">$dtm1[$i]</td>";
				  
				  echo "</tr>";
				
				
				
				  }
				   echo "</table>";
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