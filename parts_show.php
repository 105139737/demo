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

	   $(document).ready(function()

{

	

	 $('#overlay').fadeOut('fast');

	    });

 function show()

 {

 

 var all= document.getElementById('all').value;
 var cat= document.getElementById('cat').value;
 var bnm= document.getElementById('bnm').value;



 $('#sgh').load('parts_list.php?all='+encodeURIComponent(all)+'&cat='+cat+'&bnm='+bnm).fadeIn('fast');



 }





function pagnt(pno){

    var ps=document.getElementById('ps').value;
    var all=document.getElementById('all').value;
	var cat= document.getElementById('cat').value;
	var bnm= document.getElementById('bnm').value;
    $('#sgh').load("parts_list.php?ps="+ps+"&pno="+pno+"&all="+encodeURIComponent(all)+'&cat='+cat+'&bnm='+bnm).fadeIn('fast');

	$('#pgn').val=pno;

    }

	function pagnt1(pno)
	{

	pno=document.getElementById('pgn').value;

	pagnt(pno);

}

function edit(sl)

{

document.location='parts_edit.php?sl='+sl;

}



</script>



	</head>

 <body onload="show()" >

            <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">

                <!-- Content Header (Page header) -->

                <section class="content-header">

                    <h1 align="center">

                 Parts View & Edit

                      

                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>

                        <li class="active">Parts List</li>

                    </ol>

                </section>



                <!-- Main content -->

                <section class="content">

	<form method="post" action="brnchs.php" id="form1" onSubmit="return check1()" name="form1">

  <center>

        <div class="box box-success" >

      <table border="0"  class="table table-hover table-striped table-bordered">



<tr>
            <td  align="right" style="padding-top:17px"><b>Category :</b></td>
            <td  align="left">
		<select name="cat" class="form-control" size="1" id="cat" tabindex="8" >
				<Option value="">---Select---</option>
<?php 

$data1 = mysqli_query($conn,"Select * from main_catg order by cnm");

		while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$cnm=$row1['cnm'];
	echo "<option value='".$sl."'>".$cnm."</option>";
	}
	
 

?>
</select>
 </td>
         
 <td  align="right" style="padding-top:17px"><b>Brand Name :</b></td>
 <td  align="left">
<select name="bnm" class="form-control" size="1" id="bnm" tabindex="8"  >
				<Option value="">---Select---</option>
<?php 

$data2 = mysqli_query($conn,"Select * from main_brand order by brand");

		while ($row1 = mysqli_fetch_array($data2))
	{
	$sl=$row1['sl'];
	$brand=$row1['brand'];
	echo "<option value='".$sl."'>".$brand."</option>";
	}
	
 

?>
</select>
            </td>     
<td align="right" style="padding-top:15px"> 

<font size="3">

<b>Search :</b>

</font>

</td>

<td align="left">

<input type="text" name="all" id="all" class="form-control" >



</td>

</tr>

<tr>

<td colspan="6" align="right">

<input type="button" value=" Show " class="btn btn-primary" onclick="show()">

</td>

</tr>





</tbody>

</table>

<div id="sgh">

</div>

	



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