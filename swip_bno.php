<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$bno1=$_REQUEST['b1'];
$bno2=$_REQUEST['b2'];
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
 
	</head>
 <body>
  <aside class="right-side">
		    <section class="content-header">
                   
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Swap Bill</li>
                    </ol>
                </section> 
				   <section class="content">
		<div class="row">
<div class="col-md-0" >
</div>
	 <div class="col-md-12" >
              <div class="box box-myclass box-solid" >
                <div class="box-header with-border" >
                  <h3 class="box-title">Swap Bill</h3>
                  <div class="box-tools pull-right">
              </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" >
				<div class="box-header ">
<form name="form1" id="form1" method="post" action="swips_bno.php">
 <table border="0"  width="800px" class="table table-hover table-striped table-bordered" >
		
		     <tr>
            <td  align="right" ><b>From Bill No :</b></td>
            <td  align="left">
			<input type="text" class="form-control" id="bno1" name="bno1" value="<?=$bno1;?>" size="50" placeholder="Enter Bill No." required>

            </td>
			<td  align="right" ><b>To Bill No :</b></td>
            <td  align="left">
			<input type="text" class="form-control" id="bno2" name="bno2" value="<?=$bno2;?>" size="50" placeholder="Enter Bill No." required>

            </td>
               <td colspan="2" align="left"  style="padding-right: 8px;">
<input type="submit" class="btn btn-primary" id="Button1" name="" value="Submit" >

            </td>
          </tr>
		
		  </table>


</form>
   </div>
   
		</div>
 </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
			<div class="col-md-3" >
</div>

 </section><!-- /.content -->
 </aside><!-- /.right-side -->
</div>
    </body>
</html>