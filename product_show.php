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
<link rel="stylesheet" type="text/css" href="style_sedt1.css" />
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
 var brncd= document.getElementById('brncd').value;
 $('#sgh').load('product_list.php?all='+encodeURIComponent(all)+'&brncd='+brncd+'&cat='+cat+'&bnm='+bnm).fadeIn('fast');

 }


function pagnt(pno){
	 var brncd= document.getElementById('brncd').value;
        var ps=document.getElementById('ps').value;
        var src=document.getElementById('all').value;
		 var cat= document.getElementById('cat').value;
 var bnm= document.getElementById('bnm').value;
    $('#sgh').load("product_list.php?ps="+ps+"&pno="+pno+"&all="+encodeURIComponent(src)+'&brncd='+brncd+'&cat='+cat+'&bnm='+bnm).fadeIn('fast');
	$('#pgn').val=pno;
    }
	function pagnt1(pno){
	pno=document.getElementById('pgn').value;
	pagnt(pno);
	}

	
	

</script>

	</head>
 <body onload="show()" >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Product Details
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Product Details</li>
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
	<form method="post" action="brnchs.php" id="form1" onSubmit="return check1()" name="form1">
                              
							
								


<input type="hidden">
  <center>
        <div class="box box-success" >
     <table border="0"  class="table table-hover table-striped table-bordered">



<tr>
            <td  align="right" style="padding-top:17px"><b>Category :</b></td>
            <td  align="left">
		<select name="cat" class="form-control" size="1" id="cat" tabindex="8" >
				<Option value="">---Select---</option>
<?

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
<?

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
<td align="right" style="padding-top:10px">
<b>Branch : </b>
</td>
<td align="left" >

    <select name="brncd" class="form-control" size="1" id="brncd"   >
<?
if($user_current_level<0)
{
	?>
	<option value="">---ALL---</option>
	<?
}
if($user_current_level<0)
{
$query="Select * from main_branch";
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
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
<td colspan="8" align="right" style="padding-right:105px">
<input type="button" value=" Show " class="btn btn-info" onclick="show()">
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
<div id="wrapperl">
<div id="overlay" class="overlay"></div>
<div id="boxpopupl" class="boxl">
	
	<div class="topb">
     <div id="bnm" class="bnm"><h3><font color="#FFF"><b>Product Details</b></font></h3></div>
 <div class="top_leftb" id="news_ttl"><a onclick="closeOfferslDialog('boxpopupl');" class="boxclosel"><img src="del1.png" height="30" width="30"></a>
      </div>
     
  </div>
	   <hr />
	
	<div id="contentl">


	</div>
</div>
</div> 
     

    </body>
</html>