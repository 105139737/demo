<?php 

/**
 * @author Nirmal
 * @copyright 2014
 */
$reqlevel = 1;
include("membersonly.inc.php");
$dataa= mysqli_query($conn,"select * from  main_chat") or die(mysqli_error($conn));
while ($rowa = mysqli_fetch_array($dataa))
{	
  $user=$rowa['user'];
  $msg=$rowa['msg'];
  $dt=$rowa['dt'];
  $dttm=$rowa['dttm'];
  $tm=$rowa['tm'];
  

?>
                                    <div class="item">
                                        <img src="img/avatar3.png" alt="user image" class="offline"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php  echo $tm;?></small>
                                                <?php  echo $user;?>
                                            </a>
                                            <?php  echo $msg;?>
                                        </p>
                                    </div>
<?php 

}
?>