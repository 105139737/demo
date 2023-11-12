<?
$reqlevel =-1;
include("membersonly.inc.php");
include "header.php";
		date_default_timezone_set('Asia/Kolkata');
$dt1 = date('Y-m-d h:i:s a', time());
$dt = date('Y-m-d', time());

$color="#ffffff";			

$data= mysqli_query($conn,"select * from main_signup where username='$user_currently_loged'") or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{	
  $username=$row['username'];
  $name=$row['name'];
   $fname=$row['fname'];
    $addr=$row['addr'];
	 $mob=$row['mob'];

	   $mailadres=$row['mailadres'];
	    $sex=$row['sex'];
		
		$userlevel1=$row['userlevel'];
	
		if($name=='')
		{
		$name='NA';
		}
		if($fname=='')
		{
		$fname='NA';
		}
		if($addr=='')
		{
		$addr='NA';
		}
		if($mob=='')
		{
		$mob='NA';
		}
		if($mailadres=='')
		{
		$mailadres='NA';
		}
		if($sex=='')
		{
		$sex='NA';
		}
		

	$i=1;
if($color=='#ffffff')
{
$color='#f9f9f9';
}elseif($color=='#f9f9f9')
{
$color='#ffffff';
}


if($userlevel1=='2')
{
$userlevel='Sales Agen';
}
elseif($userlevel1=='10')
{
$userlevel='Customer Care';
}
elseif($userlevel1=='5')
{
$userlevel='Technical';
}
elseif($userlevel1=='-1')
{
$userlevel='Admin';
}

}





?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<style type="text/css"> 
td{
text-align:center;
color:#FFF;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
#boxpopup{

left:100%;
position:fixed;
}
</style> 
<script type="text/javascript" src="atosg_2.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<link rel="stylesheet" href="atosg_2.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript" src="popup_sedtunt.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$('#overlay').fadeOut('fast');

});


  function show()
 {
 var table_search= document.getElementById('table_search').value;

 $('#mem').load('member_show.php?table_search='+table_search).fadeIn('fast');

 }

function sbmunt(){

    var oldpass=document.getElementById('oldpass').value;
    var password=document.getElementById('password').value;
    var password2=document.getElementById('password2').value;
    
    $('#untlst').load('changepasss.php?oldpass='+oldpass+'&password='+password+'&password2='+password2).fadeIn('fast'); 
     closeOfferslDialog('boxpopup');
       document.getElementById('oldpass').value='';  
  document.getElementById('password').value='';
  document.getElementById('password2').value='';

}
</script>

 <script type="text/javascript" src="js2.js" ></script>
            <!-- Right side column. Contains tde navbar and content of tde page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                         Profile
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Profile </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                   

                   

                    
                          
 


                        
                            <!-- TO DO List -->
                            <div class="box box-primary">
						<div class="box-header">	
                    <h3 class="box-title">Profile Details</h3>

</div>
					
                                <div class="box box-success" >

					  <table border="0"width="80%" class="table table-hover table-striped table-bordered">
								
								
									
											 <tr>
											 <th><font color="#000000">User Name</font></th><td><font color="#000000"><?echo $username;?></font></td></tr>
											 <tr>
											  <th>Name</td><td><font color="#000000"><?echo $name;?></font></th></tr>
											  <tr>
										
										
											
											 <th>Mobile No.</th><td align="center"><font color="#000000"><?echo $mob;?></font></td></tr>
							<tr>
											<th>Email</th><td><font color="#000000"><?echo $mailadres;?></font></td></tr><tr>
										<th>Password</th><td><a  onclick="openOfferslDialog('boxpopup');">Change Password</a></font></td>
										
											 </tr>

  <input type="hidden" value="0" id="edtt">	









</table>
            </div>                    </div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                            <!-- /.box -->

							
<div id="wrapper">
<div id="overlay" class="overlay"></div>
<div id="boxpopup" class="box-span6">
	
	<div class="topb">
    <div class="top_leftb" id="news_ttl"><a onclick="closeOfferslDialog('boxpopup');" class="boxclose"></a>
      <h3>Change Password</h3></div>
  </div>
	   <hr />

	<div id="edtcnt">

<table border="0" width="30%" class="table table-hover table-striped table-bordered" align="center">
<tr>
<th align="right">
							    <font size="4">Old Password : </font>
							</th>
							<td align="left">
                            <input name="oldpass" class="form-control" type="password" id="oldpass" size="40"  placeholder="Old Password"/>
                           </td>
						 
						   </tr>
						   		 <tr>
						
						   	 <th align="right" >
							<font size="4">New Password : </font>
							</th>
							<td align="left">
                            <input name="password" class="form-control" type="password" id="password" size="40"  placeholder="New Password"/>
                           </td>
						   </tr>
						   <tr>
						   	 <th align="right">
							    <font size="4">Confirm New Password : </font>
							</th>
							<td align="left">
                            <input name="password2" class="form-control" type="password" id="password2" size="40"  placeholder="Confirm New Password"/>
                           </td>
						   </tr>
						   <tr>
						 <td align="right" colspan="2" style="padding-left:400px">
						   <input type="button" class="btn btn-primary" value="Change Password" onclick="sbmunt()">
						   </td>
						   </tr>
						   	<div id="untlst"></div>
						  
</table>						
</div>
	</div>
</div>

</center>   
								</form><!-- /.box-body -->
								</div>
							  


                                <div class="box-footer clearfix no-border">
                                
                                </div>
                            </div><
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        <!-- ./wrapper -->

        <!-- add new calendar event modal -->
		<style>
a{
cursor:pointer;
}
<style>

<script type="text/javascript">

            $(function() {
                
                //Datemask2 mm/dd/yyyy
                $("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
				//Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
            });
        </script>
     

    </body>
</html>