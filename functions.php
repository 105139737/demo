<?php 
function edit_log_ntry($tblnm,$tblsl,$ufnm,$fldnm,$old_val,$new_val,$edt,$edttm,$eby)
{
	$LOG=mysqli_query($conn,"INSERT INTO main_edt_log(tblnm, tblsl, ufnm, fldnm, oldvl, nvl, rdt, rdtm, rby, edt, edtm, eby) VALUES('$tblnm', '$tblsl', '$ufnm', '$fldnm', '$old_val', '$new_val', '$edt', '$edttm', '$eby', '$edt', '$edttm', '$eby')")or die (mysqli_error($conn));
}

?>