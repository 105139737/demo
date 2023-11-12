<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
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
 function show()
 {
 
 var all= document.getElementById('all').value;

 $('#sgh').load('beth_list.php?all='+encodeURIComponent(all)).fadeIn('fast');

 }


function pagnt(pno){
        var ps=document.getElementById('ps').value;
        var src=document.getElementById('all').value;
    $('#sgh').load("beth_list.php?ps="+ps+"&pno="+pno+"&all="+encodeURIComponent(src)).fadeIn('fast');
	$('#pgn').val=pno;
    }
	function pagnt1(pno){
	pno=document.getElementById('pgn').value;
	pagnt(pno);
	}

	
	




function edit(sl)
{
document.location='beth_edit.php?sl='+sl;
}

</script>

	</head>
 <body onload="show()" >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Batch No./Expiry Date View & Edit
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Batch No./Expiry Date List</li>
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
                          
							
							
							
							
							
							
					<HR> 	<form method="post" action="brnchs.php" id="form1" onSubmit="return check1()" name="form1">
                              
							
								


<input type="hidden">
  <center>
        <div class="box box-success" >
      <table border="0" width="860px" class="table table-hover table-striped table-bordered">

<tr>
<td align="right" width="30%" style="padding-top:15px"> 
<font size="3">
<b>Product Name :</b>
</font>
</td>
<td align="left">
<select id="all" name="all" class="sc1"  tabindex="2"  style="width:300px" onchange="gett(this.value)" >
		<option value="">---Select---</option>
		<?
			$query6="select * from  ".$DBprefix."product order by pname";
			$result5 = mysqli_query($conn,$query6);
			while($row=mysqli_fetch_array($result5))
			{
				
				?>
			<option value="<?=$row['sl'];?>"><?=$row['pname'];?></option>
			<?}?>
			</select>
</td>
</tr>
<tr>
<td colspan="2" align="right" style="padding-right:535px">
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
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>
     
<script>

	
		  $('#all').chosen({
  no_results_text: "Oops, nothing found!",

  });
  
</script>
    </body>
</html>