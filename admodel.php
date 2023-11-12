<?
$reqlevel = 3;
include("membersonly.inc.php");
$cat1=$_REQUEST['cat1'];
$scat1=$_REQUEST['scat1'];
?>
<input type="hidden" name="sscat" id="sscat" value="<?php echo $scat1;?>">

<div class="box box-success">
<table border="0"  class="table table-hover table-striped table-bordered" >
<tr>
	<td  align="right" style="padding-top:17px" width="20%"><font color="red">*</font><b>Brand :</b></td>
	<td  align="left" width="30%">
	<select name="cat" class="form-control" size="1" id="cat" tabindex="8" onchange="get_scat(this.value)" required >
	<Option value="">---Select---</option>
	<?
	$data1 = mysqli_query($conn,"Select * from main_catg order by cnm");
	while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$cnm=$row1['cnm'];
	?>
	<option value="<?php echo $sl;?>" <?php if($cat1==$sl){?> selected <? } ?>><?php echo $cnm;?></option>
	<?
	}
	?>
	</select>
	</td>
</tr>
<tr>       
	<td  align="right" style="padding-top:17px" width="20%"><b>Category :</b></td>
	<td  align="left" width="30%">
	<div id="catdiv">
	<select name="scat" class="form-control" size="1" id="scat" tabindex="8" onchange="get_igst()">
	<Option value="">---Select---</option>
	<?
	$data12=mysqli_query($conn,"Select * from main_scat order by nm");
	while($row12=mysqli_fetch_array($data12))
	{
		$sc_sl=$row12['sl'];
		$sc_nm=$row12['nm'];
		?>
		<option value="<?php echo $sc_sl;?>" <?php if($scat1 ==$sc_sl){?> selected <? } ?>><?php echo $sc_nm;?></option>
		<?
	}
	?>
	</select>
	</div>
	</td>
</tr>

<tr>
	<td  align="right" style="padding-top:17px"><font color="red">*</font><b>Model Name :</b></td>
	<td  align="left" colspan="">
	<input type="text" class="form-control" id="pnm"  name="pnm" value=""  placeholder="Model Name... "  required>
	</td>
	<td  align="right" style="padding-top:17px" hidden><b> Sale Rate</b> :</td>
	<td  align="left" hidden>
	<input type="text" class="form-control" name="ret" id="ret" style="width:100%" onkeypress="return isNumber(event)" placeholder="0.00">
	</td>
</tr>
<tr>	
	<td align="right" style="padding-top:15px;"><b>HSN:</b></td>
	<td align="left">
	<div id="hsndiv">
	<input type="text" name="hsn" id="hsn" class="form-control" placeholder="Enter HSN">
	</div>
	</td>

</tr>

<tr style="display:none;">
    <td align="right" width="20%" style="padding-top:15px;" ><b>Small Unit :</b></td>
	<td  align="left" width="30%">
	<input type="text" class="form-control" name="sun" id="sun" value="PCS"    style="width:100%"  size="40" placeholder="Enter Small Unit....">
	</td>
	<td align="right" width="20%" style="padding-top:15px;" ><b>Small Value :</b></td>
	<td  align="left" width="30%">
	<input type="text" class="form-control" name="smvlu" id="smvlu" value="1" size="40" readonly placeholder="Enter Small Value....">
	</td>
</tr>
<tr style="display:none;"> 
	<td align="right" width="20%" style="padding-top:15px;" ><b>Midle Unit :</b></td>
	<td  align="left" width="30%">

	<input type="text" class="form-control" name="mun" id="mun"    size="40" placeholder="Enter Midle Unit...." >
	</td>
	<td align="right" width="20%" style="padding-top:15px;" ><b>Midle Value :</b></td>
	<td  align="left" width="30%">
	<input type="text" class="form-control" name="mdvlu" id="mdvlu"  size="40" placeholder="Enter Midle Value...." >
	</td>
</tr>
<tr style="display:none;">
	<td align="right" width="20%" style="padding-top:15px;" ><b>Big Unit :</b></td>
	<td  align="left" width="30%">
	<input type="text" class="form-control" name="bun"   id="bun"  size="40" placeholder="Enter Big Unit...." >
	</td>

	<td align="right" width="20%" style="padding-top:15px;" ><b>Big Value :</b></td>
	<td  align="left" width="30%">
	<input type="text" class="form-control" name="bgvlu" id="bgvlu"  size="40" placeholder="Enter Big Value...." >
	</td>
</tr>		
<tr style="display:none;">
	<td  align="right" style="padding-top:17px">	<span id="su"></span><b> Per Sale Rate</b> :</td>
	<td  align="left">
	<input type="text" class="form-control" name="sret" id="sret" style="width:100%"  size="40">
	</td>

	<td  align="right" style="padding-top:17px">	<span id="mu"></span><b> Per Sale Rate</b> :</td>
	<td  align="left">
	<input type="text" class="form-control" name="mret" id="mret" style="width:100%"  size="40" >
	</td>
	<td  align="right" style="padding-top:17px">	<span id="bu"></span><b> Per Sale Rate</b> :</td>
	<td  align="left">
	<input type="text" class="form-control" name="bret" id="bret" style="width:100%"  size="40" >
	</td>
</tr>

<tr>
	<td  align="right" style="padding-top:15px"><font color="red">*</font><b>I-GST :</b></td>
	<td  align="left">
	<div id="igdiv">
	<input type="text" class="form-control" id="igst" name="igst" value="" placeholder="Enter IGST" required>
	</div>
	</td>
</tr>
<tr>
	<td colspan="2" align="right"  style="padding-right: 8px;">
	<input type="button" class="btn btn-success" id="Button1" name="" value="Submit" onclick="addmodel()">
	<input type="reset" class="btn btn-warning" id="Button2" name="" value="Reset" >
	</td>
</tr>
<tr style="display:none;">
	<td  align="right" style="padding-top:15px"><font color="red">*</font><b>C-GST :</b></td>
	<td  align="left">
	<input type="text" class="form-control" id="cgst" name="cgst" value="" placeholder="Enter CGST">
	</td>
	<td  align="right" style="padding-top:15px"><font color="red">*</font><b>S-GST :</b></td>
	<td  align="left">
	<input type="text" class="form-control" id="sgst"  name="sgst" value="" placeholder="Enter SGST">
	</td>

</tr>

<tr style="display:none;">
<td  align="right" style="padding-top:15px"><font color="red">*</font><b>From Date :</b></td>
<td  align="left">
<input type="text" class="form-control" id="fdt" name="fdt" value="" readonly >
</td>
<td  align="right" style="padding-top:15px"><font color="red">*</font><b>To Date :</b></td>
<td  align="left">
<input type="text" class="form-control" id="tdt"  name="tdt" value="" readonly>
</td>
	
</tr>

</table>

</div> 
<script type="text/javascript" language="javascript">
get_scat('<?php echo $cat1;?>')
function get_scat(brnd)  
{
var sscat=document.getElementById('sscat').value;
$("#catdiv").load("get_sub_cat.php?cat="+brnd+"&sscat="+sscat).fadeIn('fast');
}
function get_igst()  
{
var scat=document.getElementById('scat').value;
$("#igdiv").load("get_igst.php?scat="+scat).fadeIn('fast');
$("#hsndiv").load("get_hsn.php?scat="+scat).fadeIn('fast');

}

</script>