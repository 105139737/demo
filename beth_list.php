<?php 

$reqlevel = 1;

include("membersonly.inc.php");



$frmnm='';
$_REQUEST['all']??""
date_default_timezone_set('Asia/Kolkata');

$dt = date('d-M-Y');



$cy=date('Y');

$all=rawurldecode($_REQUEST[all]);

$al="%".$all."%";

if($all!="")

{

	$all1=" and pcd LIKE '$al'";

}

else

{

$all1="";	

}





$pno=rawurldecode($_REQUEST[pno]);



//echo $src;

$ps=rawurldecode($_REQUEST['ps'] ?? "");

if($ps=="")

{

$ps=50;

}

if($pno==""){$pno=1;}

$start=($pno-1)*$ps;









?>

<div align="left">

<input type="text" name="ps" id="ps" value="<?php  echo $ps;?>" size="7" onblur="pagnt1(this.value)">

</div>

  <table  class="table table-hover table-striped table-bordered"  >

		

		     <tr>

			  <th >Action</font></th>

			  <th >No.</font></th>

            <th >Product Name</font></th>

	    

		<th >Expiry Date</font></th>

		<th >Batch No.</font></th>

		    </tr>

<?php 



$sl=$start;

$sln=0;

$datatt= mysqli_query($conn,"select * from  main_stock where sl>0")or die(mysqli_error($conn));

$rcntttl=mysqli_num_rows($datatt);

$datar= mysqli_query($conn,"select * from main_stock where  sl>0".$all1)or die(mysqli_error($conn));

$rcnt=mysqli_num_rows($datar);

 $data= mysqli_query($conn,"select main_stock.pcd,main_stock.expdt,main_stock.betno,main_stock.sl,main_product.pname from  main_stock INNER JOIN main_product ON (main_stock.pcd=main_product.sl) $all1 group by pcd limit $start,$ps")or die(mysqli_error($conn));

 

while ($row = mysqli_fetch_array($data))

{

$pname=$row['pname'];

$expdt=$row['expdt'];

$betno=$row['betno'];

$pcd=$row['pcd'];

$x=$row['sl'];

if($expdt!="0000-00-00")

{

$expdt=date('d-m-Y', strtotime($expdt));

}

$data2= mysqli_query($conn,"select * from main_billdtls where prsl='$pcd' and betno='$betno'")or die(mysqli_error($conn));

$count=mysqli_num_rows($data2);

if($count==0)

{

$sln++;

         

  $sl++; 



	

			 ?>

		   <tr  >

		  

		   <td  align="center" style="cursor:pointer" onclick="edit('<?php  echo $x;?>')" >

			<i class="fa fa-pencil-square-o"></i>

			</td>

		

      	    <td align="center"><?php  echo $sln;?></td>

            <td align="center"><?php  echo $pname;?></td>

            <td align="center"><?php  echo $expdt;?></td>

			<td align="center"><?php  echo $betno;?></td>

			

		     </tr>	 

<?php 

}}

?>

 </table>

<?php 

$tp=$rcnt/$ps;

if(($rcnt%$ps)>0)

{

    $tp=floor($tp)+1;

}

if($pno==1)

{

    $prev=1;

}

else

{

$prev=$pno-1;    

}

if($pno==$tp)

{

 $next=$tp;   

}

else

{

$next=$pno+1;

}

$flt="";

if($rcnt!=$rcntttl)

{

    $flt="(filtered from ".$rcntttl." total entries)";

}

echo "Showing ".($start+1)." to ".($sl)." of ".$rcnt." entries".$flt;

?>

<div align="center"><input type="text" size="10" id="pgn" name="pgn" value="<?php  echo $pno;?>"><input Type="button" value="Go" onclick="pagnt1('')"></div>

<div class="pagination pagination-centered">

                            <ul class="pagination pagination-sm inline">

							<li <?php  if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('1')"><i class="icon-circle-arrow-left"></i>First</a></li>

                            <li <?php  if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $prev;?>')"><i class="icon-circle-arrow-left"></i>Previous</a></li>

                            <?php 

                            

                            if($tp<=5)

                            {

                              $n=1;  

                              while($n<=$tp)

                              {

                                ?>

                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   

                                <?php 

                                $n+=1;

                              }  

                            }

                            else

                            {

                                if($pno<4)

                                {

                                  $n=1;

                                  while($n<=5)

                              {

                                ?>

                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   

                                <?php 

                                $n+=1;

                              }     

                                }

                                elseif($pno>$tp-3)

                                {

                                    $n=$tp-5;

                                    while($n<=5)

                              {

                                ?>

                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   

                                <?php 

                                $n+=1;

                              }   

                                }

                                else

                                {

                                $n=$pno-2; 

                                 while($n<=$pno+2)

                              {

                                ?>

                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   

                                <?php 

                                $n+=1;

                              }     

                                }

                               

                                

                                

                            }

                            ?>

                            <li <?php  if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $next;?>')">Next<i class="icon-circle-arrow-right"></i></a></li>

                            <li <?php  if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $tp;?>')">Last<i class="icon-circle-arrow-right"></i></a></li>

                            </ul>

                            </div>

							