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
color:#FFF;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
select.sc {
	width: 430px;
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

 		






<script>
 function check()
 {
  if(document.getElementById('dt').value=='')
 {
 alert('Please Enter Date !');
 document.getElementById('dt').focus();
 return false
 
 }
 if(document.getElementById('nm').value=='')
 {
 alert('Please Enter Payee Name !');
 document.getElementById('nm').focus();
 return false
 
 }
  if(document.getElementById('crid').value=='')
 {
 alert('Please Select Credit Ledger !');
 document.getElementById('cr').focus();
 return false
 
 }
 

  if(document.getElementById('amm').value=='')
 {
 alert('Please Enter Amount !');
 document.getElementById('amm').focus();
 return false
 
 }
 
 }
 
 		function chk_dt(cdt)
{
    ddt=document.getElementById('dt').value;
    
    $.get('set_date_limit_chk.php?dt='+ddt, function(data) {
		if(data=='0')
		{
			
		document.getElementById('dt').value=cdt;	
		alert('You Have No Permission For Entry Date.');
		}
  
}); 


}
 
</script>



 </script>
 <script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
   $(document).ready(function()
{
$("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

});
   </script>
	</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Expence
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Expence</li>
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
                          
							
	<form name="form1" id="form1" method="post" action="expences.php" onsubmit="return check()">
                              
							
								



  <center>
        <div class="box box-success" >
   <table border="0" width="860px" class="table table-hover table-striped table-bordered">
		
		     

		  <tr>
		  	 <td  align="right">Date :</td>
            <td  align="left">
		<input type="text" id="dt" class="form-control"  name="dt" value="" onblur="show()" onchange="chk_dt('<?php echo date('d-M-Y')?>')" style="width:430px" placeholder ="Please Enter Date">

		     
            </td>
            <td  align="right">Payee Name :</td>
            <td  align="left">
		<input type="text" id="nm" class="form-control"  name="nm" value="" style="width:430px" placeholder= "Please Enter Payee Name">
            </td>
		    </tr>
		 <tr>
   
<td  align="right"> Payee Address :</td>
            <td  align="left">
<input type="text" id="addr" class="form-control"  name="addr" value="" style="width:430px" placeholder ="Please Enter Payee Address">
   </td>
			     <td  align="right">Narration :</td>
            <td  align="left">
<input type="text" id="nrtn" class="form-control"  name="nrtn" value="" style="width:430px" placeholder ="Please Enter Narration">

            </td>
          </tr>
		
		   <tr>
   
<td  align="right"> Credit Ledger :</td>
            <td  align="left">
<input type="text" name="cr" class="form-control" id="cr" style="width:430px" placeholder= "Please Enter Credit Ledger">

            </td>
			     <td  align="right">Pay Mode :</td>
            <td  align="left">
		<select name="pmode"  id="pmode" class="sc" >
		<?php 
		$bank=mysqli_query($conn,"select * from  main_ledg where gcd='1' or gcd='16'");
		while($row=mysqli_fetch_array($bank))
		{
		

		?>
    <option value="<?php  echo $row['sl'];?>"><?php  echo $row['nm'];?></option>
<?php }?>
</select>

            </td>
          </tr>

		  
		 <tr>
   
<td  align="right"> Amount :</td>
            <td  align="left">
<input type="text" id="amm" class="form-control"  name="amm" value="" style="width:430px" placeholder ="Please Enter Amount">
   </td>
			     <td  align="right">Bill No. :</td>
            <td  align="left">
<input type="text" id="bill" class="form-control"  name="bill" value="" style="width:430px" placeholder= "Please Enter Bill No">
            </td>
          </tr>
	
	

		  		  	   <tr>
      
               <td colspan="4" align="right"  style="padding-right: 12px;">
<input type="submit" class="btn btn-primary" id="Button1" name="" value="Submit" >
<input type="reset" class="btn btn-primary" id="Button2" name="" value="Reset" >

            </td>
          </tr>
		  </tbody>
		  </table>
<input type="hidden" id="crid" name="crid"  >
<input type="hidden" id="drid" name="drid"  >
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