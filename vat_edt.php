<?php 

$reqlevel = 1;

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

font-weight: 900;

color:#000;

border:1px solid #37880a;



}



input:focus{



background-color:Aqua;

}

a{

cursor:pointer;

}

</style> 



<script type="text/javascript" src="prdcedt.js"></script>

 	<script>

 function check(evt)
{
	evt =(evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if(charCode > 31 && (charCode < 48 || charCode > 57) && (charCode > 46 || charCode <46 ))
	{
		return false;
	}
	return true;	
}
	

$(document).ready(function()
{
$('#overlay').fadeOut('fast');
 });
 
 function sedt(sl,fn,fv,div,tblnm)
{
$("#"+div).load("gisedt2.php?sl="+sl+"&fn="+fn+"&fv="+encodeURI(fv)+"&div="+div+"&tblnm="+tblnm).fadeIn('fast');
}
function edt1(sl,fn,fv,div,tblnm)
{
$("#"+div).load("gisedts2.php?sl="+sl+"&fn="+fn+"&fv="+encodeURI(fv)+"&div="+div+"&tblnm="+tblnm).fadeIn('fast');
}
</script>
</head>

 <body >
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Vat
                        <small>Vat Edit</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Vat Edit</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                   

                   

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                       <section class="col-lg-2 connectedSortable"> 
					   </section>  
					   <section class="col-lg-8 connectedSortable"> 
                                 
                            
                            
                                                
                            <!-- Calendar -->
                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <div class="box-title" style="width:200px;">Vat % </div>
									
									<?php 
 $query3="Select * from ".$DBprefix."vat ";
$result3 = mysqli_query($conn,$query3);
  while ($R3 = mysqli_fetch_array ($result3))
{
$vat=$R3['vat'];
$x=$R3['sl'];
if($vat=="")
{$vat="0";}
?>

			<div id="vat<?php  echo $x;?>" class="box-title">
<a onclick="sedt('<?php  echo $x;?>','vat','<?php  echo $vat;?>','vat<?php  echo $x;?>','main_vat')"><b><?php  echo $vat;?></font></b></a>
</div> 

<?php }
?>	
									
									
									
                                    
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <!-- button with a dropdown -->
                                  
                                    </div><!-- /. tools -->                                    
                                </div><!-- /.box-header -->
 
 
 
 
 


	





								
                                <div class="box-footer clearfix no-border">
                                </div>

                      
							</div>
							</div>
							</div>
							
					
						<!-- /.box -->
                        <!-- right col -->
                   <!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
 </body>

</html>