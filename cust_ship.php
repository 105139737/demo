<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$cid=$_REQUEST['cid'];
?>
<html>
<head>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <?
            include "left_bar.php";
            ?>
        <style type="text/css">
        th {
            text-align: center;
            font-weight: 900;
            color: #000;
            border: 1px solid #37880a;
        }

        input:focus {
            background-color: Aqua;
        }

        a {
            cursor: pointer;
        }
        </style>
        <script type="text/javascript" src="prdcedt.js"></script>
        <script>
        $(document).ready(function() {
            $('#overlay').fadeOut('fast');
        });

        function show() {
            var cid = document.getElementById('cid').value;
            $('#sgh').load("cust_ship_list.php?cid=" + cid).fadeIn('fast');
        }
        function edit(sl,addr,mob) {
			document.getElementById('sl').value=sl;
			document.getElementById('addr').value=addr;
			document.getElementById('mob').value=mob;
        }
        </script>
</head>

<body onload="show()">
    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 align="center">
                Customer Shipping Address
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Customer Shipping Address</li>
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

            <HR>
            <form method="post" action="cust_ships.php" id="form1" name="form1">
			<input type="hidden" class="form-control" id="sl" name="sl" value="">
                <center>
                    <div class="box box-success">
                        <table border="0" width="860px" class="table table-hover table-striped table-bordered">
                            <tr>
                                <td align="right" width="15%" style="padding-top:15px">
                                    <font size="3"><b>Customer :</b></font>
                                </td>
                                <td align="left" width="" colspan="3">
                                    <select id="cid" name="cid" tabindex="1" required class="form-control">
<?
		$query="select * from main_cust  WHERE sl='$cid' order by nm";
		$result=mysqli_query($conn,$query);
		while($rw=mysqli_fetch_array($result))
		{
			?>
			<option value="<?=$rw['sl'];?>" <?if($sid==$rw['sl']){echo"selected";}?>
			><?=$rw['nm'];?> </option>
			<?
		}
?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" style="padding-top:15px">
                                    <font size="3"><b>Address :</b></font>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="addr" name="addr" value=""
                                        placeholder="Address">
                                </td>

                                <td align="right" style="padding-top:15px">
                                    <font size="3"><b>Mobile :</b></font>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="mob" name="mob" value=""
                                        placeholder="Mobile">
                                </td>
                            </tr>
                            <tr>
                                <td align="right" colspan="4">
                                    <input type="submit" value=" Submit " class="btn btn-success">
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>


            </form><!-- /.box-body -->



            <div class="box box-success">
            </div>
            <div id="sgh"></div>


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
<script>
</script>