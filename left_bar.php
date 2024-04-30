
<!-- Left side column. contains the logo and sidebar -->           
 <aside class="left-side sidebar-offcanvas">               
 <!-- sidebar: style can be found in sidebar.less -->          
 <section class="sidebar">                    <!-- Sidebar user panel -->        
 <div class="user-panel">                     
 <div class="pull-left image">      
 </div>                      
 <div class="pull-left info">               
 <p>Hello, <?=$user_nm;?></p>                    
 <a href="#"><i class="fa fa-circle text-success"></i> Online</a>      
 </div>                 
 </div>                   
 <!-- search form -->        
 <!-- /.search form -->           
 <!-- sidebar menu: : style can be found in sidebar.less -->          
 <ul class="sidebar-menu">                      
 <li class="active">                      
 <a href="index.php">                          
 <i class="fa fa-home"></i> <span>Home</span>    
 </a>                
 </li>

<?
$sql3 = mysqli_query($conn,"select * from main_mroll where uid='$user_currently_loged' group by mmsl order by mmsl") or die(mysqli_error($conn));
while($row1 = mysqli_fetch_array($sql3))
{
$mmsl_left = $row1['mmsl'];
$nm_left="";
$sql1 = mysqli_query($conn,"select * from main_mmenu where sl='$mmsl_left'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($sql1))
{
$nm_left = $row['nm'];
}
?>
<li class="treeview">
<a href="#">
<i class="fa fa-star"  ></i>
<span ><?=$nm_left;?></span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<?
$sql31 = mysqli_query($conn,"select * from main_mroll where uid='$user_currently_loged' and mmsl='$mmsl_left' order by sl") or die(mysqli_error($conn));
while($row1 = mysqli_fetch_array($sql31))
{
$ent = base64_encode($row1['ent']);
$vw = base64_encode($row1['vw']);
$et = base64_encode($row1['et']);
$msl_left = $row1['msl'];

$sql11 = mysqli_query($conn,"select * from main_menu where sl='$msl_left'") or die(mysqli_error($conn));
while($row1 = mysqli_fetch_array($sql11))
{
$sl_left = $row1['sl'];
$mnm_left = $row1['mnm'];
$fnm_left = $row1['fnm'];
$ntb_left = $row1['ntb'];
}


echo "<li > <a href=\"$fnm_left\" target=\"$ntb_left\"><i class=\"fa fa-star\"></i>$mnm_left</a></li>";

}
?>
</ul>
</li> 
<?
}
?>
							

	<?
		if ($user_current_level < 0 and $super_user=='1'){
	?>
			
	<li class="treeview">
                            <a href="#">
                                <i class="fa fa-star" id="cnm1"  ></i>
                                <span >System</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
	<?


	echo "<li > <a href=\"edit_days.php\" target=\"\"><i class=\"fa fa-user\"></i>Maximum Edit Days</a></li>";
	echo "<li > <a href=\"user.php\" target=\"\"><i class=\"fa fa-user\"></i>New User</a></li>";
	echo "<li > <a href=\"user_show.php\" target=\"\"><i class=\"fa fa-users\"></i>User List</a></li>";
	echo "<li > <a href=\"main_m_entry.php\" target=\"\"><i class=\"fa fa-users\"></i>Main Menu</a></li>";
    echo "<li > <a href=\"menu_entry.php\" target=\"\"><i class=\"fa fa-users\"></i>Menu Setup</a></li>";
    echo "<li > <a href=\"mroll.php\" target=\"\"><i class=\"fa fa-users\"></i>Roll Asign</a></li>";
	echo "<li><a href=\"menu_setup.php\" target=\"\"><i class=\"fa fa-circle\"></i>App Menu</a></li>";
echo "<li><a href=\"menu_assign.php\" target=\"\"><i class=\"fa fa-circle\"></i>App Roll Assign</a></li>";


	?>
		
							</ul>
    </li> 
		  
		<?php }/*?>	
   <li class="treeview">                
   <a href="#">             
   <i class="fa fa-edit"></i>      
   <span>View & Edit</span>         
   <i class="fa fa-angle-left pull-right"></i>    
   </a>                        
   <ul class="treeview-menu">	
   <?if ($user_current_level < 0 || $user_current_level > 1)
   {echo "<li><a href=\"unit_show.php\" >Unit List</a></li>";
echo "<li><a href=\"tech_show.php\" >Tech List</a></li>";
echo "<li><a href=\"prod_show.php\" >Product List</a></li>";}?></ul></li>
<li class="treeview">         
                   <a href="#">     
				   <i class="fa fa-file-text"></i>      
				   <span>Stock View</span>        
				   <i class="fa fa-angle-left pull-right"></i>     
				   </a>                         
				   <ul class="treeview-menu">	
				   <?if ($user_current_level < 0 || $user_current_level > 1)
				   {echo "<li><a href=\"stock_show.php\" >Stock</a></li>";  
			   echo "<li><a href=\"product_show.php\" >Product List</a></li>";  
			   echo "<li><a href=\"supsrc.php\" >Supplier List</a></li>";
			   //echo "<li><a href=\"assrc.php\" >Customer List</a></li>";	
			   echo "<li><a href=\"cifdtl.php\" >Customer Enquery</a></li>"; 
			   echo "<li><a href=\"purchase_show.php\" >Purchase</a></li>";  
			   echo "<li><a href=\"dpbill.php\" >Sale</a></li>";}?></ul>      
			   </li>  	<li class="treeview">                
			   <a href="#">                             
			   <i class="fa fa-wrench"></i>              
			   <span>Account</span>                        
			   <i class="fa fa-angle-left pull-right"></i>     
			   </a>                          
			   <ul class="treeview-menu">		
			   <?if ($user_current_level < 0 )
			   {echo "<li><a href=\"nmake.php\" >Account Group</a></li>";
		   echo "<li><a href=\"nledg.php\" >Ledger Head</a></li>";
		   echo "<li><a href=\"tbal_form.php\" >Trial Balance</a></li>";   }?>
		   </ul>       
		   </li>  		
		   <?*/?>           
		   </section>         
		   <!-- /.sidebar -->  
		   </aside>