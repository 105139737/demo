<?php
$reqlevel = 3;
$cc=$_COOKIE['browserid'];
include("membersonly.inc.php");
include "header.php";
?>

<!-- AdminLTE dashboard demo (This is only for demo purposes) new -->
<script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php
            include "left_bar.php";
            ?>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Stock
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">



            <body>

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12">
                        <div class="box box-success">
                            <input type="hidden" id="pageno" value="1">
                            <h3><b>List For Requested Report <input type="button" value="Check Now (Refresh)"
                                        class="btn btn-success btn-sm " onclick="getJobData()"></b></h3>
                            <div id="job_list">
                            </div>
                            <center>
                                <div id="loader" onclick="getJobload()">Load more</div>
                            </center>
                        </div>
                    </section>

                    <section class="col-lg-12">
                        <?php
if($user_currently_loged!='onsadmin')
{
$get1=mysqli_query($conn,"select * from main_cornjob where sl>0 order by sl desc limit 0,10") or die(mysqli_error($conn));
$total1=mysqli_num_rows($get1);
if($total1>0)
{
?>
                        <h3>LG Sync Report</h3>
                        <table class="table table-hover table-striped table-bordered">
                            <tr>
                                <th style="text-align:center;" width="5%">Sl.No</th>
                                <th style="text-align:center;">Type</th>
                                <th style="text-align:center;">From Date</th>
                                <th style="text-align:center;">To Date</th>
                                <th style="text-align:center;">Run Date & Time</th>
                                <th style="text-align:center;">Status</th>
                            </tr>
                            <?php
while($row1=mysqli_fetch_array($get1))
{
	$cnt2++;
	$fnm=$row1['fnm'];
	$fdt=$row1['fdt'];
	$tdt=$row1['tdt'];
	$dttm=$row1['dttm'];
	$response=$row1['response'];
	$type="";
	if($fnm=="lg_sale_xml"){$type="Sale";}else{$type="Stock";}
	$color="";
	if($response!="Success"){$color="red";}
?>
                            <tr style="color:<?php echo $color;?>">
                                <td style="text-align:center;"><?=$cnt2;?></td>
                                <td style="text-align:center;"><b><?=$type;?></b></td>
                                <td style="text-align:center;"><b><?=$fdt;?></b></td>
                                <td style="text-align:center;"><b><?=$tdt;?></b></td>
                                <td style="text-align:center;"><b><?=$dttm;?></b></td>
                                <td style="text-align:center;"><b><?=$response;?></b></td>
                            </tr>
                            <?php
}
?>
                        </table>
                        <?php
}
}

?>
                    </section>

                    <section class="col-lg-12">
                        <br>
                        <br>
                        <br>
                        <?php 
                        if(strtoupper($user_currently_loged)=='ADMIN'  OR strtoupper($user_currently_loged)=='HDADMIN')
                        {
                        ?>
                        <input type="button" value="Check Bill Status " class="btn btn-warning " onclick="check()">
                    <?php } ?>
                        <div id="check"></div>

                        <?php/*
if($user_currently_loged!='onsadmin')
{
$get=mysqli_query($conn,"select * from main_prod_prc_pdf where sl>0 $all1 order by sl desc") or die(mysqli_error($conn));
$total=mysqli_num_rows($get);
if($total>0)
{
?>
                        <table class="table table-hover table-striped table-bordered">
                            <tr>
                                <th style="text-align:center;" width="5%">Sl.No</th>
                                <th style="text-align:center;" width="20%">Title</th>
                                <th style="text-align:center;" width="75%">Attachments</th>

                            </tr>
                            <?php
while($row=mysqli_fetch_array($get))
{
	$cnt++;
	$ssl=$row['sl'];
	$title=$row['title'];
	//$path=$row['path'];
	 $path="product_price_pdf/".$ssl.".pdf";	
?>
                            <tr>
                                <td style="text-align:center;"><?=$cnt;?></td>
                                <td style="text-align:left;"><b><?=$title;?></b></td>
                                <td style="text-align:left;">
                                    <a href="<?=$path;?>">Click To Download</a>
                                </td>
                            </tr>
                            <?php
}
?>
                        </table>
                        <?php
}
}
*/?>

                        <div class="modal fade" id="compose-modal1" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body" id="cnt11">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!-- right col -->

                </div><!-- /.row (main row) -->
            </body>
        </section><!-- right col -->
       
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<link rel="stylesheet" href="chosen.css">

<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<!-- add new calendar event modal -->
<style>
#loader {
    width: 100px;
    color: #fff;
    display: block;
    text-align: center;
    margin: 10px auto;
    padding: 5px;
    border-radius: 10px;
    border: 1px solid transparent;
    background-color: blue;
    transition: .3s;
    cursor: pointer;
}
</style>



<script>
function checks(stat) {
    var cid = document.getElementById('cid').value;
    var blno = document.getElementById('blno').value;
    var fn = document.getElementById('fn').value;
    var tn = document.getElementById('tn').value;
    if (fn > -1 && tn > -1) {
        if (stat == 1) {
            var result = confirm("Are You Sure. this Process To be vary long?");
            if (result) {

                $('#check').load("get_blno_oth_update.php?cid=" + cid + "&blno=" + blno + "&stat=" + stat + "&fn=" +
                    fn + "&tn=" + tn).fadeIn('fast');

                $('#compose-modal1').modal('hide');
            }
        } else {

            $('#check').load("get_blno_oth_update.php?cid=" + cid + "&blno=" + blno + "&stat=" + stat + "&fn=" + fn +
                "&tn=" + tn).fadeIn('fast');

            $('#compose-modal1').modal('hide');
        }
    } else {
        alert('Please Enter Limit');
    }
}

function check() {

    $('#cnt11').load("get_customer.php").fadeIn('fast');
    $('#compose-modal1').modal('show');
}

//getJobData();

function getJobData() {
    $("#loader").show();
    var nextPage = 1;
    $.ajax({
        type: 'POST',
        url: 'job_list.php',
        data: {
            'pageno': nextPage,
        },
        success: function(data) {
            if (data != '') {
                $('#job_list').html(data);
                $('#pageno').val(nextPage);
                // $("#loader").hide();
            } else {
                $("#loader").hide();
            }
        }
    });

}



function getJobload() {
    var nextPage = parseInt($('#pageno').val()) + 1;

    $.ajax({
        type: 'POST',
        url: 'job_list.php',
        data: {
            'pageno': nextPage
        },
        success: function(data) {
            if (data != '') {
                console.log("test", data.length);
                if (data.length > 420) {
                    $('#job_list').append(data);
                    $('#pageno').val(nextPage);
                    $("#loader").show();
                } else {
                    $("#loader").hide();
                }
            } else {
               // $("#loader").hide();
            }
            // if (data != '') {
            //     console.log("test", data.length);              
            //         $('#job_list').append(data);
            //         $('#pageno').val(nextPage);
            //         $("#loader").show();                
            // } else {
            //     $("#loader").hide();
            // }

        }
    });
}
</script>

</html>