<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
?>
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

								

	
	
  
  
  
<script type="text/javascript" src="js2.js"></script>
<script type="text/javascript">
	     function stk(sl)
 {

var prid=document.form1.prid.value;

  $('#det').load('pdet1.php?sl='+sl+'&prid='+prid).fadeIn('fast');
 }

		     function show()
 {

 var prid=document.form1.prid.value;
 $('#from1').load('bfrom.php?prid='+prid).fadeIn('fast');
  $('#det').load('pdet.php?prid='+prid).fadeIn('fast');
    $('#un').load('punit.php?prid='+prid).fadeIn('fast');
 }
 
 
  var options_xmlp = {
		script: "sprcp1.php?",
		varname:"inputp"
	};
	var as_xmlp = new AutoSuggest('prnm', options_xmlp,"prid","stk","fls");
</script>
		

 </script>

	
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                    New Branch
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">New Branch</li>
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
                          
							
							
							
							
							
							
					<HR> 	<form name="form1" id="form1" method="post" action="stk_trns.php">
                              
							
								



  <center>
        <div class="box box-success" >
       <table border="1"  width="550px"  class="advancedtable" >
		  <thead>
          <tr style="height: 30px;" >
          <th colspan="4" align="center">
         Stock Transfer
          </th>
		  </tr>
          </thead>
		   <tbody >
		     

		  <tr class="odd">
            <td  align="right">Product Name :</td>
            <td  align="left" colspan="2">
		<input type="text" id="prnm"  name="prnm" value="" onblur="show()" size="31px">

		     
            </td>
			<td  align="left">
       <div id="det">


         </div>
			</td>
          </tr>
		 <tr class="odd">
   
<td  align="right"> From :</td>
            <td  align="left">
			<div id="from1">
<select name="from"  id="from" style="width:187px;height:22px;z-index:8;">
<option value="">---Select---</option>

</select>
</div>
            </td>
			     <td  align="right">To :</td>
            <td  align="left">
	<select name="to"  id="to" style="width:187px;height:22px;z-index:8;">
<?php 
$query="Select * from main_branch";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];
?>
<option value="<?php  echo $sl;?>"><?php  echo $bnm;?></option>
<?php 
}
?>
</select>

            </td>
          </tr>
		
		   <tr class="odd">
   
<td  align="right"> Unit :</td>
            <td  align="left">
			<div id="un">
<select name="unt"  id="unt" style="width:187px;height:22px;z-index:8;">
<option value="">---Select---</option>
</select>
</div>
            </td>
			     <td  align="right">Quantity :</td>
            <td  align="left">
		<input type="text" id="qunt"  name="qunt" value="" size="22">

            </td>
          </tr>

	
	

		  		  	   <tr style="background-color:#549bc5;">
      
            <td  align="right" colspan="4">
<input type="submit" id="Button1" name="" value="Submit" >
<input type="reset" id="Button2" name="" value="Reset" >

            </td>
          </tr>
		  </tbody>
		  </table>
	 <input type="hidden" id="prid" name="prid"  >
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