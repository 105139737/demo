<?php 
$reqlevel = 5;
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

 	<script>	



</script>

	</head>
 <body >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Stock Details
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Stock Details</li>
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
                              
							
								


<input type="hidden">
  <center>
        <div class="box box-success" >

  <table border="0" width="860px" class="table table-hover table-striped table-bordered">
<thead>
  <tr style="background-color:#2396d6;">
     <th  align="center"    >
   Sl No.
          </th>
	   <th  align="center"   >
Name
          </th>
		     

		          <th  align="center"   >
Address
          </th>
		          <th  align="center"   >
Mobile1
          </th>
		          <th  align="center"   >
Mobile2
          </th>
		  		          <th  align="center"   >
Tp
          </th>
		  </tr>
		</thead>
<?php 

$sl=$start;
$c1='odd';
$c3=0;
$sln=0;

 $data1= mysqli_query($conn,"select * from  main_suppl group by spn")or die(mysqli_error($conn));
 while ($row1 = mysqli_fetch_array($data1))
{
	$spn=$row1['spn'];
$addr1=$row1['addr'];
  $data= mysqli_query($conn,"select * from  main_suppl where spn='$spn' and addr='$addr1'")or die(mysqli_error($conn));
  $t=mysqli_num_rows($data);
  if($t>1)
  {
while ($row = mysqli_fetch_array($data))
{
	$c3++;
$slno=$row['sl'];

$nm=$row['nm'];
$addr=$row['addr'];
$mob1=$row['mob1'];
$mob2=$row['mob2'];
$tp=$row['tp'];





$sln++;
         
  $sl++; 
  
?>

	<tr class="<?php  echo $c1;?>">
	
	<td align="center">
	<b><?php  echo $slno;?></b>
	</td>
	<td align="center" >
	<b><?php  echo $spn;?></b>
	</td>
	
	<td align="center" width="">
	<b><?php  echo $addr;?></b>
	</td>
	<td align="center" width="">
	<b><?php  echo $mob1;?></b>
	</td>
	<td align="center" width="">
	<b><?php  echo $mob2;?></b>
	</td>
	<td align="center" width="">
	<b><?php  echo $tp;?></b>
	</td>
</tr>
<?php }}}

?>	

</table>
	

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