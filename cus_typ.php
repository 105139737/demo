<?php 
$reqlevel = 3;
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
   <script>
   function check()
   {
		if(document.form1.cat.value=='')
			{

	     alert("Please Enter Category ?");

		document.form1.cat.focus();
	return false;
			}
				else  
			{


		document.forms["form1"].submit();


				
			}  
   }
		   </script>	
 
	</head>
 <body>
  <aside class="right-side">
		    <section class="content-header">
                   
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Customer Entry</li>
                    </ol>
                </section> 
				   <section class="content">
		
	<form method="post" action="cus_typs.php" id="form1" onSubmit="return check1()" name="form1">

<div class="row">
<div class="col-md-0" >
</div>
	 <div class="col-md-12" >
              <div class="box box-myclass box-solid" >
                <div class="box-header with-border" >
                  <h3 class="box-title"> Customer Entry</h3>
                  <div class="box-tools pull-right">
              </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" >
				<div class="box-header ">
 
 
  
<form name="form1" id="form1" method="post" action="cus_typs.php" onsubmit="return check()">
 <table border="0"  width="800px" class="table table-hover table-striped table-bordered" >
		
		     <tr>
            <td  align="right" ><b>Customer Type :</b></td>
            <td  align="left">
			<input type="text" class="form-control" id="tp"  name="tp" value="" size="50" placeholder="Enter Customer Type">

            </td>
               <td colspan="2" align="left"  style="padding-right: 8px;">
<input type="submit" class="btn btn-primary" id="Button1" name="" value="Submit" >

            </td>
          </tr>
		
		  </table>


</form>


 <table border="0"  width="800px" class="table table-hover table-striped table-bordered" >
 		     <tr>
            <td  align="center" width="10%"><b>Sl. No.</b></td>
            <td  align="center" width="80%"><b>Customer Type</b></td>
        <?php if($user_current_level<0)
           {?>
		   <td  align="center" width="10%"><b>Edit</b></td>
		  <?php }?> 
</tr>
<?php 
	$c="";
	$q=mysqli_query($conn,"select * from main_cus_typ")or die(mysqli_error($conn));
	$cnt=mysqli_num_rows($q);
	if($cnt==0)
	{
	echo " <tr><td  style='color:red;text-align:center;font-size:150%;' colspan='3'><b>Data Not Exist</b></td>"	;
	}
	else
	{
	while($r=mysqli_fetch_array($q))
	{
		$c++;
		$sl=$r['sl'];
		$tp=$r['tp'];
	?>
 		     <tr>
            <td  align="center" width="10%"><?php  echo $c;;?></td>
            <td  align="center" width="80%"><?php  echo $tp;?></td>
            <?php if($user_current_level<0)
           {?>
			<td  align="center" width="10%">
			<a href="cus_typ_edt.php?sl=<?php  echo $sl;?>" >
			<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
			</td>
		 <?php }?> 
			</tr>
	
	<?php 	
	}		
	}
?>
</table>
   </div>
   
		</div>
 </div><!-- /.box-body -->
              </div><!-- /.box -->
</form>
            </div><!-- /.col -->
			<div class="col-md-3" >
</div>

 </section><!-- /.content -->
 </aside><!-- /.right-side -->
</div>
    </body>
</html>




