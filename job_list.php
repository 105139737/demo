<?php
include("membersonly.inc.php");
$pageno = $_POST['pageno'];
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;

?>
<table  class="table table-hover table-striped table-bordered">
  <thead>
    <tr>    
      <th scope="col">#id</th>
      <th scope="col">Report</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>  
      <th scope="col">Requested</th>  
      <th scope="col">Completed</th>
      <th scope="col">Requested By</th>
    </tr>
  </thead>

  <tbody>
<?php 
$eby=strtolower($user_currently_loged);
if($user_currently_loged=='admin' or $user_currently_loged=='hdadmin')
{
  $q="SELECT *  FROM main_aa_jobs where id>0 order by id desc LIMIT $offset, $no_of_records_per_page";
}
else{
  $q="SELECT *  FROM main_aa_jobs where eby='$eby' order by id desc LIMIT $offset, $no_of_records_per_page";
}
$data=mysqli_query($conn,$q)or die(mysqli_error($conn));
  while($row=mysqli_fetch_array($data))
    {
      $id=$row['id'];
      $nm=$row['nm'];
      $status=$row['status'];
      $file=$row['file'];
      $req_date=$row['req_date'];
      $comp_date=$row['comp_date'];
      $eby=$row['eby'];
    ?>
    <tr>      
      <td data-label="Brand"><? echo $id;?></td>
      <td data-label="Category"><? echo $nm;?></td>
      <td data-label="Model Name"><? echo $status;?></td>
      <td data-label="Model Name"><?php if($status=='Done'){?><a target="_new" href="<?php echo  $file;?>">Download Now</a><?php } ?></td>
      <td data-label="Model Name"><? echo $req_date;?></td>
      <td data-label="Model Name"><? echo $comp_date;?></td>
      <td data-label="Model Name"><? echo $eby;?></td>

    </tr>
    <?php
}
?>
  </tbody>
</table>

