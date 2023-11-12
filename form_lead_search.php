<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
?>
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
</style> 
 <script>
  function show(lid)
 {


 $('#showd').load('form1_lead_show.php?lid='+lid).fadeIn('fast');

 }
   function cstat(sl)
 {


 $('#call').load('form1_lead_calls.php?sl='+sl).fadeIn('fast');
 abc();
 }
function abc(fv)
{
if(fv==1 || fv==3 || fv==5){
$("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
$("#datemask1").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
$(".timepicker").timepicker({
                    showInputs: false
                });
				}
}

function checkDec(el){
 var ex = /^[0-9]+\.?[0-9]*$/;
 if(ex.test(el.value)==false){
   el.value = el.value.substring(0,el.value.length - 1);
  }
  }
  
  
  
  function check1()
{

if(document.update.calls.value=='5')
  {
 if(document.update.am.value=='')
  {

	     alert("Please Enter Amount  !!");
		
		document.update.am.focus();


	  return false;
	  }
	  	else
		{
		  document.forms["update"].submit();
		}
	  }
	  }

	 </script>	
 <script type="text/javascript" src="js2.js"></script>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
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
                            <div class="box box-primary">
                    <h4 class="box-title"><i class="fa fa-list-alt"></i> Result</h4>
					<HR> <form action="form1_lead_update.php" name="update" id="update" method="post" onSubmit="return check1()">
                                <div class="box-body">
								<input type="hidden" value="0" id="edtt">
								<div id="showd">
                                        
											 </div>
									
	 
                                </div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                            </div>
							
							
							
							
							
							 <div class="box box-primary">
                    <h4 class="box-title"><i class="fa fa-list-alt"></i> Customer List</h4>
					<HR> <form action="form1_lead_update.php" name="update" id="update" method="post" onSubmit="return check1()">
                                <div class="box-body">
								<table width="100%" class="table table-hover">
											 <tr style=" background-color:#2396d6;">
											 <th>
											 Sl No.
											 </th>
											 <th>
											Lid ID
											 </th>
											 
											 <th>
											 Client Name
											 </th>
											 <th>
											Mobile Number
											 </th>
											   <th>
											City
											 </th>
											 <th>
										Segment
											 </th>
											 	 <th>
										Lot Size
											 </th>
												<th>
												Mail ID
											 </th>
											 	<th>
												Investment
											 </th>
										
										
											 <th>
											Description
											 </th>
										
											 </tr>

<?		



$color="#ffffff";			


	$sl=0;	
$data= mysqli_query($conn,"select * from  main_lead where assto='$user_currently_loged' and stat='0'") or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{	
   $lid=$row['lid'];
  $dtm=$row['dtm'];
    $fnm=$row['fnm']." ".$row['lnm'];
  $lnm=$row['lnm'];
    $addr=$row['addr'];
  $city=$row['city'];
    $state=$row['state'];
  $zip=$row['zip'];
    $email=$row['email'];
  $hph=$row['hph'];
    $wph=$row['wph'];
	 $source=$row['source'];
    $bast_tm_call=$row['bast_tm_call'];
	$segment=$row['segment'];
	$lotsize=$row['lotsize'];
	$investment=$row['investment'];

	$description=$row['description'];
	$stat=$row['stat'];
	
	
	$sl++;
	
	$i=1;
	
	if($dtm==''){$dtm='NA';}
if($fnm==''){$fnm='NA';}
if($addr==''){$addr='NA';}
if($city==''){$city='NA';}
if($state==''){$state='NA';}
if($zip==''){$zip='NA';}
if($email==''){$email='NA';}
if($hph==''){$hph='NA';}
if($wph==''){$wph='NA';}
if($source==''){$source='NA';}
if($bast_tm_call==''){$bast_tm_call='NA';}
if($segment==''){$segment='NA';}
if($lotsize==''){$lotsize='NA';}
if($investment==''){$investment='NA';}
if($description==''){$description='NA';}
	
if($color=='#ffffff')
{
$color='#f9f9f9';
}elseif($color=='#f9f9f9')
{
$color='#ffffff';
}
?>
<tr style=" background-color:<?echo $color;?>;cursor:pointer" onclick="show('<?=$lid;?>')"  >
<input type="hidden" name="lid" id="lid" value="<?echo $lid;?>">

<td align="center">
<?=$sl;?>
</td>

<td align="center">
<?=$lid;?><input type="hidden" name="lid" id="lid" value="<?echo $lid;?>">
</td>

<td align="center">
<?=$fnm;?>
</td>
<td align="center">
<?=$hph;?>
 </td>
<td align="center">
<?=$city;?>
</td>
<td align="center">
<?=$segment;?>
</td>
<td align="center">
<?=$lotsize;?>
</td>
<td align="center">
<?=$email;?>
</td>
<td align="center">
<?=$investment;?>
</td>


<td align="center">
<?=$description;?>
 </td>
</tr>
<?}
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
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
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