<aside class="left-side sidebar-offcanvas" >
	<section class="sidebar">
        <div class="user-panel">
        	<div class="pull-left image"></div>
            <div class="pull-left info">
                <p>Hello, <?php  echo $user_nm;?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
		<ul class="sidebar-menu">
            <li>
                <a href="index.php">
                    <i class="fa fa-home"></i> <span>Home</span>
                </a>
            </li>
			<li class="treeview"> 
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Setup</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
<?php 
if($user_current_level<0)
{
/*echo "<li><a href=\"cus_typ.php\" ><i class=\"fa fa-circle\"></i>Customer Type</a></li>";*/
echo "<li><a href=\"nbrnch.php\" ><i class=\"fa fa-circle\"></i>Branch</a></li>";
echo "<li><a href=\"godown.php\" ><i class=\"fa fa-circle\"></i>Godown</a></li>";
echo "<li><a href=\"pcat.php\" ><i class=\"fa fa-circle\"></i>Brand</a></li>";
echo "<li><a href=\"sub_cat.php\" ><i class=\"fa fa-circle\"></i>Category</a></li>";
echo "<li><a href=\"pent.php\" ><i class=\"fa fa-circle\"></i>Model</a></li>";
echo "<li><a href=\"servc.php\" ><i class=\"fa fa-circle\"></i>Service</a></li>";
echo "<li><a href=\"sale_per.php\" ><i class=\"fa fa-circle\"></i>Sales Person</a></li>";
echo "<li><a href=\"brand_assign.php\" ><i class=\"fa fa-circle\"></i>Brand Assign</a></li>";
echo "<li><a href=\"cust_assign.php\" ><i class=\"fa fa-circle\"></i>Customer Assign</a></li>";
}
if($user_current_level<0 or $user_current_level>0)
{
echo "<li><a href=\"sentry.php\" ><i class=\"fa fa-circle\"></i>Supplier</a></li>";
echo "<li><a href=\"sup_gst.php\" ><i class=\"fa fa-circle\"></i>Supplier GST</a></li>";
echo "<li><a href=\"cust_entry.php\" ><i class=\"fa fa-circle\"></i>Customer</a></li>";
echo "<li><a href=\"billtyp_ntry.php\" ><i class=\"fa fa-circle\"></i>Bill Type</a></li>";
echo "<li><a href=\"prod_upload_pdf.php\" ><i class=\"fa fa-circle\"></i>Upload Product Price PDF</a></li>";

}
if($user_current_level<0)
{
/*echo "<li><a href=\"project_form.php\" ><i class=\"fa fa-circle\"></i>Project</a></li>";

echo "<li><a href=\"gst.php\" ><i class=\"fa fa-circle\"></i>GST Setup</a></li>";
/*echo "<li><a href=\"vat_edt.php\" ><i class=\"fa fa-circle\"></i>Vat Setup</a></li>";*/
}
?>
</ul>
</li>  

<li class="treeview">
	<a href="#"><i class="fa fa-edit"></i><span>View & Edit</span><i class="fa fa-angle-left pull-right"></i></a>
	<ul class="treeview-menu">
	<?php 
	
		echo "<li><a href=\"prod_list.php\" ><i class=\"fa fa-circle\"></i>Model</a></li>";
		echo "<li><a href=\"prod_import.php\" ><i class=\"fa fa-circle\"></i>Model Rate Import</a></li>";
		echo "<li><a href=\"prod_prc_list.php\" ><i class=\"fa fa-circle\"></i>Model Rate List</a></li>";
		echo "<li><a href=\"s_show.php\" ><i class=\"fa fa-circle\"></i>Supplier</a></li>";
		echo "<li><a href=\"c_show.php\" ><i class=\"fa fa-circle\"></i>Customer</a></li>";
		echo "<li><a href=\"sale_per_list.php\" ><i class=\"fa fa-circle\"></i>Sales Person List</a></li>";
		echo "<li><a href=\"comp_dtls.php\" ><i class=\"fa fa-circle\"></i>Company Details</a></li>";

		/*
		echo "<li><a href=\"gst_show.php\" ><i class=\"fa fa-circle\"></i>GST List</a></li>";
		echo "<li><a href=\"swip_bno.php\" ><i class=\"fa fa-circle\"></i>Swap Bill</a></li>";*/
	
	?>
	</ul>
</li>  
		  
						 
		  
		  
<li class="treeview">
<a href="#">
<i class="fa fa-star" ></i>
<span >Invoice</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<?php 
if($user_current_level<0)
{
	


/*echo "<li><a href=\"retn.php\" ><i class=\"fa fa-circle\"></i>Sale Return</a></li>";
echo "<li><a href=\"purchase.php\"  ><i class=\"fa fa-circle\"></i>Purchase Invoice</a></li>";*/
/*echo "<li><a href=\"opening.php\"  ><i class=\"fa fa-circle\"></i>Opening</a></li>";*/

/*	
echo "<li><a href=\"retn_purchase.php\"  ><i class=\"fa fa-circle\"></i>Purchase Return</a></li>";
*/

echo "<li><a href=\"purchase-gst.php\" target=\"_blank\" ><i class=\"fa fa-circle\"></i>Purchase Invoice </a></li>";
echo "<li><a href=\"trnsfer.php\" ><i class=\"fa fa-circle\"></i>Stock Transfer </a></li>";
echo "<li><a href=\"stock_recv.php\"><i class=\"fa fa-circle\"></i>Receive</a></li>";  
echo "<li><a href=\"order_invoice.php\" ><i class=\"fa fa-circle\"></i>Order to Invoice</a></li>";
echo "<li><a href=\"bill_typ.php?rv=1\" ><i class=\"fa fa-circle\"></i>Sale Invoice</a></li>";
echo "<li><a href=\"bill_typ_dup.php\" ><i class=\"fa fa-circle\"></i>Sale Invoice Dup</a></li>";
echo "<li><a href=\"ser_purchase.php\" target=\"_blank\" ><i class=\"fa fa-circle\"></i>Service Purchase Invoice </a></li>";
echo "<li><a href=\"ser_bill_typ.php\" ><i class=\"fa fa-circle\"></i>Service Sale Invoice </a></li>";

echo "<li><a href=\"old_purchase_gst.php\" target=\"_blank\"><i class=\"fa fa-circle\"></i>Purchase Return Old </a></li>";
echo "<li><a href=\"old_bill_typ.php\" ><i class=\"fa fa-circle\"></i>Sale Return Old Stock </a></li>";

echo "<li><a href=\"debit_note.php\" ><i class=\"fa fa-circle\"></i>Debit Note </a></li>";
echo "<li><a href=\"stk_adjust.php\" ><i class=\"fa fa-circle\"></i>Stock Adjustment</a></li>";

/*  echo "<li><a href=\"billing.php\" ><i class=\"fa fa-circle\"></i>Sale Invoice</a></li>";*/
/* echo "<li><a href=\"billing-gst.php\"  target=\"_blank\"><i class=\"fa fa-circle\"></i>Sale Invoice </a></li>";
echo "<li><a href=\"sale_return.php\" ><i class=\"fa fa-circle\"></i>Sale Invoice Return</a></li>";*/
}
?>
</ul>
</li>  
		

		  
		  	<li class="treeview">
                            <a href="#">
                                <i class="fa fa-file-text"></i>
                                <span>Report</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
											<?php 



 /*  echo "<li><a href=\"product_show.php\" ><i class=\"fa fa-circle\"></i>Product Wise Stock</a></li>";*/

   	if($user_current_level<0)
	{
   /* echo "<li><a href=\"supsrc.php\" ><i class=\"fa fa-circle\"></i>Supplier Wise Purchase</a></li>";
       echo "<li><a href=\"product_w_r.php\" ><i class=\"fa fa-circle\"></i>Product Wise Transfer</a></li>";
   */
	}
	/*echo "<li><a href=\"cifdtl.php\" ><i class=\"fa fa-circle\"></i>Customer Wise Sale</a></li>";   */
	if($user_current_level<0)
	{	
 echo "<li><a href=\"purchase_show.php\" target=\"_blank\" ><i class=\"fa fa-circle\"></i>Date Wise Purchase Details</a></li>";
 echo "<li><a href=\"purchase_show_ret.php\" target=\"_blank\" ><i class=\"fa fa-circle\"></i>Date Wise Purchase Return</a></li>";

/* echo "<li><a href=\"purchase_retn_show.php\" ><i class=\"fa fa-circle\"></i>Purchase Return Details</a></li>";*/
	}
 /*   echo "<li><a href=\"dpbill.php\" ><i class=\"fa fa-circle\"></i>Sale Invoice Reprint </a></li>";
  echo "<li><a href=\"return_show.php\" ><i class=\"fa fa-circle\"></i>Sale Return Details</a></li>"
 */
echo "<li><a href=\"sale_show.php\" ><i class=\"fa fa-circle\"></i>Day Wise Sale Details</a></li>";

echo "<li><a href=\"sale_show_ret.php\" ><i class=\"fa fa-circle\"></i>Day Wise Sale Return</a></li>";
/*echo "<li><a href=\"stock_st_day.php\" ><i class=\"fa fa-circle\"></i>Day Wise Stock Details </a></li>";*/
echo "<li><a href=\"prod_wise_stk.php\" ><i class=\"fa fa-circle\"></i>Product Wise Stock</a></li>";
echo "<li><a href=\"stk_summary.php\" ><i class=\"fa fa-circle\"></i>Stock Summary</a></li>";
echo "<li><a href=\"stk_summary_model.php\" ><i class=\"fa fa-circle\"></i>Stock Summary Model Wise</a></li>";
/*echo "<li><a href=\"stock_st_inv.php\" ><i class=\"fa fa-circle\"></i>Stock Statement Invoice Wise</a></li>";
echo "<li><a href=\"sale_show_dup.php\" ><i class=\"fa fa-circle\"></i>Dup Sale  Details</a></li>";
*/
	

/*echo "<li><a href=\"stock_st.php\" ><i class=\"fa fa-circle\"></i>Stock Statement Month </a></li>";
echo "<li><a href=\"stock_st1.php\" ><i class=\"fa fa-circle\"></i>Stock Statement Year </a></li>";*/


 	if($user_current_level<0)
	{
   	/* echo "<li><a href=\"stock_closing.php\" ><i class=\"fa fa-circle\"></i>Closing Stock</a></li>";
	//echo "<li><a href=\"assrc.php\" >Customer List</a></li>";*/
	}
	/* echo "<li><a href=\"cash.php\" ><i class=\"fa fa-circle\"></i>Cash/Credit Sale </a></li>";*/

	/*echo "<li><a href=\"stock_details.php\" ><i class=\"fa fa-circle\"></i>Stock Details </a></li>";
	echo "<li><a href=\"stock_st_day.php\" ><i class=\"fa fa-circle\"></i>Day Wise Stock Details </a></li>";
	if($user_current_level<0)
	{
	echo "<li><a href=\"day_point_show.php\" ><i class=\"fa fa-circle\"></i>Day Wise Point Details</a></li>";
	}
	*/
 echo "<li><a href=\"ser_purchase_show.php\"><i class=\"fa fa-circle\"></i>Service Purchase Details</a></li>";
 echo "<li><a href=\"ser_sale_show.php\"><i class=\"fa fa-circle\"></i>Service Sale Details</a></li>";
 echo "<li><a href=\"visit_show.php\"><i class=\"fa fa-circle\"></i>Visit</a></li>";
	
	
?>
</ul>
          </li>  

<li class="treeview">
<a href="#">
<i class="fa fa-star"   ></i>
<span >GST Report </span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<?php 
echo "<li><a href=\"gst_b2b.php\" ><i class=\"fa fa-circle\"></i>GSTR-1 B2B Report</a></li>";
echo "<li><a href=\"gst_b2cl.php\" ><i class=\"fa fa-circle\"></i>GSTR-1 B2CL Report</a></li>";
echo "<li><a href=\"gst_b2cs.php\" ><i class=\"fa fa-circle\"></i>GSTR-1 B2CS Report</a></li>";
echo "<li><a href=\"gst_report.php\" ><i class=\"fa fa-circle\"></i>GST HSN Report</a></li>";
echo "<li><a href=\"gstr_1.php\" ><i class=\"fa fa-circle\"></i>GSTR-1 Report</a></li>";
echo "<li><a href=\"purchase_show_gst.php\" ><i class=\"fa fa-circle\"></i>Purchase Report</a></li>";
echo "<li><a href=\"gst_3b.php\" ><i class=\"fa fa-circle\"></i>GSTR B3</a></li>";
echo "<li><a href=\"gstr1_doc.php\" ><i class=\"fa fa-circle\"></i>GSTR-1 Docs </a></li>";

?>

</ul>
</li>  


		  
 <li class="treeview">
                            <a href="#">
                                <i class="fa fa-star" ></i>
                                <span >Accounts</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
	<?php 
	echo "<li><a href=\"acgrp_form.php\" ><i class=\"fa fa-circle\"></i>Account Group</a></li>";
echo "<li><a href=\"acldgr_form.php\" ><i class=\"fa fa-circle\"></i>Ledger Head</a></li>";
echo "<li><a href=\"paymtd.php\" ><i class=\"fa fa-circle\"></i>Payment Method</a></li>";
	echo "<li><a href=\"projectop_form.php\" ><i class=\"fa fa-circle\"></i>Opening Balance</a></li>";
	/*echo "<li><a href=\"op_cust.php\" ><i class=\"fa fa-circle\"></i>Customer Opening Bal</a></li>";
	//echo "<li><a href=\"income.php?typ=33\" ><i class=\"fa fa-circle\"></i>Income</a></li>";*/
	echo "<li><a href=\"bill_typ_acc.php?typ=33\" ><i class=\"fa fa-circle\"></i>Income</a></li>";
	
    echo "<li><a href=\"bill_typ_acc.php?typ=44\" ><i class=\"fa fa-circle\"></i>Expenses</a></li>";
   // echo "<li><a href=\"expense.php\" ><i class=\"fa fa-circle\"></i>Expenses</a></li>";
	
	//echo "<li><a href=\"jrnl_form.php\"><i class=\"fa fa-circle\"></i>Journal</a></li>";
	echo "<li><a href=\"bill_typ_acc.php?typ=J01\"><i class=\"fa fa-circle\"></i>Journal</a></li>";
	echo "<li><a href=\"bill_recvbl.php\" ><i class=\"fa fa-circle\"></i>Bill Receivible</a></li>";
	echo "<li><a href=\"bill_typ_acc.php?typ=CC01\" ><i class=\"fa fa-circle\"></i>Customer Credit Note</a></li>";
	//echo "<li><a href=\"recv_reg_oth.php\" ><i class=\"fa fa-circle\"></i>Received Register</a></li>";
	echo "<li><a href=\"bill_typ_acc.php?typ=77\" ><i class=\"fa fa-circle\"></i>Received Register</a></li>";
echo "<li><a href=\"app_cltn.php\" ><i class=\"fa fa-circle\"></i>App Collection</a></li>";
	
	//echo "<li><a href=\"recv_reg.php\" ><i class=\"fa fa-circle\"></i>Received Register List</a></li>";
	//echo "<li><a href=\"bill_typ_acc.php?typ=77&tt=1\" ><i class=\"fa fa-circle\"></i>Received Register (Single)</a></li>";
	
	
	if($user_current_level<0)
	{
	/**/
	//echo "<li><a href=\"pay_reg.php\" ><i class=\"fa fa-circle\"></i>Payment Register</a></li>";
	
	echo "<li><a href=\"bill_typ_acc.php?typ=88\" ><i class=\"fa fa-circle\"></i>Payment Register</a></li>";
	echo "<li><a href=\"refund.php\" ><i class=\"fa fa-circle\"></i>Customer Payment</a></li>";
	}
	//echo "<li><a href=\"crdt_note.php\" ><i class=\"fa fa-circle\"></i>Supplier Debit Note</a></li>";
	echo "<li><a href=\"bill_typ_acc.php?typ=C01\" ><i class=\"fa fa-circle\"></i>Supplier Debit Note</a></li>";
	echo "<li><a href=\"bill_typ_acc.php?typ=CN01\" ><i class=\"fa fa-circle\"></i>Contra</a></li>";
	/*echo "<li><a href=\"add_on.php\" ><i class=\"fa fa-circle\"></i>Add On</a></li>";*/
	

	
	?>
							</ul>
    </li>  
	 <li class="treeview">
                            <a href="#">
                                <i class="fa fa-star"   ></i>
                                <span >Accounts Report </span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
	<?php 
	echo "<li > <a href=\"acledr.php\" target=\"\"><i class=\"fa fa-circle\"></i>Ledger A/C</a></li>";
  echo "<li><a href=\"inex_form.php\" target=\"\"><i class=\"fa fa-circle\"></i>Income & Expenditure A/c</a></li>";
   echo "<li><a href=\"blst_form.php\" target=\"\"><i class=\"fa fa-circle\"></i>Balance Sheet</a></li>";
	/* echo "<li><a href=\"day_book.php\" target=\"\"><i class=\"fa fa-circle\"></i>Day Book</a></li>";*/
	echo "<li><a href=\"cash_acc.php\" target=\"\"><i class=\"fa fa-circle\"></i>Cash Ac.</a></li>";
	echo "<li><a href=\"bank_acc.php\" target=\"\"><i class=\"fa fa-circle\"></i>Bank Ac.</a></li>";
	echo "<li><a href=\"cust_statment.php\" target=\"\"><i class=\"fa fa-circle\"></i>Customer Statement</a></li>";
	echo "<li><a href=\"supp_statement.php\" target=\"\"><i class=\"fa fa-circle\"></i>Supplier Summary</a></li>";
	
	echo "<li><a href=\"supp_statment.php\" target=\"\"><i class=\"fa fa-circle\"></i>Supplier Statement</a></li>";
	echo "<li><a href=\"cust_statment1.php\" target=\"\"><i class=\"fa fa-circle\"></i>Customer Summary</a></li>";
	echo "<li><a href=\"due_bal.php\" target=\"\"><i class=\"fa fa-circle\"></i>Due LIst</a></li>";
	echo "<li><a href=\"oth_recv_reg_list.php\" ><i class=\"fa fa-circle\"></i>Collection Report</a></li>";
	echo "<li><a href=\"final_cltn.php\" ><i class=\"fa fa-circle\"></i>Final Collection</a></li>";
	echo "<li><a href=\"brs.php\" ><i class=\"fa fa-circle\"></i>BRS</a></li>";
	
	?>
		
							</ul>
    </li>  
	<?php 
		if ($user_current_level < 0){
	?>
	
		 <li class="treeview">
                            <a href="#">
                                <i class="fa fa-star"  ></i>
                                <span >System</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
	<?php 

	echo "<li > <a href=\"user.php\" target=\"\"><i class=\"fa fa-user\"></i>New User</a></li>";
	echo "<li > <a href=\"user_show.php\" target=\"\"><i class=\"fa fa-users\"></i>User List</a></li>";
	echo "<li > <a href=\"main_m_entry.php\" target=\"\"><i class=\"fa fa-users\"></i>Main Menu</a></li>";
    echo "<li > <a href=\"menu_entry.php\" target=\"\"><i class=\"fa fa-users\"></i>Menu Setup</a></li>";
    echo "<li > <a href=\"mroll.php\" target=\"\"><i class=\"fa fa-users\"></i>Roll Asign</a></li>";
	echo "<li><a href=\"menu_setup.php\" target=\"\"><i class=\"fa fa-circle\"></i>App Menu</a></li>";
	/*echo "<li><a href=\"roll_assign.php\" target=\"\"><i class=\"fa fa-circle\"></i>Roll Assign</a></li>";*/
	/*echo "<li><a href=\"menu_assign.php\" target=\"\"><i class=\"fa fa-circle\"></i>Roll Assign</a></li>";*/
	/*echo "<li><a href=\"set_date_limit.php\" ><i class=\"fa fa-circle\"></i>Set Date Limit</a></li>"*/


	?>
		
							</ul>
    </li> 

		  
		<?php }?>
 		  
			</ul>			
                </section>
                <!-- /.sidebar -->
            </aside>