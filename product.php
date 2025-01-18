<?php 
$reqlevel = 3;
include("membersonly.inc.php");
?>
  <script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="jquery.autocomplete.js"></script>
<script type="text/javascript" language="javascript">

   $(document).ready(function()
{
	 var jQueryDatePicker2Opts =
   {
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
      $("#expdt1").datepicker(jQueryDatePicker2Opts);
$("#expdt1").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});


	 $("#cat1").autocomplete("autocomplete.php", {
		selectFirst: true
	});

});
function cat(cnm)
{

	$("#cn").load('gcat.php?cnm='+encodeURIComponent(cnm)).fadeIn('fast');
}

</script>
 <table  class="table table-hover table-striped table-bordered"  >
		
		     <tr>
            <td  align="right" >Category :</td>
            <td  align="left">
			<input type="text"  id="cat1" class="form-control" name="cat1" value=""  placeholder="Enter Category">

            </td>
       
            <td  align="right" >Product Name :</td>
            <td  align="left">
		<input type="text" class="form-control" id="pnm1"  name="pnm1" value=""  placeholder="Enter Product Name">

            </td>
          </tr>
		   <tr>
            <td  align="right" >Tech Name :</td>
            <td  align="left">
			<div id="cn">
			
			<select name="tech1" size="1" class="form-control" id="tech1" tabindex="10" >
<option value="">---Select---</option>

</select>

		</div>
            </td>
         
            <td  align="right" >Co. Name :</td>
            <td  align="left">
		<input type="text" class="form-control" id="co1"  name="co1" value=""  placeholder="Enter Company Name">

            </td>
          </tr>
		   <tr>
            <td  align="right" >Open Stock :</td>
            <td  align="left">
<input type="text" class="form-control" id="ops1" name="ops1" value=""  placeholder="Enter Open Stock">


            </td>
         
            <td  align="right" >Packaging Unit :</td>
            <td  align="left" >
<select name="uni" class="form-control" size="1" id="uni"   >
<?php 
$query="Select * from ".$DBprefix."unit order by sl";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$cid=$R['sl'];
$b=$R['unitnm'];
?>
<option value="<?php  echo $cid;?>"><?php  echo $b;?></option>
<?php 
echo $cid;
}
?>
</select>

            </td>
        </tr> 
		<tr>
            <td  align="right" >Re-Order :</td>
            <td  align="left">
<input type="text" class="form-control" id="reo1"  name="reo1" value=""  placeholder="Enter Re-Order">

            </td>
        
            <td  align="right" >Sale Rate :</td>
            <td  align="left">
<input type="text" class="form-control" id="ret1"  name="ret1" value=""  placeholder="Enter Sale Rate">

            </td>
          </tr>
		  		<tr>

        
            <td  align="right" >Batch No. :</td>
            <td  align="left">
<input type="text" class="form-control" id="betno1"  name="betno1" value=""  placeholder="Enter Batch No.">

            </td>
			            <td  align="right" >Expiry Date :</td>
            <td  align="left">
<input type="text" class="form-control" id="expdt1"  name="expdt1" value=""  placeholder="Enter Expiry Date">

            </td>
          </tr>
		  <tr>

        
      
               <td colspan="4" align="right"  >
<input type="button" class="btn btn-primary" onclick="np()" id="Button1" name="" value="Submit" >
<input type="reset" onclick="closeOfferslDialog('boxpopupl');" class="btn btn-primary" id="Button2" name="" value="Reset" >

            </td>
          </tr>
		
		  </table>

