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
 { var all= document.getElementById('all').value; $('#sgh').load('tech_list.php?all='+encodeURIComponent(all)).fadeIn('fast'); }

function pagnt(pno){
        var ps=document.getElementById('ps').value;
        var src=document.getElementById('all').value;
    $('#sgh').load("tech_list.php?ps="+ps+"&pno="+pno+"&all="+encodeURIComponent(src)).fadeIn('fast');
	$('#pgn').val=pno;
    }
	function pagnt1(pno){
	pno=document.getElementById('pgn').value;
	pagnt(pno);
	}

function edit(sl)
{
document.location='tech_edit.php?sl='+sl;
}

</script>

	</head>
 <body onload="show()" >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Catagory View & Edit
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Catagory List</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">	<form method="post" action="brnchs.php" id="form1" onSubmit="return check1()" name="form1">  <center>
        <div class="box box-success" >
      <table border="0" width="860px" class="table table-hover table-striped table-bordered">	  <tbody>
<tr>
<td align="right" width="30%" style="padding-top:15px"> 
<font size="3">
<b>Search :</b>
</font>
</td>
<td align="left">
<input type="text" name="all" id="all" class="form-control" style="width:400px">

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