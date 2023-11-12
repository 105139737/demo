<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$blno=$_REQUEST['blno'];
$cid=$_REQUEST['cid'];
$ship=$_REQUEST['ship'];

$data1= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$ship=$row1['ship'];
}

?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <?
            include "left_bar.php";
			
            ?>
    <style type="text/css">
    th {
        text-align: center;
        color: #FFF;
        border: 1px solid #37880a;
    }

    input:focus {

        background-color: Aqua;
    }

    a {
        cursor: pointer;
    }
    </style>

    </head>

    <body>
        <aside class="right-side">
            <section class="content-header">

                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">E-Upload</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-0">
                    </div>
                    <div class="col-md-12">
                        <div class="box box-myclass box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">E-Upload</h3>
                                <div class="box-tools pull-right">
                                </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="box-header ">
                                    <form name="form1" id="form1" method="post" action="euploads.php"
                                        enctype="multipart/form-data">
                                        <table border="0" width="800px"
                                            class="table table-hover table-striped table-bordered">

                                            <tr>
                                                <td align="right"><b>Bill No :</b></td>
                                                <td align="left">
                                                    <input type="text" class="form-control" readonly id="blno"
                                                        name="blno" value="<?=$blno;?>" size="50"
                                                        placeholder="Enter Bill No." required>

                                                </td>
                                                <td align="right"><b>File :</b></td>
                                                <td align="left">
                                                    <input type="file" class="form-control" id="fileToUpload"
                                                        name="fileToUpload" accept="application/json" size="50"
                                                        required>

                                                </td>
                                                <td colspan="2" align="left" style="padding-right: 8px;">
                                                    <input type="submit" class="btn btn-primary" id="Button1" name=""
                                                        value="Submit">

                                                </td>
                                            </tr>

                                        </table>


                                    </form>
                                </div>

                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
                <div class="col-md-3">
                </div>
                <div class="col-md-12">
                        <div class="box box-myclass box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Customer Shipping Address</h3>
                                <div class="box-tools pull-right">
                                </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="box-header ">
                                   
                                        <table border="0" width="800px"
                                            class="table table-hover table-striped table-bordered">

                                            <tr>
                                               
                                                <td align="left">
                                                <b>Address :</b><br>
                                                    <select id="ship" name="ship" tabindex="1" required class="form-control" onchange="update_ship(this.value)">
                                                    <option value="">---Select---</option>
                                                    <?
                                                    $query="select * from main_cust_shipping  WHERE cid='$cid'";
                                                    $result=mysqli_query($conn,$query);
                                                    while($rw=mysqli_fetch_array($result))
                                                    {
                                                    ?>
                                                    <option value="<?=$rw['sl'];?>" <?if($ship==$rw['sl']){echo"selected";}?>
                                                    ><?=$rw['addr'];?> (Mob : <?=$rw['mob'];?>)</option>
                                                    <?
                                                    }
                                                    ?>
                                                    </select>
                                                </td>                                                
                                            </tr>
    <tr>
                                               
                                                <td align="left">
                                               <div id="update_ship"></div>
                                                </td>                                                
                                            </tr>

                                        </table>


                                </div>

                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
            </section><!-- /.content -->
        </aside><!-- /.right-side -->
</div>
</body>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>


$('#ship').chosen({
no_results_text: "Oops, nothing found!",

});

function update_ship(val)
{
    blno=document.getElementById('blno').value;
$('#update_ship').load('update_ship.php?val='+val+'&blno='+blno).fadeIn("fast");

}
</script>
</html>