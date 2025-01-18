<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title  id="title"></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
       
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
       
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
       
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
       
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
       
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
   
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
       
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
       
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
		
        <link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
       
        <link href="css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        
        <link href="css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
     
        <link href="css/style.css" rel="stylesheet" type="text/css" />
     

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.2/jquery.min.js" integrity="sha512-poSrvjfoBHxVw5Q2awEsya5daC0p00C8SKN74aVJrs7XLeZAi+3+13ahRhHm8zdAFbI2+/SUIrKYLvGBJf9H3A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>

      
        <script src="js/bootstrap.min.js" type="text/javascript"></script>


        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>

     

        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>

        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>

     

  

       

        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>

   

        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>


        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

	

        <script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>

        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>

        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

 

        <script src="js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>

  

        <script src="js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>

      

        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

         <link href="advancedtable.css" rel="stylesheet" type="text/css" />

<link href="style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="shortcut.js"></script>

    </head>

    <body class="skin-black" >

        <!-- header logo: style can be found in header.less -->

        <header class="header">

            <a href="index.php" class="logo">

                

            </a>

            <!-- Header Navbar: style can be found in header.less -->

            <nav class="navbar navbar-static-top" role="navigation">
<center><font size="5" color="red"><b><span class="blink" id="top_bnm"></span></b></font></center>
                <!-- Sidebar toggle button-->

                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </a>

				

				

	



 

<style>

.blink {

      animation: blink .30s steps(3, start) infinite;

      -webkit-animation: blink 1.00s steps(3, start) infinite;

    }

    @keyframes blink {

      to {

        color:#f8cc0e;

      }

    }

    @-webkit-keyframes blink {

      to {

         color:#000;

      }

    }

	.blink:hover {

    

    color: red;

	font-size:16px;

    -webkit-animation:none;

    -moz-animation: none;

    animation: none;

}
input[type=submit]
{

}

input[type=submit]:focus
{
 border: 1px solid red;
}

input[type=button]
{

}

input[type=button]:focus
{
  border: 1px solid red;
}

input[type=reset]
{

}

input[type=reset]:focus
{
 border:1px solid red;
}
</style>



 



                <div class="navbar-right" id="data1">

                    <ul class="nav navbar-nav">

                        <!-- Messages: style can be found in dropdown.less-->

                    <li class="dropdown messages-menu">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  <i class="fa fa-envelope-o"></i>

                  <span class="label label-success"><div id="msgno"></div></span>

                </a>

                <ul class="dropdown-menu">

				 <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  <li class="header"><span class="blink"><div id="msgtno"></div></span></li></a>

                  <li>

                    <!-- inner menu: contains the actual data -->

                    <ul class="menu">

                      <li><!-- start message -->

                        <a href="#">

                         

                       

                            

                   <div id="msg">

				   

				   

							</div>

							

                          

                       

                         

						 

                        </a>

						

                      </li><!-- end message -->

               

                

                    </ul>

                  </li>

                  <li class="footer"><a href="#">See All Messages</a></li>

                </ul>

              </li>

						

                        <!-- Notifications: style can be found in dropdown.less -->

                         <!-- Notifications: style can be found in dropdown.less -->

                        <li class="dropdown notifications-menu">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                                <i class="fa fa-warning"></i>

                                <span class="label label-warning"><div id="ptno"></div></span>

                            </a>

                            <ul class="dropdown-menu">

                                <li class="header">

								

								<span class="blink"><div id="pno"> </div></span>

								

								</li>

                               <li>

                                    <!-- inner menu: contains the actual data -->

                                               <ul class="menu">

											   <div id="notfy">

                  

												</div>

                    </ul>

                                </li>

                                <li class="footer"><a >View all</a></li>

                            </ul>

                        </li>

                        <!-- Tasks: style can be found in dropdown.less -->

                      

                        <!-- User Account: style can be found in dropdown.less -->

                        <li class="dropdown user user-menu">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                                <i class="glyphicon glyphicon-user"></i>

                                <span><?php  echo $staff_name;?> <i class="caret"></i></span>

                            </a>

                            <ul class="dropdown-menu">

                                <!-- User image -->

                                <li class="user-header bg-light-blue">

                          

                                    <p>

                                        <?php  echo $staff_name;?> - <?php  echo $user_current_Rank;?>

                                    </p>

                                </li>

                                <!-- Menu Body -->

                                

                                <!-- Menu Footer-->

                                <li class="user-footer">

                                    <div class="pull-left">

                                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>

                                    </div>

                                    <div class="pull-right">

                                        <a href="logoff.php" class="btn btn-default btn-flat">Sign out</a>

                                    </div>

                                </li>

                            </ul>

                        </li>

                    </ul>

                </div>

            </nav>

        </header>

		</body>

<script>
$(document).ready(function()
{
    $("#myModal").on("hide.bs.modal", function () {
    $('#cnt').html('');
    });
});
function get_cust_by_cs(div,cs,id,fn,searchid,query='',efn='')
{
var cs=encodeURIComponent(cs);
var id=encodeURIComponent(id);
var fn=encodeURIComponent(fn);
var query=encodeURIComponent(query);
var efn=encodeURIComponent(efn);
if((!isNaN(cs) && cs.length>9) || (isNaN(cs) && cs.length>2)){
$("#"+div).load("get_cust_by_cs.php?cs="+cs+"&id="+id+"&fn="+fn+"&searchid="+searchid+"&query="+query+"&efn="+efn).fadeIn('fast');
}
}
</script>